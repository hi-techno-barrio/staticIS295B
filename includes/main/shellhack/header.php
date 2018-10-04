<div id="mainheader">
	 <?php    
	                   
             $GLOBALS['localIP'] = $_SERVER['SERVER_ADDR'];
                if($localIP==null)
                {                 
                  echo "no valid IP address";
                      }
	?><!--PHP Script -->
	<!--Banner-->
	
	<div id="banner">
		<div id="login">
			<a href="#">Login</a>
		</div>
		<div class="clear"></div>
	</div>
	<!--Navigation menu-->
	<div id="main_navigation">
			<!--HOME ABOUT PROJECTS CONTACT ADMIN-->
			<ul id="nav" class="menu">
				<!-- globalPath= "/localhost/staticDCMS/includes/"  -->
				
				<li><a href="<?php echo "http://{$localIP}/staticDCMS/includes/main/home.php"; ?>">HOME</a><div class="hline"></div></li>
				<li><a href="<?php echo "http://{$localIP}/staticDCMS/includes/main/about.php"; ?>">ABOUT</a><div class="hline"></div>
				<ul>
						<li><a href="?action=miniserver-aquisition" id="menu-miniserver">OVERVIEW</a></li><div class="vline"></div>
						<li><a href="?action=chrisdonbot-aquisition" id="menu-chrisbot">AUTHOR</a></li><div class="vline"></div>
			
						
					</ul>
				</li>
				<li><a href="<?php echo "http://{$localIP}/staticDCMS/includes/main/projects.php"; ?>">IS295B REMOTE</a><div class="hline"></div>
					<ul>
						<li><a href="?action=miniserver-aquisition" id="menu-miniserver">Xentrino</a></li><div class="vline"></div>
						<li><a href="http://192.168.1.39:4000/aquisition.html" id="menu-chrisbot">CrisDonBot</a></li><div class="vline"></div>
						<li><a href="http://192.168.1.38:4000/aquisition.html" id="menu-macrobot">MacroBot</a></li>
						
					</ul>
				</li>
				
					<li><a href="<?php echo "http://{$localIP}/staticDCMS/includes/main/report.php"; ?>">DATA AQUISITIONS</a><div class="hline"></div></li>
				<li><a href="<?php echo "http://{$localIP}/staticDCMS/includes/main/admin.php"; ?>">CONTROL PANEL</a></li>
                               <!-- <li><a href="<?php echo $globalPath.'main/index.php';?>">ADMIN</a></li>-->
			</ul>
		<div class="clear"></div>
	</div>
	<div class="divider"></div>
</div>
