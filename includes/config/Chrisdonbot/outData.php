<?php 

  //-------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "robook1234";

  $databaseName = "dcmsDB";
  $tableName = "Chrisdonbot";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  // include 'DB.php';
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $sql = "SELECT (UNIX_TIMESTAMP(DayTime)*1000) as stamp, hmdty0,temp0,hmdty1,temp1,hmdty2,temp2,hmdty3,temp3  FROM Chrisdonbot order by sensorid DESC Limit 1 ";          
//query

  //$result = mysqli_query($link, $sql, MYSQLI_USE_RESULT);
  $result = mysql_query($sql) or die(mysql_error());
  $array = mysql_fetch_row($result);   

//  print_r($array);
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($array);
  
?>
