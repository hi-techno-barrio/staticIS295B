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
			<div id="home-page">
				<p class="text">Data Center management has evolved from a simple alert system into a critical element that
enables maximum availability, cost efficiency, and controllability. As the data centers grow
larger, data center management techniques are growing at an enormous rate with attendant
critical issues to overcome. The paper presented here is the application of a supervisory web-
based information and control system of the Data Center management system. The overall
system design is achieved through arrayed sensors linked to a stationary embedded server with
collaborative mobile robots on-boarded with sensors. The mobile telerobotic elements are able
to assess the physical condition of the environment inside the Data Center, and mobile robots
work as dynamic agents that can conduct testing and maintenance collaboratively and
intelligently.</p>
				
				<div class="image-container">
					<img src="../../img/CrisdonBot.jpg" style="height:480px; width:720px;" alt="HOME IMAGE">
				</div>
				
				<p class="text">The project is composed of the following three novel mechanisms: standard architecture of information systems 
				of hybrid remote control system; efficient patentable ladder transformations of lightweight DC robots carrying another tiny robot;
				 and a simple yet efficient semi-autonomous “Cobe algorithm” for Data Center mobile robots.</p>
				<div class="image-container"></div>
			</div>
		</div>
	</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
	
</body>
</html>
