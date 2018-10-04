<?php

//https://github.com/mdlayher/serial/blob/master/src/serial/serial.php
$verz="1.0";


if (isset($_POST["videocmd"])) {
$rcmd = $_POST["videocmd"];


switch ($rcmd) 
{
	
  case 'Start':
    serialWrite($comPort,1);
  break;
  
  case 'Restart':
    serialWrite($comPort,2);
  break;
  
  case 'Stop':
    serialWrite($comPort,3);
  break;
  
  case 'Resolution':
    serialWrite($comPort,4);
  break;
  
 case 'FrameRate':
     serialWrite($comPort,5);
  break;
  
case 'Left':
    serialWrite($comPort,6);
  break;
default:
  die('Crap, something went wrong. The page just puked.');
 }

} //If condition.....

function serialWrite( $comPort,$data )
{
  $fp =fopen($comPort, "w");
  sleep(0.125);
  fwrite($fp, $data); /* this is the number that it will write */
  fclose($fp);
  return;
  
} //serialWrite

function serialRead( $comPort,$count )
{
   
  $fp =fopen($comPort, "r");
  echo fread($fp, $count); /* this is the number that it will write */
  fclose($fp);
  return;
  
} //serialWrite

function serialConfig( $path,$port,$baudrate )
{
	$comPort = "/dev/ttyUSB0"; 
 
} //serialWrite

$PHP_SELF="controller.php";
?>





