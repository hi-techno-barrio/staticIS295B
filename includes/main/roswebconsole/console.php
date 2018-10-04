
<!DOCTYPE html>
<html>
<head>
<title>Robotic Operating System </title>
  <link rel="stylesheet" type="text/css" href="../../../css/default.css"/>
  <link rel="stylesheet" type="text/css" href="../../../css/jquery-ui.css"/>
  
  <script type="text/javascript" src="../../js/library/jquery.js" ></script>
  <script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
  <script type="text/javascript" src="../../js/custom/jqscript.js"></script>
</head>

<body>

<div class="dscmscontainer">
	<div class="dscmswrapper">
		  <?php    
		  
		    //  $exec = "bash -lc 'echo robook1234 | /usr/bin/sudo -S /usr/bin/node app.js -p 777' ";
             //  exec($exec);
              		 
	        $globalPath = "../../";               
             $IP = $_SERVER['SERVER_ADDR']; //explode(' ',explode(':',explode('inet addr',explode('wlp3s0',trim(`ifconfig`))[1])[1])[1])[0];
              
            //  $exec = "bash -lc 'echo robook1234 | /usr/bin/sudo -S /usr/bin/node app.js -p 777' ";
            //  exec($exec);
              
              if(IP==null)
               {                   
                echo "not valid IP";
             }  
             include("{$globalPath}main/header.php");
           ?><!--PHP Script -->
		
			
</div>  <!-- wrapper -->
<div class='clear' style='clear:both;'></div>
             <iframe src="<?php echo "http://".$IP."/staticIS295B/includes/main/roswebconsole/index.html"; ?>" style="border: 0;  width: 100%; height: 100%; position:absolute"></iframe> 
	       <!-- <iframe src="http://192.168.1.39:3000" style="border: 0;  width: 100%; height: 100%; position:absolute"></iframe>  -->
	
</div>  <!-- container -->
<div class='footer'  style="margin-top:55%"></div> 
</body>
</html>























