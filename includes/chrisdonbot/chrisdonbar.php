
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
					<input type="radio" id="rbtn3" name="psrctrl" value="psone"><label>Ps Radio 1</label>
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
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idhmdty0" name="hmdty0"  checked="checked"  disabled/><label for="idhmdty0"></label></div><div class="label">Humidity-A    </div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idtemp0"  name="temp0"   checked="checked"  disabled/><label for="idtemp0"></label></div><div  class="label">Temperature-A </div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idhmdty1" name="hmdty1"  checked="checked"  disabled/><label for="idhmdty1"></label></div><div class="label">Humidity-B    </div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idtemp1"  name="temp1"   checked="checked"  disabled/><label for="idtemp1"></label></div><div  class="label">Temperature-B </div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idhmdty2" name="hmdty2"  checked="checked"  disabled/><label for="idhmdty2"></label></div><div class="label">Humidity-C    </div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idtemp2"  name="temp2"   checked="checked"  disabled/><label for="idtemp2"></label></div><div  class="label">Temperature-C </div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idhmdty3" name="hmdty3"  checked="checked"  disabled/><label for="idhmdty3"></label></div><div class="label">Humidty-D     </div></li>
				<li class="stat_item"><div class="switch"><input type="checkbox" id="idtemp3"  name="temp3"   checked="checked"  disabled/><label for="idtemp3"></label></div><div  class="label">Temperature-D </div></li>
				
			</ul>
			<div class="footer-sb"></div>
		</div>
	</div>
	
</div>
