<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<?php
if (!isset($_COOKIE['netid']) || !isset($_COOKIE['pass'])) {
    header("Location: login.php");
    exit;
}
$employee_netid = $_COOKIE['netid'];
$visitor_netid = $_POST["visitor_netid"];

//SETUP THE CONNECTION
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


//DATABASE QUERIES

//Get Employee Information
$sql = "SELECT * FROM Employees WHERE employee_netid='$employee_netid'";
$result1 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	$employee_netid = $result1['employee_netid'];
	$firstname = $result1['firstname'];
	$lastname = $result1['lastname'];
	$facility = $result1['facility'];
	$email = $result1['email'];

	
if(!$result1){
	$error = $error." and empty employee result";
}
//Get Visitor Information

$sql = "SELECT * FROM Visitors WHERE visitor_netid='$visitor_netid'";
$result2 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	$visitor_netid = $result2['visitor_netid'];
	$visitor_firstname = $result2['firstname'];
	$visitor_lastname = $result2['lastname'];


if(!$result2){
	$error = $error." and empty visitor result";
}

//Get Visitor's Abilities Information
$sql = "SELECT * FROM Abilities WHERE visitor_netid='$visitor_netid'";
$result3 = mysqli_query($conn, $sql);
$abilities = array();//array to hold the visitor's abilities info

//Create an array of ability and corresponding employee/facility info
$ability_count = 0;
while($row1 = mysqli_fetch_assoc($result3)) {
	$ability_employee = $row1["employee_netid"];
	$row2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT facility FROM Employees WHERE employee_netid='$ability_employee'"));
	$abilities[$ability_count] = array_merge($row1, $row2);
	
	$ability_count++;
}

mysqli_close($conn);
?>

<!--WEBPAGE HTML-->
<html>
	<head>
		<title>
			UR XFAC - Portal
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
		</style>
	</head>
	<body>
		<img src="URXFAC.png"/>
		
		<div id="nav">
			 <ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="portal.php">Portal</a></li>
				<?php
				if (isset($_COOKIE['netid']) && isset($_COOKIE['pass'])) {
					echo '<li><a href="logout.php">Logout</a></li>';
				}
				else {
					echo '<li><a href="login.php">Login</a></li>';
					echo '<li><a href="registration.php"> Registration</a></li>';
				}
				?>
			</ul>
		</div>
		
		<h1 style="font-family:verdana;text-align:center">
			Portal
		</h1>
		
		</br>

<?php
echo "<div>";
//echo $error;
echo "<table width=\"100%\" border=\"1\" cellpadding=\"10\">";
echo "<tr>";
	echo "<th>My Name</th>";
    echo "<th>My NetID</th>";
    echo "<th>My Facility</th>";
    echo "<th>My Email</th>";
echo "</tr>";
echo "<tr>";
	echo "<td>".$firstname." ".$lastname."</td>";
    echo "<td>".$employee_netid."</td>";
    echo "<td>".$facility."</td>";
    echo "<td>".$email."</td>";
echo "</tr>";
echo "</table>";
echo "<hr />";
echo "</div>";
?>

<!--Visitor Account Search
	URL Constructing Script-->
<div>
<script language='javascript' type='text/javascript'>
function searchFunction(){
var url="http://localhost/employeeportal.php?netid=" + <?php echo $employee_netid ?> + "&visitor_netid=" + document.getElementById("visitor_netid");
location.href=url;
return false;
}
</script>

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
Lookup Visitor Abilities:
<input type=text name="visitor_netid" id="visitor_netid"/><br />
<input type="submit" value="Search" />
</form><br />
</div>

<?php
	//Visitor Search Results Table
echo "<div>";
echo "<table width=\"100%\" border=\"1\" cellpadding=\"10\">";
echo "<tr>";
	echo "<th>Visitor Name</th>";
    echo "<th>Visitor NETID</th>";
    echo "<th>Abilities</th>";
echo "</tr>";

	//If Visitor Field is Blank i.e. page loaded w/o visitor search request
if(is_null($visitor_netid)){
	echo "<tr>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td>";
		
			//nested Abilities table
			echo "<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
			echo "<tr>";
				echo "<th>Ability</th>";
				echo "<th>Facility</th>";
				echo "<th>Date</th>";
				echo "<th>Note</th>";
			echo "</tr>";
				echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
				   echo "<td></td>";
				echo "</tr>";
			echo "</table>";
			echo "</td>";
		echo "</table>";
	echo "</tr>";
	echo "</table>";
	echo "No visitor selected";


}else{//visitor is selected
	echo "<tr>";
		echo "<td>".$visitor_firstname." ".$visitor_lastname."</td>";
		echo "<td>".$visitor_netid."</td>";
		echo "<td>";
			//Nested Abilities Table
			echo "<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
			echo "<tr>";
				echo "<th>Ability</th>";
				echo "<th>Facility</th>";
				echo "<th>Date</th>";
				echo "<th>Note</th>";
			echo "</tr>";

			//For each row in the abilities array, insert the relevant ability info
			foreach($abilities as $ability){
				echo "<tr>";
					echo "<td>".$ability["ability"]."</td>";
					echo "<td>".$ability["facility"]."</td>";
					echo "<td>".$ability["date"]."</td>";
				   echo "<td>".$ability["note"]."</td>";
				echo "</tr>";
			}
			
			echo "</table>";
		echo "</td>";
	echo "</table>";
	echo "<a href=\"#\">Edit This Visitor's Information</a><br />";
	echo "<a href=\"#\">Delete This Visitor</a>";

	echo "</tr>";
	echo "</table>";
}
echo "<hr />";
echo "</div>";
echo "</body>";
echo "</html>";
?>