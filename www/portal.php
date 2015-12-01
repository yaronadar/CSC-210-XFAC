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
			
			#employeeInfo,
			#info {
				border-collapse: collapse;
				border: 2px solid #808080;
			}

			#employeeInfo td,
			#info td {
				border: 1px solid #808080;
			}
			
			#employeeInfo tr:nth-child(odd),
			#info tr:nth-child(odd) {
				background-color: #e6e6e6;
			}
			
			#employeeInfo tr:nth-child(even),
			#info tr:nth-child(even) {
				background-color: #ffffff;
			}
			
			#employeeInfo tr:first-child,
			#info tr:first-child {
				background-color: #99b3e6;
			}
			
			#abilities {
				border-collapse: collapse;
				border: none;
				background-color: inherit;
			}
			
			#abilities tr {
				text-align: left;
			}
			
			#abilities td {
				border: none;
			}
			
			#abilities tr:first-child, #abilities tr:nth-child(n) {
				background-color: inherit;
			}
		</style>
	</head>
<body>
<script>
//INFORMATION TABLE UPDATER
		function displayInfo(str){
			
			var table = document.getElementById("info");
			//Clear all but the header row
			/*for(var i=1; i <= table.rows.length; i++){
				table.deleteRow(0);
			}*/
			var xmlhttp = new XMLHttpRequest();
			
			xmlhttp.onreadystatechange = function(){

				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				
					var obj = JSON.parse(xmlhttp.responseText);
					//insert a row after the header row (i.e. after the first row)
					var row = table.insertRow(1);
					row.insertCell(0).innerHTML = obj.Info[0].firstname + " " + obj.Info[0].lastname;
					row.insertCell(1).innerHTML = obj.Info[0].visitor_netid;
					
					//construct Abilities table
					if(obj.Abilities.length == 0){
						abilitiesTableString = "No Abilities on Record";
					} else {
						abilitiesTableString = "<table id=\"abilities\" width=100% cellpadding=\"5\">";
						
						abilitiesTableString += "<tr><th>Ability</th><th>Facility</th><th>Date</th><th>Note</th></tr>";
						//Insert all ability rows after header row
						for(r = 0; r < obj.Abilities.length; r++){
							
							abilitiesTableString += "<tr><td>" + obj.Abilities[r].ability + "</td><td>" + obj.Abilities[r].facility + "</td><td>" + obj.Abilities[r].date + "</td><td>" + obj.Abilities[r].note + "</td></tr>";
							
						}
					}
					row.insertCell(2).innerHTML = abilitiesTableString;
				
				}
			};
				
			xmlhttp.open("GET", "getVisitorInfo.php?q=" + str, true);
			xmlhttp.send();
				
		}
		
		//SEARCH TABLE UPDATER
		function showVisitors(str){
			var table = document.getElementById("possVisitors");
			//clear the table to remove old results and indicators
			for(var i=0; i <= table.rows.length; i++){
				table.deleteRow(0);
			}table.insertRow(0).insertCell(0).innerHTML = "";
			
			//Indicate request is being processed during response time
			table.insertRow(0).insertCell(0).innerHTML = "Processing";
				
			if(str.length == 0){
				//Clear the table to prevent indicator stacking
				for(var i=0; i <= table.rows.length; i++){
				table.deleteRow(0);
				}table.insertRow(0).insertCell(0).innerHTML = "";
				//Indicate the function of the text box to the user
				table.insertRow(0).insertCell(0).innerHTML = "Type to Search";
				return;
			} else {
				
				var xmlhttp = new XMLHttpRequest();
				
				xmlhttp.onreadystatechange = function(){

					if(xmlhttp.readyState == 3 && xmlhttp.status == 200){
						//clear table to prevent result stacking
						for(var i=0; i <= table.rows.length; i++){
							table.deleteRow(0);
						}table.insertRow(0).insertCell(0).innerHTML = "";
						
						var obj = JSON.parse(xmlhttp.responseText);
						
						if(obj.Visitors.length == 0){
							table.insertRow(0).insertCell(0).innerHTML = "No Such Visitor In The Database";
						} else{
							for(var j=0; j < obj.Visitors.length; j++){
								var visinfo = obj.Visitors[j].visitor_netid + " -- " + obj.Visitors[j].firstname + " " + obj.Visitors[j].lastname;
								var vislink = " <a onClick=\"displayInfo('"+obj.Visitors[j].visitor_netid+"');\" href=\"#\">Select</a>";
								table.insertRow(0).insertCell(0).innerHTML = visinfo + vislink;
								
							}
						}
					}
				};
				
				xmlhttp.open("GET", "getpossVisitors.php?q=" + str, true);
				xmlhttp.send();
			}
		}
</script>

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
	Portal
</h1></br>

<!--Employee Info Table-->
<div>
<table id="employeeInfo" width="100%" border="1" cellpadding="10">
<tr>
<th>My Name</th>
<th>My NetID</th>
<th>My Facility</th>
<th>My Email</th>
</tr>
<tr>
<td><?php echo $firstname." ".$lastname ?></td>
<td><?php echo $employee_netid ?></td>
<td><?php echo $facility ?></td>
<td><?php echo $email ?></td>
</tr>
</table>
<hr />
</div>

<!--Visitor Account Search
	URL Constructing Script-->
<div>
Search by Visitor NetID or Name: 
<form>
	<input type = "text" onkeyup="showVisitors(this.value)"><br />

	<table id="possVisitors">
	<tr>
		<td>Type to Search</td>
	</tr>
	</table>
</form><br />

<table id="info" width="100%" border="1" cellpadding="10">
	<tr>
		<th width=15%>Visitor Name</th>
		<th width=15%>Visitor NetID</th>
		<th>Abilities</th>
	</tr>
</table>

</div>
</body>
</html>