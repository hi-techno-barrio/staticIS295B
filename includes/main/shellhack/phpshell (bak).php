
<?php   include 'init.php';  ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>PHP Shell <?php echo PHPSHELL_VERSION ?></title>
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta name="generator" content="phpshell">
  <link rel="shortcut icon" type="image/x-icon" href="phpshell.ico">
  <link rel="stylesheet" href="style.css" type="text/css">
  
  <link rel="stylesheet" type="text/css" href="../../../css/default.css"/>
  <link rel="stylesheet" type="text/css" href="../../../css/jquery-ui.css"/>
  
  <script type="text/javascript" src="../../js/library/jquery.js" ></script>
  <script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
  <script type="text/javascript" src="../../js/custom/jqscript.js"></script>


  <script type="text/javascript">
			  <?php if ($_SESSION['authenticated'] && ! $showeditor) 
			  { ?>

				var current_line = 0;
				var command_hist = new Array(<?php echo $js_command_hist ?>);
				var last = 0;

				function key(e) {
					if (!e) var e = window.event;

					if (e.keyCode == 38 && current_line < command_hist.length-1) {
						command_hist[current_line] = document.shell.command.value;
						current_line++;
						document.shell.command.value = command_hist[current_line];
					}

					if (e.keyCode == 40 && current_line > 0) {
						command_hist[current_line] = document.shell.command.value;
						current_line--;
						document.shell.command.value = command_hist[current_line];
					}

				}

				function init() {
					document.shell.setAttribute("autocomplete", "off");
					document.shell.output.scrollTop = document.shell.output.scrollHeight;
					document.shell.command.focus()
				}

			  <?php } 
			  
			  elseif ($_SESSION['authenticated'] && $showeditor) { ?>

				function init() {
				  document.shell.filecontent.focus();
				}

			  <?php } else { ?>

				function init() {
					document.shell.username.focus();
				}

			  <?php } ?>
				function levelup(d) {
					document.shell.levelup.value=d ; 
					document.shell.submit() ;
				}
				function changesubdir(d) {
					document.shell.changedirectory.value=document.shell.dirselected.value ; 
					document.shell.submit() ;
				}
  </script>
</head>

<body onload="init()">
<!--- Main Header --------------------------------------------------------------------------------------------->
		<?php    		 
	       $globalPath = "../../";               
            include_once("header.php");
          
           ?><!--PHP Script -->
<div class="dscmscontainer">
 <div class="dscmswrapper">
	
       <h1>PHP Shell <?php echo PHPSHELL_VERSION ?></h1>

<form name="shell" enctype="multipart/form-data" action="<?php print($_SERVER['PHP_SELF']) ?>" method="post">
<div><input name="levelup" id="levelup" type="hidden"></div>
<div><input name="changedirectory" id="changedirectory" type="hidden"></div>
				<?php
				if (!$_SESSION['authenticated']) {
					/* Generate a new nounce every time we present the login page.  This binds
					 * each login to a unique hit on the server and prevents the simple replay
					 * attack where one uses the back button in the browser to replay the POST
					 * data from a login. */
					$_SESSION['nounce'] = mt_rand();


					if (ini_get('safe_mode') && $ini['settings']['safe-mode-warning'] == true ) {
						echo '<div class="warning">Warning: Safe-mode is enabled. PHP Shell will probably not work correctly.</div>';
					}


				?>

<fieldset>
    <legend>Authentication</legend>
    <?php
       if (!empty($username)) {
        echo "  <p class=\"error\">Login failed, please try again:</p>\n";
         } else {
        echo "  <p>Please login:</p>\n";
        }
    ?>

       <label for="username">Username:</label>
       <input name="username" id="username" type="text" value="<?php echo $username ?>"><br>
       <label for="password">Password:</label>
       <input name="password" id="password" type="password">
       <p><input type="submit" value="Login"></p>
       <input name="nounce" type="hidden" value="<?php echo $_SESSION['nounce']; ?>">

</fieldset>

<?php } else { /* Authenticated. */ ?>
<fieldset>
  <legend><?php echo "Terminal on: " . $_SERVER['SERVER_NAME']; ?></legend>

<p>Current Directory: <span class="pwd">
<?php
      if ( $showeditor ) {
           echo htmlspecialchars($_SESSION['cwd'], ENT_COMPAT, 'UTF-8') . '</span>';
           } 
      else 
         { /* normal mode - offer navigation via hyperlinks */
              $parts = explode('/', $_SESSION['cwd']);
     
         for ($i=1; $i<count($parts); $i=$i+1) {
                echo '<a class="pwd" title="Change to this directory. Your command will not be executed." href="javascript:levelup(' . (count($parts)-$i) . ')">/</a>' ;
                echo htmlspecialchars($parts[$i], ENT_COMPAT, 'UTF-8');
                 }
                echo '</span>';
        if (is_readable($_SESSION['cwd'])) { /* is the current directory readable? */
            /* Now we make a list of the directories. */
            $dir_handle = opendir($_SESSION['cwd']);
            
            /* We store the output so that we can sort it later: */
            $options = array();
           
            /* Run through all the files and directories to find the dirs. */
            while ($dir = readdir($dir_handle)) {
                 if (($dir != '.') and ($dir != '..') and is_dir($_SESSION['cwd'] . "/" . $dir)) 
                 {
                    $options[$dir] = "<option value=\"/$dir\">$dir</option>";
                   }//If
                 } // While
            closedir($dir_handle);
            if (count($options)>0) {
                ksort($options);
                echo '<br><a href="javascript:changesubdir()">Change to subdirectory</a>: <select name="dirselected">';
                echo implode("\n", $options);
                echo '</select>';
            }
        } else {
            echo "[current directory not readable]";
        }  
    }
?>
<br>

    <?php if (! $showeditor) { /* Outputs the 'terminal' without the editor */ ?>

<div id="terminal">
<textarea name="output" readonly="readonly" cols="<?php echo $columns ?>" rows="<?php echo $rows ?>">
<?php
        $lines = substr_count($_SESSION['output'], "\n");
        $padding = str_repeat("\n", max(0, $rows+1 - $lines));
        echo rtrim($padding . $_SESSION['output']);
?>
</textarea>
<p id="prompt">
<span id="ps1"><?php echo htmlspecialchars($ini['settings']['PS1'], ENT_COMPAT, 'UTF-8'); ?></span>
<input name="command" type="text" onkeyup="key(event)"
       size="<?php echo $columns-strlen($ini['settings']['PS1']); ?>" tabindex="1">
</p>
</div>

    <?php } else { /* Output the 'editor' */ ?>
    <?php print("You are editing this file: ".$filetoedit); ?>

<div id="terminal">
<textarea name="filecontent" cols="<?php echo $columns ?>" rows="<?php echo $rows ?>">
<?php
    if (file_exists($filetoedit)) {
         print(htmlspecialchars(str_replace("%0D%0D%0A", "%0D%0A", file_get_contents($filetoedit))));		 
    }
?>
</textarea>
</div>

<?php } /* End of terminal */ ?>

<p>
<?php if (! $showeditor) { /* You can not resize the textarea while
                           * the editor is 'running', because if you would
                           * do so you would lose the changes you have
                           * already made in the textarea since last saving */
?>
  <span style="float: right">Size: <input type="text" name="rows" size="2"
  maxlength="3" value="<?php echo $rows ?>"> &times; <input type="text"
  name="columns" size="2" maxlength="3" value="<?php echo $columns
  ?>"></span><br>
<input type="submit" value="Execute command">
<input type="submit" name="clear" value="Clear screen">
<?php } else { /* for 'editor-mode' */ ?>
<input type="hidden" name="filetoedit" id="filetoedit" value="<?php print($filetoedit) ?>">
<input type="submit" value="Save and Exit">
<input type="reset" value="Undo all Changes">
<input type="submit" value="Exit without saving" onclick="javascript:document.getElementById('filetoedit').value='';return true;">
<?php } ?>

  <input type="submit" name="logout" value="Logout">
</p>
</fieldset>

<?php if ($ini['settings']['file-upload']) { ?>
<br><br>
<fieldset>
  <legend>File upload</legend>
    Select file for upload:
    <input type="file" name="uploadfile" size="40"><br>
<input type="submit" value="Upload file">
</fieldset>
    <?php } ?>

<?php } ?>

</form>
<Hr>
</Hr>
<address>
  <input type="button" onclick="location.href='pwhash.php';" value=" Create  Password Hash" />
</address>
</div>
	<div class='footer'  style="margin-top:20%"></div> 
</div>
</body>
</html>
