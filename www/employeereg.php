<?php

/*
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
*/

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

$nothing = 0;
$employee_netid = $_POST["employee_netid"];
$password = $_POST["password"];
$facility = $_POST["facility"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];


$sql = "INSERT INTO Employees(employee_netid, password, facility, firstname, lastname, email)
VALUES('$employee_netid', '$password', '$facility', '$firstname', '$lastname', '$email')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully for:<br />";
	echo $employee_netid."<br />";
	echo $facility."<br />";
	echo $firstname."<br />";
	echo $lastname."<br />";
	echo $email."<br />";
	
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
