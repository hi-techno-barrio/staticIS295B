<?php


$init="wlp9s0";
echo exec("cat /sys/class/net/$init/statistics/rx_bytes");


?>
