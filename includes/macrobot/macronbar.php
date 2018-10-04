
<div class="leftsidebar">
	<div class="panels">
		<div id="infosys">
			<div class="title-sb"><h1 id="title-info">Information System</h1></div>
				<nav class="sidemenu_stat">
					<div class="menu-item"><div class="parent-submenu"  id="mini_server"><div>Mini Server</div></div>
						<ul>
							<li><a href="../miniserver/miniserver-aquisition.php" class="real_data_aquisition" id="ms-rta">Real Time Aquisition</a></li>
							<li><a href="../miniserver/miniserver-system-setting.php" class="system_setting" id="ms-ss">System Setting</a></li>
						</ul>
					</div>
						<div class="menu-item"><div class="parent-submenu"  id="chris_bot"><div>ChrisDonBot</div></div>
							<ul>
								<li><a href="../chrisdonbot/chrisdonbot-aquisition.php" class="real_data_aquisition" id="cdb-rta">Real Time Aquisition</a></li>
								<li><a href="../chrisdonbot/chisdonbot-data-controller.php" class="data_controller" id="cdb-dc">Data Controller</a></li>
								<li><a href="../chrisdonbot/chrisdonbot-system-setting.php" class="system_setting" id="cdb-ss">System Setting</a></li>
							</ul>
						</div>
						<div class="menu-item"><div class="parent-submenu" id="macro_bot"><div>MacronBot</div></div>
							<ul>
								<li><a href="../macrobot/macrobot-aquisition.php" class="real_data_aquisition" id="mb-rta">Real Time Aquisition</a></li>
								<li><a href="../macrobot/macrobot-data-controller.php" class="data_controller" id="mb-dc">Data Controller</a></li>
								<li><a href="../macrobot/macrobot-system-setting.php" class="system_setting" id="mb-ss">System Setting</a></li>
							</ul>
						</div>
				</nav>
				<div class="footer-sb"></div>
		</div>
	</div>
	<div class="panels">
		<div class="vdcontent" style="display:none;">
			<div class="title-sb"><h1 id="notif">Notification message</h1></div>
			<div class="warn-disp floatLeft">
				Warning. Video is not activated yet.
				Warning. Video is not activated yet.
				Warning. Video is not activated yet.
			</div>	
			<div class="videoctrlbtns floatLeft">
				<span id="videost" class="vbtns push_button blue floatLeft">Video Stream</span>
				<span id="picsnap" class="vbtns push_button blue floatLeft">Picture Snapshot</span>
				<div class='clear' style='clear:both;'></div>
			</div>
			<div class="radio-btn">
				<span>
					<input type="radio" id="rbtn1" name="vsrctrl" value="vsone"><label>Vs Radio 1</label>
					<input type="radio" id="rbtn2" name="vsrctrl" value="vstwo"><label>Vs Radio 2</label>
				</span>
				<span>
					<input type="radio" id="rbtn3"  name="psrctrl" value="psone"><label>Ps Radio 1</label>
					<input type="radio" id="rbtn4" name="psrctrl" value="pstwo"><label>Ps Radio 2</label>	
				</span>
			</div>
			<div class="footer-sb"></div>
		</div>
	</div>
	<div class="panels">
		<div id="statusview">
			<div class="title-sb"><h1>Status</h1></div>
				<ul class="sidemenu">
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idlight" name="light" checked="checked" disabled/><label for="idlight"></label></div><div class="label">Light Level</div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idnoise" name="noise" checked="checked" disabled/><label for="idnoise"></label></div><div class="label">Noise </div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idsmoke" name="smoke" checked="checked" disabled/><label for="idsmoke"></label></div><div class="label">Smoke</div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idhmdty" name="hmdty" checked="checked" disabled/><label for="idhmdty"></label></div><div class="label">Humidity</div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idtemp" name="temp" checked="checked" disabled/><label for="idtemp"></label></div><div class="label">Temperature</div></li>
				
			</ul>
			<div class="footer-sb"></div>
		</div>
	</div>
	
</div>
