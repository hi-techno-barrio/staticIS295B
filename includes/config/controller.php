<?php

//https://github.com/mdlayher/serial/blob/master/src/serial/serial.php
$verz="1.0";
$comPort = "/dev/ttyUSB0"; /*change to correct com port */

if (isset($_POST["rcmd"])) {
$rcmd = $_POST["rcmd"];


switch ($rcmd) 
{
	
  case 'Stop':
    serialWrite($comPort,1);
  break;
  
  case 'Slow':
    serialWrite($comPort,2);
  break;
  
  case 'Medium':
    serialWrite($comPort,3);
  break;
  
  case 'Fast':
    serialWrite($comPort,4);
  break;
  
 case 'Right':
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

<html>
<body>

<center><h1>Arduino from PHP Example</h1><b>Version <?php echo $verz; ?></b></center>

<form method="post" action="<?php echo $PHP_SELF;?>">
&nbsp&nbsp&nbsp&nbsp
<input type="submit" value="Left" name="rcmd">
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="submit" value="Right" name="rcmd"><br/>
<br />
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="submit" value="Stop" name="rcmd"><br/>
<br />
&nbsp&nbsp&nbsp
<input type="submit" value="Slow" name="rcmd">
<input type="submit" value="Medium" name="rcmd">
<input type="submit" value="Fast" name="rcmd">
<br />
<br />
<br />
<br />
<br />
<br />

</form>
</body>
</html> 
