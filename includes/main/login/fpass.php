

<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="../../../css/default.css"/>
    <link rel="stylesheet" type="text/css" href="../../../css/jquery-ui.css"/>
    <script type="text/javascript" src="../../../js/library/jquery.js" ></script>
    <script type="text/javascript" src="../../../../js/library/jquery-ui.js"></script>
    <script type="text/javascript" src="../../../../js/custom/jqscript.js"></script>
    <script type="text/javascript" src="../../../js/library/gjquery.js"></script>
    <script type="text/javascript" src="../../../js/library/jquery.flot.js"></script>
  
  </head>
  <body >
			<!-- PHP SCRIPT -->
				<?php
				session_start();
				$globalPath = "../../";
				require_once 'class.user.php';
				$user = new USER();

				if($user->is_logged_in()!="")
				{
					$user->redirect('login-Index.php');
				}

				if(isset($_POST['btn-submit']))
				{
					$email = $_POST['txtemail'];
					
					$stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
					$stmt->execute(array(":email"=>$email));
					$row = $stmt->fetch(PDO::FETCH_ASSOC);	
					if($stmt->rowCount() == 1)
					{
						$id = base64_encode($row['userID']);
						$code = md5(uniqid(rand()));
						
						$stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
						$stmt->execute(array(":token"=>$code,"email"=>$email));
						
						$message= "
								   Hello , $email
								   <br /><br />
								   We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
								   <br /><br />
								   Click Following Link To Reset Your Password 
								   <br /><br />
								   <a href='http://localhost/staticIS295B/includes/main/login/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
								   <br /><br />
								   thank you :)
								   ";
						$subject = "Password Reset";
						
						$user->send_mail($email,$message,$subject);
						
						$msg = "<div class='alert alert-success'>
									<button class='close' data-dismiss='alert'>&times;</button>
									We've sent an email to $email.
									Please click on the password reset link in the email to generate new password. 
								</div>";
					}
					else
					{
						$msg = "<div class='alert alert-danger'>
									<button class='close' data-dismiss='alert'>&times;</button>
									<strong>Sorry!</strong>  this email not found. 
								</div>";
					}
				}
				?>	 
				<!-- PHP SCRIPT -->
				
<div class="dscmscontainer">
	 <div class="dscmswrapper">
	   <?php 
			//$globalPath = "../";  //localhost/staticDCMS/includes/main/
			//include("{$globalPath}main/conf.php");
			include("{$globalPath}main/header.php");
			
	   ?>	
	   
	     <?php
			      if(isset($msg))
			      {
				   echo $msg;
			       }
			      else
			      {
		?>
              	   <div class='alert alert-info'>
				    Please enter your email address. You will receive a link to create a new password via email.!
				   </div>  
         <?php
			       }
		  ?>
	  <!-- CONTAINER-- -->
    <div class="container">
      <form class="form-signin" method="post">
		  <div id="admin-page" style="height: 170px;">  
		   <div id="user-acct">
            <h2 class="form-signin-heading">Forgot Password</h2><hr>
              
              <input class="input-block-level" placeholder="Email address" name="txtemail" required="" type="text">
     	         <hr>
             <button style="width: 325px; position: relative; margin-top: 7px; padding: 0px;" class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generate new Password</button>
               
         </div> <!-- user-acct"-->
        </div>  <!--admin-page -->
      </form>
    </div> <!-- container -->
    </div>  <!-- Wrapper -->
	
 </div>   <!-- Container -->
    <div class='footer'  style="margin-top:40%"></div> 	
  </body>
</html>
