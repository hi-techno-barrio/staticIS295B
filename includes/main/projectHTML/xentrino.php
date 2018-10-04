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
				<div id="right-prjt" style="float:right; width:735px;">
					<h2 class="hdr-text" id="ms-details-prjtf">Mini Server</h2>
					<div class="dotted-hline"></div>
					<div class="image-container">
						<img src="../../img/miniServer.jpg" style="height:480px; width:720px;" alt="HOME IMAGE">
					</div>
					<p class="text">
						A main monitoring system is important, the functions of the device is to give a constant analysis
of various parameters that may affects the full activity of the data center. This tiny server in the
project is the most active monitor all throughout the data center system operations. The server
monitors provide a way to remotely monitor data-center conditions, view historical data to spot
trends, and receive alerts when conditions exceed pre-defined thresholds. With comprehensive
monitoring in place, a spike in operating temperature due to a shifted workload, a buildup of
condensation in a single rack, or excessive humidity along a row of equipment will be noticed
quickly. To make that information available to the appropriate data center staff, server probes of
sensors can be monitored via any standard Web browser, without requiring installations of any
proprietary software on a host PC to access the monitoring units.
						<br/>
						<a href="../miniserver/miniserver-aquisition.php" class="atag-pfp"  >Mini Server >></a>
					</p>
					<br/>
					<h2 class="hdr-text" id="cdb-details-prjtf">ChrisDonBot</h2>
					<div class="dotted-hline"></div>
					<div class="image-container">
						<img src="../../img/CrisdonBot.jpg" style="height:480px; width:720px;" alt="HOME IMAGE">
					</div>
					<p class="text">
						It is a unicycle maneuvering type robot. The most fundamental role that will showcase for this
ChrisdonBot being placed in our Data Center and autonomously mapping and taking series of
temperature, and humidity readings .This macro robot will have an on-board module of sensors.
In this role the robot behaves like mobile sensors, feeding its data into bulk or arrays of servers
and equipments. As the layout and sensed data profile are being generated, the user can observe
their dynamic evolution, along with the ever-changing location of the robot. All data collected
by the robot are stored in the database for possible subsequent analysis.
						<br/>
						<a class="atag-pfp" href="../chrisdonbot/chrisdonbot-aquisition.php">Chrisdon Robot >></a>
					</p>
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



