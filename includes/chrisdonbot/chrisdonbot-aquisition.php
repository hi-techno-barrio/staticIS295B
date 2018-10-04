

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
	<script type="text/javascript" src="../../js/library/jquery.flot.time.js"></script>
    <script type="text/javascript" src="../../js/custom/chrisdonbot/chrisdonbot-aquisition.js"></script>
</head>


<body>

<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
		 	$globalPath = "../";
			include("{$globalPath}main/header.php");
		?>
		<div class="pagecontent">
			<div id="chisdonbot-aquisition" class="projects">
				<?php include("{$globalPath}chrisdonbot/chrisdonbar.php");?>
				<div class="rightsidebar">
					<div id="hdr-disparea">
						<div id="sys-rtd">
							<div class="label-stat"><span>System:</span>CHRISDONBOT</div>
							<div class="label-stat"><span>Real Time Data:</span>ACQUISITION</div>
						</div>
						<div id="grph">
							<div class="label-stat"><span>Graph:</span> TEMPERATURE</div>
						</div>
					</div>
					<div class="displayarea"></div>
					<?php include("{$globalPath}chrisdonbot/chrisdon_buttons.php");?>
				</div>
				<div class='clear' style='clear:both;'></div>
			</div>
		</div>
	</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
</body>
</html>
