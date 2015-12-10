<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<?php
$netid = $_COOKIE['netid'];
$pass = $_COOKIE['pass'];

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

$cookieVerified = false;
$query = "SELECT * FROM Employees WHERE employee_netid = '".$netid."' AND password = '".$pass."'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
	$cookieVerified = true;
}
else {
	$cookieVerified = false;
}

mysqli_close($conn);

if ($cookieVerified) {
	return true;
}
else {
	return false;
}
?>