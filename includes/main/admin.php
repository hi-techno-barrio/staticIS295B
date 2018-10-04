

<!DOCTYPE html>
<html>
  <head>
	  
   <title>ChrisDonBot</title>
    <link rel="stylesheet" type="text/css" href="../../css/default.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css"/>
    <script type="text/javascript" src="../../js/library/jquery.js" ></script>
    <script type="text/javascript" src="../../../js/library/jquery-ui.js"></script>
    <script type="text/javascript" src="../../../js/custom/jqscript.js"></script>
    <script type="text/javascript" src="../../js/library/gjquery.js"></script>
    <script type="text/javascript" src="../../js/library/jquery.flot.js"></script>
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script> 
    
  </head>
  
<body >  
	<?php
			session_start();
				$globalPath = "../";
				require_once $globalPath.'main/login/class.user.php';
					$user_login = new USER();

					if($user_login->is_logged_in()!="")
					{
						$user_login->redirect($globalPath.'main/login/login-Index.php');
					   }

					  if(isset($_POST['btn-login']))
					   {
						$email = trim($_POST['txtemail']);
						$upass = trim($_POST['txtupass']);
						
						  if($user_login->login($email,$upass))
						   {
							$user_login->redirect($globalPath.'main/login/login-Index.php');
						   }
					   }
					?> <!--PHP Script -->
					
 <div class="dscmscontainer"> 
	 
  <div class="dscmswrapper"> 
	  <?php include("{$globalPath}main/header.php"); ?>
	
	  <!-- CONTAINER-- -->
    <div class="container">  
		       <?php 
		         if(isset($_GET['inactive']))
		           {
		       ?>
                 <div class='alert alert-error'>
				    <button class='close' data-dismiss='alert'>&times;</button>
				    <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
			      </div>
              <?php
		       }
		      ?>
      <!--	<div id="loginX">	-->      
	    <div class="pagecontent">
		 <!-- FORM-- -->
            <form class="form-signin" method="post"> 
               <?php  if(isset($_GET['error']))    {     ?>
													  <div class='alert alert-success'>
															<button class='close' data-dismiss='alert'>&times;</button>
															<strong>Wrong Details!</strong> 
													  </div>
               <?php  }   ?>
					 <div id="admin-page">  
						 <div id="user-acct">
							<h2 class="form-signin-heading">Sign In.</h2><hr>
							<input type="text" class="input-block-level" placeholder="Email address" name="txtemail" required />
							<input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
							</hr>
							  <button class="btn btn-large btn-primary" type="submit" style="padding:0px; position:relative; margin-top:7px; left:235px;"  name="btn-login">Login</button>
						  </div> <!-- user-acct"-->
						  
						 <div id="regfor">
							<div class='clear' style='clear:both;'></div>
							<span><a href="login/signup.php">Register new account</a></span>
							<span> &nbsp | &nbsp</span>
							<span><a href="login/fpass.php">Forgot password</a></span>        
						 </div>  <!-- reg for -->
				   </div> <!---- amin-page--> 
				  				  
             </form> <!-- FORM-- -->      
      <!-- </div>  loginX-->            
          </div> <!--Page Content-->        
        </div>  <!--container-->

    </div>
</div>
    <div class='footer'  style="margin-top:40%"></div> 	
	
</body>

  
</html>
