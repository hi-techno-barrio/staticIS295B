<!DOCTYPE html>
<html>
<head>
<title>ChrisDonBot</title>
<link rel="stylesheet" type="text/css" href="../../css/default.css"/>
<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css"/>
<script type="text/javascript" src="../../js/library/jquery.js" ></script>
<script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
<script type="text/javascript" src="../../js/custom/jqscript.js"></script>
<script type="text/javascript" src="../../js/library/gjquery.js"></script>
<script type="text/javascript" src="../../js/library/jquery.flot.js"></script>
</head>
<body>

<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
			$globalPath = "../";
			include("{$globalPath}main/header.php");
		?>
		<div class="pagecontent">
			<div id="project-front-page">
				<div id="left-prjt" style="float:left; width:250px;">
					<h2 class="hdr-text">Information System</h2>
					<div class="dotted-hline"></div>
					<div id="link-abt">
						<a href="#ms-details-prjtf" id="ms_prjtf"><div class="text">Mini Server</div></a>
						<div class="vline"></div>
						<a href="#cdb-details-prjtf" id="cdb_prjtf"><div class="text">ChrisDonBot</div></a>
						<div class="vline"></div>
						<a href="#mb-details-prjtf" id="mb_prjtf"><div class="text">MacroBot</div></a>
						<div class="vline"></div>
						<a href="../miniserver/miniserver-aquisition.php" id="gtc_prjtf"><div class="text">Goto Controllers >></div></a>
						<div class="vline"></div>
						
					</div>
					
				</div>
				
					<br/>
					<h2 class="hdr-text" id="mb-details-prjtf">MacroBot</h2>
					<div class="dotted-hline"></div>
					<div class="image-container">
						<img src="../../img/dum_img1.jpg" style="height:480px; width:720px;" alt="HOME IMAGE">
					</div>
					<p class="text">
						It is a cart design type of robot; Macron will be a “side-kick” agent to ultimately solve the
problem in the data center. There are portion in the room of the data center where only tiny
objects can pass through or able to get in. Some edge of rack, tied cables under the panels are
difficult to be observed even presence of an IT people. MacronBot is specifically design for the
said task, it is able to penetrate small area underneath and is able to capture specified target by
using its on boarded tiny camera. When CrisdonBot is not able to reach a certain height of a
rack or panel, then he will toss McronBot to reach that level, and therein the side-kick robot will
monitor all the parameters necessary for the environment. This McronBot robot will have an on-
board module of sensors. In this role the robot behaves like a mobile sensor, feeding its data into
bulk or arrays of servers and equipments. All data collected by the robot are stored in the
database for possible subsequent analysis.<br/>
						<a class="atag-pfp" href="../macrobot/macrobot-aquisition.php">MacRon Robot>></a>
					</p>
					
				</div>
				<div class='clear' style='clear:both;'></div>
			</div>
		</div>
	</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
	
</body>
</html>





