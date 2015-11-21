<?php
$netid = $_POST['netid'];
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$facility = $_POST['facility'];

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

$first = mysqli_real_escape_string($conn, $first);
$last = mysqli_real_escape_string($conn, $last);
$email = mysqli_real_escape_string($conn, $email);
$facility = mysqli_real_escape_string($conn, $facility);

$query = "UPDATE Employees SET
 firstname = '".$first."',
 lastname = '".$last."',
 email = '".$email."',
 facility = '".$facility."'
 WHERE employee_netid = '".$netid."'";
$result = mysqli_query($conn, $query);

mysqli_close($conn);

if ($result) {
    header("Location: editprofile.php?return=1");
	exit;
}
else {
    header("Location: editprofile.php?return=2");
	exit;
}
?>