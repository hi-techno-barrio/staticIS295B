
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
    <script type="text/javascript" src="../../js/custom/chrisdonbot/chrisdonbot-data-controller.js"></script>
</head>

<body>
<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
			$globalPath = "../";
			 $localIP = explode(' ',explode(':',explode('inet addr',explode('wlp9s0',trim(`ifconfig`))[1])[1])[1])[0];
			include("{$globalPath}main/header.php");
                         echo $localIP;
		?>
		<div class="pagecontent">
			<div id="chrisdonbot-data-controller" class="projects">
				<?php include("{$globalPath}chrisdonbot/chrisdonbar.php");?>
				<div class="rightsidebar">
					<div id="hdr-disparea">
						<div id="sys-rtd">
							<div class="label-stat"><span>System:</span>ChrisDonBot</div>
							<div class="label-stat"><span>Data Controller</span></div>
						</div>
						<div id="grph">
							<div class="label-stat"><span>Graph:</span> Analog Data</div>
						</div>
					</div> <!-- hdr-disparea -->
					<div class="displayarea" style="height:150px; margin-bottom:10px;"></div>
					    <div class="videoarea" style="margin-bottom:10px;">
						   <div class="vdcontent"> <iframe  src="<?php echo "http://{$localIP}:8050/?action=stream"; ?>"width="750" height="400" > </iframe> 
						   </div> <!-- "vdcontent" -->
						</div> <!-- videoarea -->
						
						<div class='clear' style='clear:both;'></div>
					</div><!-- displayarea -->
					
					<?php include("{$globalPath}chrisdonbot/chrisdon_buttons.php");?>
				</div><!-- rightsidebar -->
				<div class='clear' style='clear:both;'></div>
			</div><!-- chrisdonbot-data-controller -->
			
		</div><!-- pagecontent-->
	</div><!-- dscmswrapper-->
	<?php include("{$globalPath}main/footer.php");?>
</div><!-- dscmcontainer-->

<script type="text/javascript" src="../../js/custom/chrisdonbot/serialIO.js"></script>
</body>
</html>
