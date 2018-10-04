<?php
session_start();
$globalPath = "../../";
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	//$user_home->redirect('index.php');
	$user->redirect('../admin.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<!--<html class="no-js">   -->
<html >    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
         
        <!-- Bootstrap -->
        
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->    
     <!--   <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">-->
       
       
        <script type="text/javascript" src="../../js/library/jquery.js" ></script>
        <script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
        <script type="text/javascript" src="../../js/custom/jqscript.js"></script>
         <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">  
     <!--   <link href="assets/styles.css" rel="stylesheet" media="screen">  -->
        <link rel="stylesheet" type="text/css" href="../../../css/default.css"/>
        <link rel="stylesheet" type="text/css" href="../../../css/jquery-ui.css"/>
    </head>
    
<body>

 <div class="dscmscontainer">
 <div class="dscmswrapper"> 
   <?php 
	       $globalPath = "../../";
	        include("{$globalPath}main/header.php");
        ?>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Admin</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php echo $row['userEmail']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                             <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Data Aquisition <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li><a href="http://localhost:4000/xentrino/aquisition.html">XentrinoBot Data Aquisition</a></li>
                                    <li><a href="http://localhost:4000/chrisdon/aquisition.html">ChrisDonBot Data Aquisition</a></li>
                                    <li><a href="http://localhost:4000/macron/aquisition.html">MacronBit Data Aquisition</a></li>
                                </ul>
                            </li>
                            <li>
                            
                             <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Command/Controllers <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li><a href="http://localhost:4000/chrisdon/control.html">CrisdonBot Controller</a></li>
                                    <li><a href="http://localhost:4000/macron/control.html">MacronBot Controller</a></li>
                                </ul>
                            </li>
                            <li>
								
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Access Tools <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li><a href="http://localhost/staticIS295B/includes/main/shellhack/phpshell.php">Terminal</a></li>
                                    <li><a href="http://localhost/staticIS295B/includes/main/termulator/term.php">Full Access CLI</a></li>
                                    <li><a href="http://localhost/staticIS295B/includes/main/vnc/vnc.html">VNC Server</a></li>
                                    <li><a href="http://localhost/staticIS295B/includes/main/phpminiadmin.php">CRUD</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="http://127.0.0.1/staticIS295B/includes/main/roswebconsole/console.php">Robotic Operating System</a>
                            </li>
                            
                            
                        </ul>
                    </div>
                    <!-- Display 1 ,2,3 -->
                    <!--/.nav-collapse -->
            
                </div>
            
            </div>
        
      </div> 
            <div class='clear' style='clear:both;'></div>
        <!--/.fluid-container-->
      
   </div>  
	
</div>
 <div class='footer'  style="margin-top:40%"></div> 	 
    </body>

</html>
