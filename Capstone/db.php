<?php
$servername="db.luddy.indiana.edu";
$username="i494f22_team45";
$password="my+sql=i494f22_team45";
$dbname="i494f22_team45";

$conn= mysqli_connect($servername,$username,$password,$dbname);

if($conn->connect_error){
	die("Connection Failed".$conn->connect_error);
}else{
	//echo "connected";
}

?>