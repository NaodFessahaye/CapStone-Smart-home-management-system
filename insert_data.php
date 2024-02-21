<?php

include 'db_connection.php';
$con= OpenCon();

$k = $_GET["key"];					 
$state = $_GET["state"];

if ($k =="smarthomesystemproject")
{
	$sql ="INSERT INTO data (state) VALUES ('$state')";
	mysqli_query($con, $sql); 
	
	
	echo "<br>Done!";
}

CloseCon($con);


?>

