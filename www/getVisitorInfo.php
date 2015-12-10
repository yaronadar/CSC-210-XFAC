<?php
//Moses Chen - mchen37@u.rochester.edu
//Yaron Adar - yadar@u.rochester.edu

//Get input and initialize output
$visitor_netid = $_REQUEST["q"];
$return = array();

//SETUP THE CONNECTION
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "xfac";
$error = " ";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
	die("Connection failed: ".$conn->connect_error);
	$error = $error."dead connection";
}

//SQL QUERIES
//Get Visitor Info
$sql = "SELECT * FROM Visitors WHERE visitor_netid='$visitor_netid'";
$visitor = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	
	
//Get Visitor's Abilities Info
$sql = "SELECT * FROM Abilities WHERE visitor_netid='$visitor_netid'";
$result2 = mysqli_query($conn, $sql);
$abilities = array();//array to hold the visitor's abilities info

	//Create an array of ability and corresponding employee/facility info
$ability_count = 0;
while($row1 = mysqli_fetch_assoc($result2)) {
	$ability_employee = $row1["employee_netid"];
	$row2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT facility FROM Employees WHERE employee_netid='$ability_employee'"));
	$abilities[$ability_count] = array_merge($row1, $row2);
	
	$ability_count++;
}
echo "{\"Info\":[".json_encode($visitor)."], \"Abilities\":".json_encode($abilities)."}";
?>