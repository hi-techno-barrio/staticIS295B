<?php

include ("connect.php"); 

$tableName 	= "chrisdonbot";
$query		= "SELECT date, (UNIX_TIMESTAMP(date)*1000) as stamp, hmdty0, temp0, hmdty1, temp1, hmdty2, temp2, hmdty3, temp3 FROM  $tableName where id = 0 order by date";
//$query		= "SELECT date, (NOW(date)*1000) as stamp, hmdty0, temp0, hmdty1, temp1, hmdty2, temp2, hmdty3, temp3 FROM $tableName ORDER by date";

if($result 	= $conn->query($query)){
	
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$data[] = $row;
    }
	//header('Content-Type: application/json; charset=UTF-8');
	//header('Content-Type: application/json');
	echo json_encode($data);
	
	$result->close();
}
/* free result set */

$conn->close();


