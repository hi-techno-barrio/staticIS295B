<?php
$host 			= "localhost";
$user 			= "root";
$pass			= "";

$db 			= "dcmsdb";

$conn 			= new mysqli($host, $user, $pass, $db);

// check connection
if($conn->connect_error){
	die("connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
