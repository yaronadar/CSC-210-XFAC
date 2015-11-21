<?php
$netid = $_POST['netid'];
$pass = $_POST['pass'];

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

$userExists = false;
$passwordCorrect = false;
$query1 = "SELECT * FROM Employees WHERE employee_netid = '".$netid."'";
$query2 = "SELECT * FROM Employees WHERE employee_netid = '".$netid."' AND password = '".$pass."'";
$result1 = mysqli_query($conn, $query1);
$result2 = mysqli_query($conn, $query2);
if (mysqli_num_rows($result1) > 0) {
	$userExists = true;
}
else {
	$userExists = false;
}
if (mysqli_num_rows($result2) > 0) {
	$passwordCorrect = true;
}
else {
	$passwordCorrect = false;
}

mysqli_close($conn);

if ($userExists && $passwordCorrect) {
	setcookie('netid', $netid, time()+60*60*24*365, '/');
	setcookie('pass', md5($pass), time()+60*60*24*365, '/');
	header("Location: profile.php");
    exit;
}
elseif ($userExists && !$passwordCorrect) {
	header("Location: login.php?error=1");
	exit;
}
else {
	header("Location: login.php?error=2");
	exit;
}
?>