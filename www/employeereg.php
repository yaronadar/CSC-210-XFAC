<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<?php
if (isset($_COOKIE['netid']) && isset($_COOKIE['pass'])) {
    header("Location: profile.php");
    exit;
}
?>
<html>
	<head>
		<title>
			UR XFAC - Registration
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
			div#registration {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<img src="URXFAC.png"/>
		
		<div id="nav">
			 <ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="profile.php">My Profile</a></li>
				<li><a href="portal.php">Portal</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="registration.php">Registration</a></li>
			</ul>
		</div>
		
		<h1 style="font-family:verdana;text-align:center">
			Registration
		</h1>
		
		<br/>
		
		<div name="registered" style="width:250px; margin: 0px auto; text-align:left">
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
			$facility = $_POST["facility"];
			$firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
			$email = $_POST["email"];
			$date = date("Y:m:d H:i:s");

			$sql = "INSERT INTO Employees(employee_netid, password, facility, firstname, lastname, email, reg_date)
			VALUES('$employee_netid', '$password', '$facility', '$firstname', '$lastname', '$email', '$date')";

			if (mysqli_query($conn, $sql)) {
				echo "New record created successfully for:<br />";
				echo $employee_netid."<br />";
				echo $facility."<br />";
				echo $firstname."<br />";
				echo $lastname."<br />";
				echo $email."<br />";
			} else {
				//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				echo "Error occurred during registration. Please try again."
			}

			mysqli_close($conn);
			?>
	</body>
</html>