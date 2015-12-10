<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
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
$query = "SELECT * FROM Employees WHERE employee_netid = '".$netid."'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
	$userExists = true;
}
else {
	$userExists = false;
}
$result = mysqli_query($conn, $query);
$hash = mysqli_fetch_object($result)->password;
if (password_verify($pass, $hash))
	$passwordCorrect = true;
else
	$passwordCorrect = false;

mysqli_close($conn);

if ($userExists && $passwordCorrect) {
	setcookie('netid', $netid, time()+60*60*24*365, '/');
	setcookie('pass', $hash, time()+60*60*24*365, '/');
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