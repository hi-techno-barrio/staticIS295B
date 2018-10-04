<!DOCTYPE html>
<html>
<head>
<title>MacronBot</title>
<link rel="stylesheet" type="text/css" href="../../css/default.css"/>
<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css"/>
<script type="text/javascript" src="../../js/library/jquery.js" ></script>
<script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
<script type="text/javascript" src="../../js/custom/jqscript.js"></script>
	<script type="text/javascript" src="../../js/library/gjquery.js"></script>
	<script type="text/javascript" src="../../js/library/jquery.flot.js"></script>
	<script type="text/javascript" src="../../js/library/jquery.flot.time.js"></script>
 <script> 
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
 
<script type="text/javascript" src="../../js/custom/macrobot/macrobot-aquisition.js"></script>
</head>

<body onload="startTime()">
<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
			$globalPath = "../";
			include("{$globalPath}main/header.php");
		?>
		<div class="pagecontent">
			<div id="macrobot-aquisition" class="projects">
				<?php include("{$globalPath}macrobot/macronbar.php");?>
				<div class="rightsidebar">
					
					<div id="hdr-disparea">
						<div id="sys-rtd">
							<div class="label-stat"><span>System:</span>MACROBOT</div>
							<div class="label-stat"><span>Real Time Data:</span> ACQUISITION</div>
						</div>
						<div id="grph">
							<div class="label-stat"><span>Graph:</span> TEMPERATURE</div>
						</div>
					</div>
					<div class="displayarea"></div>
					<?php include("{$globalPath}macrobot/macron_buttons.php");?>
				</div>
				<div class='clear' style='clear:both;'></div>
			</div>
		</div>
	</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
</body>
</html>
