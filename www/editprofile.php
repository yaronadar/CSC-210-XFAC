<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<?php
if (!isset($_COOKIE['netid']) || !isset($_COOKIE['pass'])) {
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
		<title>
			UR XFAC - Edit Profile
		</title>
		<style>
			div#nav {
				margin: 0;
				padding: .3em 0 .3em 0;
				background: #80B3FF;
				width: 100%;
				text-align: center;
			}
			div#nav ul {
			   list-style: none;
			   margin: 0;
			   padding: 0;
			}
			div#nav ul li {
			   margin: 0;
			   padding: 0;
			   display: inline;
			}
			div#nav ul a:link {
			   margin: 0;
			   padding: .3em .4em .3em .4em;
			   text-decoration: none;
			   font-weight: bold;
			   font-size: medium;
			   color: #0047B3;
			}
			div#nav ul a:visited {
			   margin: 0;
			   padding: .3em .4em .3em .4em;
			   text-decoration: none;
			   font-weight: bold;
			   font-size: medium;
			   color: #0052CC;
			}
			div#nav ul a:active {
			   margin: 0;
			   padding: .3em .4em .3em .4em;
			   text-decoration: none;
			   font-weight: bold;
			   font-size: medium;
			   color: #0052CC;
			}
			div#nav ul a:hover {
			   margin: 0;
			   padding: .3em .4em .3em .4em;
			   text-decoration: none;
			   font-weight: bold;
			   font-size: medium;
			   color: #FFFFFF;
			   background-color: #0052CC;
			}
			div#login {
				text-align: center;
			}
			a {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<img src="URXFAC.png"/>
		
		<div id="nav">
			 <ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="portal.php">Portal</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		
		<h1 style="font-family:verdana;text-align:center">
			Edit Profile
		</h1>
		
		<br/>
		
		<div id="edit" style="text-align:center">
			<form name="edit" method="post" action="edit.php">
				<?php
				echo '<input hidden name="netid" type=text value="'.$netid.'"/>';
				echo 'First Name: <input name="first" type=text value="'.$first.'" size="30"/>';
				echo '</br>';
				echo 'Last Name: <input name="last" type=text value="'.$last.'" size="30"/>';
				echo '</br>';
				echo 'Email: <input name="email" type=text value="'.$email.'" size="30"/>';
				echo '</br>';
				echo 'Facility: <input name="facility" type=text value="'.$facility.'" size="30"/>';
				?>
				<br/>
				<input type="submit" value="Submit"/> <input type="reset"value="Cancel"/>
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