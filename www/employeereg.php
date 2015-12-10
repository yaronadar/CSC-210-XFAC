<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<?php
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

$employee_netid = $_POST["employee_netid"];
$password = $_POST["password"];
$password = password_hash($password, PASSWORD_DEFAULT);
$facility = $_POST["facility"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$date = date("Y:m:d H:i:s");

$userExists = false;
$query1 = "SELECT * FROM Employees WHERE employee_netid = '".$netid."'";
$result1 = mysqli_query($conn, $query1);
if (mysqli_num_rows($result1) > 0) {
	$userExists = true;
}
else {
	$userExists = false;
}

if ($userExists) {
	header("Location: registration.php?error=1");
    exit;
}

$sql = "INSERT INTO Employees(employee_netid, password, facility, firstname, lastname, email, reg_date)
VALUES('$employee_netid', '$password', '$facility', '$firstname', '$lastname', '$email', '$date')";

if (mysqli_query($conn, $sql)) {
	header("Location: registration.php?error=0");
    exit;
}
else {
	header("Location: registration.php?error=2");
    exit;
}

mysqli_close($conn);
?>