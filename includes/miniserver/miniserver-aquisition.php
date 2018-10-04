<!DOCTYPE html>
<html>
<head>
<title>Mini Server</title>
 <link rel="stylesheet" type="text/css" href="../../css/default.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css"/>
    <script type="text/javascript" src="../../js/library/jquery.js" ></script>
    <script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
    <script type="text/javascript" src="../../js/custom/jqscript.js"></script>
	<script type="text/javascript" src="../../js/library/gjquery.js"></script>
	<script type="text/javascript" src="../../js/library/jquery.flot.js"></script>
	<script type="text/javascript" src="../../js/library/jquery.flot.time.js"></script>
    <script type="text/javascript" src="../../js/custom/miniserver/miniserver-aquisition.js"></script>  
<script> 

	   //-------------------hook database------------------------------------------------//
	/*   var AC =  <?php include("../../includes/config/Xentrino/AC.php");?>;
	   var Noise =  <?php include("../../includes/config/Xentrino/Noise.php");?>;
	   var Temperature =  <?php include("../../includes/config/Xentrino/Temperature.php");?>;
	   var Humidity =  <?php include("../../includes/config/Xentrino/Humidity.php");?>;
	   var Light =  <?php include("../../includes/config/Xentrino/Light.php");?>;
	   var Smoke =  <?php include("../../includes/config/Xentrino/Smoke.php");?>;
	   var Gyro =  <?php include("../../includes/config/Xentrino/Gyro.php");?>;
	  */ 
function startTime()
           {
            var today=new Date();
            var n = today.toString();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
             // add a zero in front of numbers<10
             var amPM = (hour > 11) ? "AM" : "PM";
             if(h > 12) {
                 h -= 12;
              } else if(h == 0) {
                h = "12";
             }
              m=checkTime(m);
               s=checkTime(s);
               document.getElementById('ardate').innerHTML=h+":"+m+":"+s+":"+amPM;
               document.getElementById('curtime').innerHTML=n;
            t=setTimeout('startTime()',500);
           }

      function checkTime(i)
       {
       if (i<10)
      {
      i="0" + i;
         }
         return i;
           }
       </script>  
  
    <script type="text/javascript" src="../../js/custom/miniserver/miniserver-aquisition.js"></script>  
</head>


<body onload="startTime()">
   
<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
			$globalPath = "../";
			include("{$globalPath}main/header.php");
		?>
		<div class="pagecontent">
			<div id="miniserver-aquisition" class="projects">
					<?php include("{$globalPath}miniserver/miniserverbar.php");?>
				<div class="rightsidebar">
					<div id="hdr-disparea">
						<div id="sys-rtd">
							<div class="label-stat"><span>System:</span>MINI SERVER</div>
							<div class="label-stat"><span>Real Time Data:</span> ACQUISITION</div>
						</div>
						<div id="grph">
							<div class="label-stat"><span>Graph:</span> TEMPERATURE</div>
						</div>
					</div>
					<div class="displayarea"></div>
					<?php include("{$globalPath}miniserver/miniserver_buttons.php");?>
				</div>
				<div class='clear' style='clear:both;'></div>
			</div>
		</div>
	</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
</body>
</html>
