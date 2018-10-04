<!DOCTYPE html>
<html>
<head>
	<title>MacRonbot</title>
	<link rel="stylesheet" type="text/css" href="../../css/default.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css"/>
    <script type="text/javascript" src="../../js/library/jquery.js" ></script>
    <script type="text/javascript" src="../../js/library/jquery-ui.js"></script>
    <script type="text/javascript" src="../../js/custom/jqscript.js"></script>
	<script type="text/javascript" src="../../js/library/gjquery.js"></script>
	<script type="text/javascript" src="../../js/library/jquery.flot.js"></script>
	<script type="text/javascript" src="../../js/library/jquery.flot.time.js"></script>
    <script type="text/javascript" src="../../js/custom/macrobot/macrobot-aquisition.js"></script>
</head>

<body>
<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
			$globalPath = "../";
			include("{$globalPath}main/header.php");
		?>
		<div class="pagecontent">
			<div id="macrobot-system-setting"  class="projects">
				<?php include("{$globalPath}macrobot/macronbar.php");?>
				<div class="rightsidebar">
					<div id="hdr-disparea">
						<div id="sys-rtd">
							<div class="label-stat"><span>System:</span>MacronBot</div>
							<div class="label-stat"><span>System Setting</div>
						</div>
						<div id="grph">
							<div class="label-stat"><span>Graph:</span> Analog Data</div>
						</div>
					</div>
					<div class="displayarea"></div>
					
				</div>
				<div class='clear' style='clear:both;'></div>
			</div>
		</div>
	</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
</body>
</html>
