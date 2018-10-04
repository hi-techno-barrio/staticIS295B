


<?php
    session_start();
    session_destroy();
    session_start();

    if (isset($_POST['button']))
    {
         exec('/usr/bin/node /var/www/html/staticDCMS/includes/main/termulator/app.js -p 777 &');
        

    }
    
    
    function get_server_memory_usage(){
 
	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2]/$mem[1]*100;
 
	return $memory_usage;
}

function get_server_cpu_usage(){
 
	$load = sys_getloadavg();
	return $load[0];
 
}

?>

    
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
 
 <script id="source" language="javascript" type="text/javascript">
				
            $(document).ready(function() {
                var options = {
                    lines: { show: true },
                    points: { show: true },
                    xaxis: { mode: "time" }
                };
                var data = [];
                var placeholder = $(".displayarea");
    
                $.plot(".displayarea", data, options);
    
                var iteration = 0;
    
                function fetchData() {
                    ++iteration;
    
                    function onDataReceived(series) {
                        // we get all the data in one go, if we only got partial
                        // data, we could merge it with what we already got
                        data = [ series ];
                        
                        $.plot($(".displayarea"), data, options);
                        fetchData();
                    }
    
                    $.ajax({
                        url: "data.php",
                        method: 'GET',
                        dataType: 'json',
                        success: onDataReceived
                    });
                    
                }
    
                setTimeout(fetchData, 100);
            });
    
        </script>
</head>

<body>
<div class="dscmscontainer">
	<div class="dscmswrapper">
		<?php 
			$globalPath ="../";
			include("{$globalPath}main/header.php");
		?>
		<div class="pagecontent">
			<div id="chrisdonbot-system-setting"  class="projects">
				<?php include("{$globalPath}chrisdonbot/chrisdonbar.php");?>
				<div class="rightsidebar">
					<div id="hdr-disparea">
						<div id="sys-rtd">
							<div class="label-stat"><span>System:</span>CHRISDONBOT</div>
							<div class="label-stat"><span>System Setting</div>
						</div>
						<div id="grph">
							<div class="label-stat"><span>Graph:</span> Data Bandwidth</div>
						</div>
					</div>
					<div class="displayarea"></div>
					<p><span class="description">Server Memory Usage:</span> <span class="result"><?= get_server_memory_usage() ?>%</span></p>
                    <p><span class="description">Server CPU Usage: </span> <span class="result"><?= get_server_cpu_usage() ?>%</span></p>
				</div>
				<div class='clear' style='clear:both;'></div>
			</div>
		</div>
		
	<!--	<button type="submit" name="button">Run Perl</button>  -->
	</div>
	<?php include("{$globalPath}main/footer.php");?>
</div>
</body>
</html>
