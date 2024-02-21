<?php

include 'db_connection.php';
$con= OpenCon();

$k = $_GET["key"];					 
$time = $_GET["time"];
$powerused = $_GET["powerused"];

if ($k =="smarthomesystemproject")
{
	$sql ="INSERT INTO data2 (time,powerused) VALUES ('$time','$powerused')";
	mysqli_query($con, $sql); 
	
	
	echo "<br>Done!";
}

CloseCon($con);


?>