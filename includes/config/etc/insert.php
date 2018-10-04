<?php

include 'connect.php';
/*$sql = "INSERT INTO crisdonbot(hmdty0, temp0, hmdty1, temp1, hmdty2, temp2, hmdty3, temp3)
VALUES(5,6,2,5,6,67,8,89)";*/

//$date = $_POST['date'];
$hmdty0 = $_POST['hmdty0'];
$temp0 	= $_POST['temp0'];
$hmdty1 = $_POST['hmdty1'];
$temp1 	= $_POST['temp1'];
$hmdty2 = $_POST['hmdty2'];
$temp2 	= $_POST['temp2'];
$hmdty3 = $_POST['hmdty3'];
$temp3 	= $_POST['temp3'];



$sql = 'UPDATE chrisdonbot SET date=NOW(), hmdty0="'.$hmdty0.'", temp0="'.$temp0.'", hmdty1="'.$hmdty1.'", 
		temp1="'.$temp1.'", hmdty2="'.$hmdty2.'", temp2="'.$temp2.'", hmdty3="'.$hmdty3.'", temp3="'.$temp3.'" WHERE id="0"';

if(mysqli_query($conn,$sql)){
	echo "New record created successfully.";
	echo $sql;
}
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);