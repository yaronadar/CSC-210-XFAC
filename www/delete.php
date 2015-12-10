<?php
//Moses Chen - mchen37@u.rochester.edu
//Yaron Adar - yadar@u.rochester.edu

$netid = $_POST['netid'];

$server = "localhost";
$username = "root";
$password = "mysql";
$db = "xfac";
$error = "";
$conn = mysqli_connect($server, $username, $password, $db);

if (!$conn) {
	die("Connection failed: ".$conn->connect_error);
	$error = $error."dead connection";
}

$query = "DELETE FROM Employees WHERE employee_netid = '".$netid."'";
$result = mysqli_query($conn, $query);
if (mysqli_affected_rows($conn) > 0) {
	unset($_COOKIE['netid']);
	unset($_COOKIE['pass']);
    setcookie('netid', '', time() - 3600, '/');
	setcookie('pass', '', time() - 3600, '/');
	echo 'yes';
}
else {
	echo 'no';
}

mysqli_close($conn);
?>