<?php 

  //-------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "robook1234";

  $databaseName = "dcmsDB";
  $tableName = "Xentrino";
  
 // session_start();

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  // include 'DB.php';
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------




$result = mysql_query("SELECT Daytime, (UNIX_TIMESTAMP(Daytime)*1000) as stamp, Smoke FROM Xentrino order by sensorid  DESC Limit 250");
//$result = mysql_query("SELECT (UNIX_TIMESTAMP(date)*1000) as stamp, temp  FROM p00602 order by id ");

$data = array();
//$_session['data'] = array();
//$i = 0;
$max = 0;

if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}

//unset($_session['data']);

while($row = mysql_fetch_array($result))
{
  $data[] = array( $row['stamp'], $row['Smoke'] );
  
}


  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($data);
//print_r($_session['data']);

?>

