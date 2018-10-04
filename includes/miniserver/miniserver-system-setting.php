<!DOCTYPE html>
<html>
<head>
<title>Mini Server</title>
<link rel="stylesheet" type="text/css" href="../../css/default.css"/>
<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css"/>
<script type="text/javascript" src="../../js/library/jquery.js" ></script>
<script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
<script type="text/javascript" src="../../js/custom/jqscript.js"></script>

</head>

<body>
<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
			$globalPath = "../";
			include("{$globalPath}main/header.php");
		?>
		<div class="pagecontent">
			<div id="miniserver-system-setting"  class="projects">
					<?php include("{$globalPath}miniserver/miniserverbar.php");?>
				<div class="rightsidebar">
					<div id="hdr-disparea">


						<div id="sys-rtd">
							<div class="label-stat"><span>System:</span>MINI SERVER</div>
							<div class="label-stat"><span>System Setting</div>
						</div>
						<div id="grph">
							<div class="label-stat"><span>Graph:</span> TEMPERATURE</div>
						</div>
					</div>
					<div class="displayarea">
                              <!-----------------------------------------------    ------  -->
                                         <?php
                                           echo "SERVER FILE INFO = ".$_SERVER['PHP_SELF'] 	;
                                           echo '</br>';
                                           echo "GATEWAY INTERFACE = ".$_SERVER['GATEWAY_INTERFACE'] ;
                                           echo '</br>';
                                           echo "SERVER ADDRESS = ".$_SERVER['SERVER_ADDR'] ;
                                           echo '</br>';
                                           echo "LOCAL NAME = ".$_SERVER['SERVER_NAME'] ;
                                           echo '</br>';
                                           echo "SERVER SOFTWARE = ".$_SERVER['SERVER_SOFTWARE'] ;
                                           echo '</br>';
                                           echo "SERVER PROTOCOL = ".$_SERVER['SERVER_PROTOCOL'] ;
                                           echo '</br>';
                                           echo $_SERVER['REQUEST_METHOD'] ;
                                           echo '</br>';
                                           echo $_SERVER['REQUEST_TIME'] ;
                                           echo '</br>';
                                           echo $_SERVER['QUERY_STRING'] ;
                                           echo '</br>';
                                           echo $_SERVER['HTTP_ACCEPT'] ;
                                           echo '</br>';
                                         //  echo $_SERVER['HTTP_ACCEPT_CHARSET'] 	;
                                           echo $_SERVER['HTTP_HOST'] 	;
                                           echo '</br>';
                                           echo $_SERVER['HTTP_REFERER'] ;
                                           echo '</br>';
                                         //  echo $_SERVER['HTTPS'] ;
                                           echo $_SERVER['REMOTE_ADDR'] 	;
                                         //  echo $_SERVER['REMOTE_HOST'] 	;
                                           echo $_SERVER['REMOTE_PORT'] 	;
                                           echo '</br>';
                                           echo $_SERVER['SCRIPT_FILENAME'] ;
                                           echo '</br>';
                                           echo $_SERVER['SERVER_ADMIN'] 	;
                                           echo '</br>';
                                           echo $_SERVER['SERVER_PORT'] 	;
                                           echo '</br>';
                                           echo $_SERVER['SERVER_SIGNATURE'] 	;
                                           echo '</br>';
                                         //  echo $_SERVER['PATH_TRANSLATED'] ;	
                                           echo $_SERVER['SCRIPT_NAME'] 	;
                                           echo '</br>';
                                        //   echo $_SERVER['SCRIPT_URI'];
                                             // system("ifconfig",$retval);
                                             // echo $retval;
                                            echo '</br>';
                                          ?> 
                         <!-----------------------------------------------    ------  -->
                                  </div>  <!--<div class="displayarea">  -->
					
				</div>
				       
				<div class='clear' style='clear:both;'></div>
				
					  <fieldset>
						  
                        First name:
                        <input type="text" name="firstname">
                        First name2:
                        <input type="text" name="firstname">
                        Last name:<br>
                       <input type="text" name="lastname"><br>
                        Coballes:<br>
                       <input type="text" name="lastname"><br>
                       </fieldset>
                    
			</div>
		</div>
	</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
</body>
</html>
