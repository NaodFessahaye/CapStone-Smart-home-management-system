<?php
function OpenCon()
{
	$con= mysqli_connect("fdb1030.awardspace.net", "4280936_smarthomedata",
                     "Hiwet#2000", "4280936_smarthomedata", "3306");
	return $con;
 }
 
function CloseCon($con)
{
	$con -> close();
}
   
?>