<?php
    session_start();
    session_destroy();
    session_start();
    // Function for real IP address
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// Function to get the client ip address
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}


// Function to get the client ip address
function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}
   
    ?>
    <html>
        <head>
            <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
            <script type="text/javascript" src="js/jquery.flot.js"></script>
            
            <script id="source" language="javascript" type="text/javascript">
            $(document).ready(function() {
                var options = {
                    lines: { show: true },
                    points: { show: true },
                    xaxis: { mode: "time" }
                };
                var data = [];
                var placeholder = $("#placeholder");
    
                $.plot(placeholder, data, options);
                alert(OK);
                var iteration = 0;
    
                function fetchData() {
                    ++iteration;
    
                    function onDataReceived(series) {
                        // we get all the data in one go, if we only got partial
                        // data, we could merge it with what we already got
                        data = [ series ];
                        
                        $.plot($("#placeholder"), data, options);
                        fetchData();
                    }
    
                    $.ajax({
                        url: "data.php",
                        method: 'GET',
                        dataType: 'json',
                        success: onDataReceived
                    });
                    
                }
    
                setTimeout(fetchData, 1000);
            });
    
        </script>
        </head>
        <body>
			<?php
	    // Get the client ip address
          $ipaddress = $_SERVER['REMOTE_ADDR'];
          echo 'Your IP address (using $_SERVER[\'REMOTE_ADDR\']) is ' . $ipaddress . '<br />';
          echo 'Your IP address (using get_client_ip_env function) is ' . get_client_ip_env() . '<br />';
         echo 'Your IP address (using get_client_ip_server function) is ' . getRealIpAddr() . '<br />';
          ?>
        <div id="placeholder" style="width:600px;height:300px;"></div>
        </body>
    </html>
