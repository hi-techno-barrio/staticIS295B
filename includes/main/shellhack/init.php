<?php // -*- coding: utf-8 -*-

define('PHPSHELL_VERSION', '2.4');
/*

  **************************************************************
  *                     PHP Shell                              *
  **************************************************************

  PHP Shell is an interactive PHP script that will execute any command
  entered.  See the files README, INSTALL, and SECURITY or
  http://phpshell.sourceforge.net/ for further information.

  Copyright (C) 2000-2012 the Phpshell-team

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You can get a copy of the GNU General Public License from this
  address: http://www.gnu.org/copyleft/gpl.html#SEC1
  You can also write to the Free Software Foundation, Inc., 59 Temple
  Place - Suite 330, Boston, MA  02111-1307, USA.
  
*/

/* There are no user-configurable settings in this file anymore, please see
 * config.php instead. */

header("Content-Type: text/html; charset=utf-8");

/* This error handler will turn all notices, warnings, and errors into fatal
 * errors, unless they have been suppressed with the @-operator. */
function error_handler($errno, $errstr, $errfile, $errline, $errcontext)
{
    /* The @-operator (used with chdir() below) temporarely makes
     * error_reporting() return zero, and we don't want to die in that case.
     * We do note the error in the output, though. */
    if (error_reporting() == 0) {
        $_SESSION['output'] .= $errstr . "\n";
    } else {
        die('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>PHP Shell ' . PHPSHELL_VERSION . '</title>
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta name="generator" content="phpshell">
  <link rel="shortcut icon" type="image/x-icon" href="phpshell.ico">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<div class="dscmscontainer">
 <div class="dscmswrapper">
  <?php 
	       $globalPath = "../../";
	        include("{$globalPath}main/header.php");
        ?>
  <h1>Fatal Error!</h1>
  <p><b>' . $errstr . '</b></p>
  <p>in <b>' . $errfile . '</b>, line <b>' . $errline . '</b>.</p>

  <hr>

  <p>Please consult the <a href="README">README</a>, <a
  href="INSTALL">INSTALL</a>, and <a href="SECURITY">SECURITY</a> files for
  instruction on how to use PHP Shell.</p>

  <hr>

  <address>
  Copyright &copy; 2000&ndash;2012, the Phpshell-team. Get the latest
  version at <a
  href="http://phpshell.sourceforge.net/">http://phpshell.sourceforge.net/</a>.
  </address>
</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
</body>
</html>');
    }
}

/* Installing our error handler makes PHP die on even the slightest problem.
 * This is what we want in a security critical application like this. */
set_error_handler('error_handler');


function logout()
{
    /* Empty the session data, except for the 'authenticated' entry which the
     * rest of the code needs to be able to check. */
    $_SESSION = array('authenticated' => false);

    /* Unset the client's cookie, if it has one. */
    //    if (isset($_COOKIE[session_name()]))
    //        setcookie(session_name(), '', time()-42000, '/');

    /* Destroy the session data on the server.  This prevents the simple
     * replay attack where one uses the back button to re-authenticate using
     * the old POST data since the server wont know the session then. */
    //    session_destroy();
}

/* Clear screen */
function clearscreen() 
{
    $_SESSION['output'] = '';
}

function stripslashes_deep($value)
{
    if (is_array($value)) {
        return array_map('stripslashes_deep', $value);
    } else {
        return stripslashes($value);
    }
}

if (get_magic_quotes_gpc()) {
    $_POST = stripslashes_deep($_POST);
}

/* Initialize some variables we need again and again. */
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$nounce   = isset($_POST['nounce'])   ? $_POST['nounce']   : '';

$command  = isset($_POST['command'])  ? $_POST['command']  : '';
$rows     = isset($_POST['rows'])     ? $_POST['rows']     : 30;
$columns  = isset($_POST['columns'])  ? $_POST['columns']  : 80;

if (!preg_match('/^[[:digit:]]+$/', $rows)) { 
    $rows=24 ; 
} 
if (!preg_match('/^[[:digit:]]+$/', $columns)) {
    $columns=80 ;
}
/* Load the configuration. */
$ini = parse_ini_file('config.php', true);

if (empty($ini['settings'])) {
    $ini['settings'] = array();
}

/* Default settings --- these settings should always be set to something. */
$default_settings = array('home-directory' => '.',
                          'PS1'            => '$ ');
$showeditor = false;

/* Merge settings. */
$ini['settings'] = array_merge($default_settings, $ini['settings']);

session_start();

/* Delete the session data if the user requested a logout. This leaves
 * the session cookie at the user, but this is not important since we
 * authenticates on $_SESSION['authenticated']. */
if (isset($_POST['logout'])) {
    logout();
}

/* Clear screen if submitted */
if (isset($_POST['clear'])) {
    clearscreen();
}

/* Attempt authentication. */
if (isset($_SESSION['nounce']) && $nounce == $_SESSION['nounce'] 
    && isset($ini['users'][$username])
) {
    if (strchr($ini['users'][$username], ':') === false) {
        // No seperator found, assume this is a password in clear text.
        $_SESSION['authenticated'] = ($ini['users'][$username] == $password);
    } else {
        list($fkt, $salt, $hash) = explode(':', $ini['users'][$username]);
        $_SESSION['authenticated'] = ($fkt($salt . $password) == $hash);
    }
}


/* Enforce default non-authenticated state if the above code didn't set it
 * already. */
if (!isset($_SESSION['authenticated'])) {
    $_SESSION['authenticated'] = false;
}

if ($_SESSION['authenticated']) {  
    /* Initialize the session variables. */
    if (empty($_SESSION['cwd'])) {
        $_SESSION['cwd'] = realpath($ini['settings']['home-directory']);
        $_SESSION['history'] = array();
        $_SESSION['output'] = '';
    }
    /* Clicked on one of the subdirectory links - ignore the command */
    if (isset($_POST['levelup'])) {
        $levelup = $_POST['levelup'] ;
        while ($levelup > 0) {
            $command = '' ; /* ignore the command */
            $_SESSION['cwd'] = dirname($_SESSION['cwd']);
            $levelup -- ;
        }
    }
    /* Selected a new subdirectory as working directory - ignore the command */
    if (isset($_POST['changedirectory'])) {
        $changedir= $_POST['changedirectory'];
        if (strlen($changedir) > 0) {
            if (@chdir($_SESSION['cwd'] . '/' . $changedir)) {
                $command = '' ; /* ignore the command */
                $_SESSION['cwd'] = realpath($_SESSION['cwd'] . '/' . $changedir);
            }
        }
    }
    if (isset($_FILES['uploadfile']['tmp_name'])) {
        if (is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
            if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $_SESSION['cwd'] . '/' . $_FILES['uploadfile']['name'])) { 
                echo "CANNOT MOVE {$_FILES['uploadfile']['name']}" ;
            }
        }
    }

    /* Save content from 'editor' */
    if (isset($_POST["filetoedit"]) && ($_POST["filetoedit"] != "")) {
        $filetoedit_handle = fopen($_POST["filetoedit"], "w");
        fputs($filetoedit_handle, str_replace("%0D%0D%0A", "%0D%0A", $_POST["filecontent"]));
        fclose($filetoedit_handle);
    }

    if (!empty($command)) {
        /* Save the command for late use in the JavaScript. If the command is
         * already in the history, then the old entry is removed before the
         * new entry is put into the list at the front. */
        if (($i = array_search($command, $_SESSION['history'])) !== false) {
            unset($_SESSION['history'][$i]);
        }

        array_unshift($_SESSION['history'], $command);
  
        /* Now append the command to the output. */
        $_SESSION['output'] .= htmlspecialchars($ini['settings']['PS1'] . $command, ENT_COMPAT, 'UTF-8') . "\n";

        /* Initialize the current working directory. */
        if (trim($command) == 'cd') {
            $_SESSION['cwd'] = realpath($ini['settings']['home-directory']);
        } elseif (preg_match('/^[[:blank:]]*cd[[:blank:]]+([^;]+)$/', $command, $regs)) {
            /* The current command is a 'cd' command which we have to handle
             * as an internal shell command. */

            /* if the directory starts and ends with quotes ("), remove them -
               allows command like 'cd "abc def"' */
            if ((substr($regs[1], 0, 1) == '"') && (substr($regs[1], -1) =='"') ) {
                $regs[1] = substr($regs[1], 1);
                $regs[1] = substr($regs[1], 0, -1);
            }

            if ($regs[1]{0} == '/') {
                /* Absolute path, we use it unchanged. */
                $new_dir = $regs[1];
            } else {
                /* Relative path, we append it to the current working directory. */
                $new_dir = $_SESSION['cwd'] . '/' . $regs[1];
            }

            /* Transform '/./' into '/' */
            while (strpos($new_dir, '/./') !== false) {
                $new_dir = str_replace('/./', '/', $new_dir);
            }

            /* Transform '//' into '/' */
            while (strpos($new_dir, '//') !== false) {
                $new_dir = str_replace('//', '/', $new_dir);
            }

            /* Transform 'x/..' into '' */
            while (preg_match('|/\.\.(?!\.)|', $new_dir)) {
                $new_dir = preg_replace('|/?[^/]+/\.\.(?!\.)|', '', $new_dir);
            }

            if ($new_dir == '') {
                $new_dir = '/';
            }

            /* Try to change directory. */
            if (@chdir($new_dir)) {
                $_SESSION['cwd'] = $new_dir;
            } else {
                $_SESSION['output'] .= "cd: could not change to: $new_dir\n";
            }

            /* history command (without parameter) - output the command history */
        } elseif (trim($command) == 'history') {
            $i = 1 ; 
            foreach ($_SESSION['history'] as $histline) {
                $_SESSION['output'] .= htmlspecialchars(sprintf("%5d  %s\n", $i, $histline), ENT_COMPAT, 'UTF-8');
                $i++;
            }
            /* history command (with parameter "-c") - clear the command history */
        } elseif (preg_match('/^[[:blank:]]*history[[:blank:]]*-c[[:blank:]]*$/', $command)) {
            $_SESSION['history'] = array() ;
            /* "clear" command - clear the screen */
        } elseif (trim($command) == 'clear') {
            clearscreen();
        } elseif (trim($command) == 'editor') {
            /* You called 'editor' without a filename so you get an short help
             * on how to use the internal 'editor' command */
               $_SESSION['output'] .= " Syntax: editor filename\n (you forgot the filename)\n";
        
        } elseif (preg_match('/^[[:blank:]]*editor[[:blank:]]+([^;]+)$/', $command, $regs)) {
            /* This is a tiny editor which you can start with 'editor filename'. */
            $filetoedit = $regs[1];
            if ($regs[1]{0} != '/') {
                /* relative path, add it to the current working directory. */
                $filetoedit = $_SESSION['cwd'].'/'.$regs[1];
            } ;
            if (is_file(realpath($filetoedit)) || ! file_exists($filetoedit)) {
                $showeditor = true;
                if (file_exists(realpath($filetoedit))) {
                    $filetoedit = realpath($filetoedit);
                }
            } else {
                $_SESSION['output'] .= " Syntax: editor filename\n (just regular or not existing files)\n";
            }

        } elseif ((trim($command) == 'exit') || (trim($command) == 'logout')) {
            logout();
        } else {

            /* The command is not an internal command, so we execute it after
             * changing the directory and save the output. */
            if (@chdir($_SESSION['cwd'])) {

                // We canot use putenv() in safe mode.
                if (!ini_get('safe_mode')) {
                    // Advice programs (ls for example) of the terminal size.
                    putenv('ROWS=' . $rows);
                    putenv('COLUMNS=' . $columns);
                }

                /* Alias expansion. */
                $length = strcspn($command, " \t");
                $token = substr($command, 0, $length);
                if (isset($ini['aliases'][$token])) {
                    $command = $ini['aliases'][$token] . substr($command, $length);
                }
                $io = array();
                $p = proc_open(
                    $command,
                    array(1 => array('pipe', 'w'),
                          2 => array('pipe', 'w')),
                    $io
                );

                /* Read output sent to stdout. */
                while (!feof($io[1])) {
                    $line=fgets($io[1]);
                    if (function_exists('mb_convert_encoding')) {
                        /* (hopefully) fixes a strange "htmlspecialchars(): Invalid multibyte sequence in argument" error */
                        $line = mb_convert_encoding($line, 'UTF-8', 'UTF-8');
                    }
                    $_SESSION['output'] .= htmlspecialchars($line, ENT_COMPAT, 'UTF-8');
                }
                /* Read output sent to stderr. */
                while (!feof($io[2])) {
                    $line=fgets($io[2]);
                    if (function_exists('mb_convert_encoding')) {
                        /* (hopefully) fixes a strange "htmlspecialchars(): Invalid multibyte sequence in argument" error */
                        $line = mb_convert_encoding($line, 'UTF-8', 'UTF-8');
                    }
                    $_SESSION['output'] .= htmlspecialchars($line, ENT_COMPAT, 'UTF-8');
                }
            
                fclose($io[1]);
                fclose($io[2]);
                proc_close($p);
            } else { /* It was not possible to change to working directory. Do not execute the command */
                $_SESSION['output'] .= "PHP Shell could not change to working directory. Your command was not executed.\n";
            }
        }
    }

    /* Build the command history for use in the JavaScript */
    if (empty($_SESSION['history'])) {
        $js_command_hist = '""';
    } else {
        $escaped = array_map('addslashes', $_SESSION['history']);
        $js_command_hist = '"", "' . implode('", "', $escaped) . '"';
    }
}

?>
