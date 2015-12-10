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
		<title>UR XFAC - Portal</title>
		<?php include 'header.php' ?>
		<link rel="stylesheet" type="text/css" href="css/portalTables.css">
	</head>
	<body>
		<script type="text/javascript">
		//ABILITY ADDITION FORM UPDATER
		function addAbility(netid){
			var div = document.getElementById("editability");
			div.innerHTML = "";//Clear the div content
		
			div.innerHTML += "Add an ability for " + netid + ":<br />";
			div.innerHTML += "<form>";
			div.innerHTML += "Ability: <input type = \"text\" id=\"ability\" ><br />";
			div.innerHTML += "Note: <input type = \"text\" id=\"note\"><br />";
			div.innerHTML += "Date: <input type = \"text\" id=\"date\"><br />";
			div.innerHTML += "<input type=\"submit\" value=\"Submit\"></form>";
		}
		//ABILITY EDITION FORM UPDATER
		function editAbility(id){
			var div = document.getElementById("editability");
			div.innerHTML = "";//Clear the div content
			
			var xmlhttp = new XMLHttpRequest();
			
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					
					var obj = JSON.parse(xmlhttp.responseText);
					div.innerHTML += "Edit the following ability for " + obj.Ability[0].visitor_netid + ":<br />";
					div.innerHTML += "<form>";
					div.innerHTML += "Ability: <input type = \"text\" id=\"ability\" value=\"" + obj.Ability[0].ability + "\"><br />";
					div.innerHTML += "Note: <input type = \"text\" id=\"note\" value=\"" + obj.Ability[0].note + "\"><br />";
					div.innerHTML += "Date: <input type = \"text\" id=\"date\" value=\"" + obj.Ability[0].date + "\"><br />";
					div.innerHTML += "<input type=\"submit\" value=\"Submit\"></form>";
				}	
			
			};
			xmlhttp.open("GET", "getAbilityInfo.php?q=" + id, true);
			xmlhttp.send();
		}
		//INFORMATION TABLE UPDATER
		function displayInfo(str){
			
			var table = document.getElementById("info");
			//Clear all but the header row
			/*for(var i=1; i <= table.rows.length; i++){
				table.deleteRow(0);
			}*/
			var xmlhttp = new XMLHttpRequest();
			
			console.log("test");
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					var obj = JSON.parse(xmlhttp.responseText);
					//insert a row after the header row (i.e. after the first row)
					var row = table.insertRow(1);
					row.insertCell(0).innerHTML = obj.Info[0].firstname + " " + obj.Info[0].lastname;
					row.insertCell(1).innerHTML = obj.Info[0].visitor_netid;
					
					//Construct Abilities table as a concatenated string
					if(obj.Abilities.length == 0){
						abilitiesTableString = "No Abilities on Record -- ";
					} else {
						abilitiesTableString = "<table id=\"Abilities\" width=100% border=\"0\" cellpadding=\"5\">";
						
						abilitiesTableString += "<tr><th>Ability</th><th>Facility</th><th>Date</th><th>Note</th><th></th></tr>";
						//Insert all ability rows after header row
						for(r = 0; r < obj.Abilities.length; r++){
							
							abilitiesTableString += "<tr><td>" + obj.Abilities[r].ability + "</td><td>" + obj.Abilities[r].facility + "</td><td>" + obj.Abilities[r].date + "</td><td>" + obj.Abilities[r].note + "</td><td><a onClick=\"editAbility('" + obj.Abilities[r].id + "')\" href=\"#\">Edit/Delete</a></td></tr>";
							
						}
						
					}
					abilitiesTableString += "<tr><td><a onClick=\"addAbility('" + obj.Info[0].visitor_netid + "')\" href=\"#\">Add Ability</a></td></tr>";
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

		<?php include 'navbar.php'; ?>

		<h1 style="text-align: center;">
			Portal
		</h1>
		</br>

		<!--Employee Info Table-->
		<div style="width: 90%; margin: 0px auto;">
			<table id="employeeInfo" width="100%">
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
			<hr/>
		</div>

		<!--Visitor Account Search
			URL Constructing Script-->
		<div style="width: 90%; margin: 0px auto;">
			Search by Visitor NetID or Name:
			<form role="form">
				<input type="text" class="form-control" onkeyup="showVisitors(this.value)">
				<br/>

				<table id="possVisitors">
				<tr>
					<td>Type to Search</td>
				</tr>
				</table>
			</form>
			<br/>

			<table id="info" width="100%">
				<tr>
					<th width=15%>Visitor Name</th>
					<th width=15%>Visitor NetID</th>
					<th>Abilities</th>
				</tr>
			</table>

			<div id="editability"></div>
		</div>
		
		<br/>
	</body>
</html>