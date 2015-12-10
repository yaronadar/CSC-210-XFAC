<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<?php
$verified = (include 'verifyCookie.php');
if (!$verified) {
    header("Location: login.php");
    exit;
}
$netid = $_COOKIE['netid'];

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

$query = "SELECT * FROM Employees WHERE employee_netid = '".$netid."'";
$result = mysqli_query($conn, $query);
$first = mysqli_fetch_object($result)->firstname;
$result = mysqli_query($conn, $query);
$last = mysqli_fetch_object($result)->lastname;
$result = mysqli_query($conn, $query);
$email = mysqli_fetch_object($result)->email;
$result = mysqli_query($conn, $query);
$facility = mysqli_fetch_object($result)->facility;
$result = mysqli_query($conn, $query);
$date = mysqli_fetch_object($result)->reg_date;

mysqli_close($conn);
?>
<html>
	<head>
		<title>UR XFAC - Profile</title>
		<?php include 'header.php' ?>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		
		<h1 style="text-align:center;">
			Profile
		</h1>
		
		<div name="profile" style="width: 30%; margin: 0px auto; text-align: left;">
			<?php
			echo "NetID: ".$netid;
			echo "</br>";
			echo "First Name: ".$first;
			echo "</br>";
			echo "Last Name: ".$last;
			echo "</br>";
			echo "Email: ".$email;
			echo "</br>";
			echo "Facility: ".$facility;
			echo "</br>";
			echo "Date Registered: ".$date;
			?>
		</div>
		
		</br>
		
		<div style="text-align:center;">
			<button class="btn btn-default" onclick="editProfile()">Edit Profile</button>
		</div>
		
		<br/>
		<br/>
		<br/>
		
		<div style="text-align:center;">
		<?php
		if (isset($_GET['error'])) {
			$error = $_GET['error'];
		?>
		<?php if ($error == 1) : ?>
			<div style="text-align: center;">
				Error while deleting account. Please try again.
			</div>
		<?php else : ?>
			<div style="text-align: center;">
				Unknown error. Please try again.
			</div>
		<?php endif; } ?>
		
		<button class="btn btn-default" onclick="deleteAccount()">Delete Account</button>
			
			<script>
			function editProfile() {
				window.location.replace("/editprofile.php");
			}
			function deleteAccount() {
				window.location.replace("/deleteaccount.php");
			}
			</script>
		</div>
		</br>
	</body>
</html>