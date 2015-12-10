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

mysqli_close($conn);
?>
<html>
	<head>
		<title>UR XFAC - Edit Profile</title>
		<?php include 'header.php' ?>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		
		<h1 style="text-align: center;">
			Edit Profile
		</h1>
		
		<br/>
		
		<div class="container" style="width: 60%; margin: 0px auto; text-align: left;">
			<form role="form" name="edit" method="post" action="edit.php">
				<div class="row">
					<div class="col-xs-6">
						<?php
						echo '<input hidden name="netid" type=text value="'.$netid.'"/>';
						echo 'First Name: <input name="first" class="form-control" type=text value="'.$first.'" size="30"/>';
						echo '</br>';
						echo 'Last Name: <input name="last" class="form-control" type=text value="'.$last.'" size="30"/>';
						echo '</div>';
						echo '<div class="col-xs-6">';
						echo 'Email: <input name="email" class="form-control" type=text value="'.$email.'" size="30"/>';
						echo '</br>';
						echo 'Facility: <input name="facility" class="form-control" type=text value="'.$facility.'" size="30"/>';
						?>
					</div>
				</div>
				<br/>
				<div style="text-align: center;">
					<input type="submit" class="btn btn-default" value="Submit"/> <input type="reset" class="btn btn-default" value="Cancel"/>
				</div>
			</form>
		</div>
		
		<?php
		if (isset($_GET['return'])) {
			$return = $_GET['return'];
			if ($return == 1) {
				echo '<div style="text-align:center">';
				echo 'Profile updated successfully.';
				echo '</div>';
				echo '</br>';
			}
			else {
				echo '<div style="text-align:center">';
				echo 'Error while updating profile. Please try again.';
				echo '</div>';
				echo '</br>';
			}
		}
		?>
	</body>
</html>