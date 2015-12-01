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
			body {
				background-color: #f2f2f2;
				color: #000000;
				font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				font-weight: 300;
				font-size: 16px;
			}
			
			#nav {
				text-align: center;
				width: 100%;
			}
			
			.logo {
				padding-left: 20px;
				display: inline;
				float:left;
			}
			
			nav {
				background-color: #ffffff;
				border-radius: 5px;
				display: inline-block;
				margin: 10px 20px 10px 20px;
				overflow: hidden;
				width: 85%;
			}

			nav ul {
				margin: 0;
				padding: 0;
				text-align: left;
			}

			nav ul li {
				display: inline-block;
				list-style-type: none;

				-webkit-transition: all 0.2s;
				-moz-transition: all 0.2s;
				-ms-transition: all 0.2s;
				-o-transition: all 0.2s;
				transition: all 0.2s; 
			}

			nav > ul > li > a {
				color: #000000;
				display: block;
				line-height: 55px;
				padding: 0 24px;
				text-decoration: none;
			}

			nav > ul > li:hover {
				background-color: rgb(40, 44, 47);
			}

			nav > ul > li:hover > a {
				color: rgb(255, 255, 255);
			}
			
			a {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div id="nav">
			<img class="logo" src="URXFAC.png"/>
			<nav>
				<ul>
					<!-- Comments to remove whitespace between li elements -->
					<li><a href="home.php">Home</a></li><!--
				 --><li><a href="profile.php">Profile</a></li><!--
				 --><li><a href="portal.php">Portal</a></li><!--
				 --><li><a href="Logout.php">Logout</a></li>
				</ul>
			</nav>
		</div>
		
		<h1 style="font-family:verdana;text-align:center">
			Edit Profile
		</h1>
		
		<br/>
		
		<div id="edit" style="width:25%; margin: 0px auto; text-align:left">
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
				<div style="text-align:center;">
					<input type="submit" value="Submit"/> <input type="reset"value="Cancel"/>
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