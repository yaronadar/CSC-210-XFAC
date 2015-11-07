<?php
$employee_netid = $_POST["netid"];

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



$sql = "SELECT * FROM Employees WHERE employee_netid='$employee_netid'";
$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	$employee_netid = $result['employee_netid'];
	$firstname = $result['firstname'];
	$lastname = $result['lastname'];
	$facility = $result['facility'];
	$email = $result['email'];
	
if(!$result){
	$error = $error."and empty result";
}

echo "<html>";
echo "<head>";
echo "<title>XFAC Employee Portal</title>";
echo "</head>";
echo"<header>";
echo "<img src=\"URXFAC.png\" />";
echo "Employee Portal";
echo "</header>";
echo "<div>";
echo $error;
echo "<table width=\"100%\" border=\"1\" cellpadding=\"10\">";
echo "<tr>";
	echo "<th>My Name</th>";
    echo "<th>My NETID</th>";
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
echo "<a href=\"#\">Edit My Info</a><br />";
echo "<a href=\"#\">Delete My XFAC Employee Account</a>";
echo "<hr />";
echo "</div>";

echo "<div>";
echo "<form action=\"lookup.php\" method=\"get\">";
echo "Lookup Visitor Abilities:";
echo "<input type=\"text\" name=\"visitor_netid\" value=\"enter visitor netid here\"/><br />";
echo "<input type=\"submit\" value=\"Search\" />";

echo "</form><br />";

echo "<div>";
echo "<table width=\"100%\" border=\"1\" cellpadding=\"10\">";
echo "<tr>";
	echo "<th>Visitor Name</th>";
    echo "<th>Visitor NETID</th>";
    echo "<th>Abilities</th>";
echo "</tr>";
echo "<tr>";
	echo "<td>something</td>";
    echo "<td>something</td>";
    echo "<td>";
    echo "<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
    echo "<tr>";
    	echo "<th>Ability</th>";
        echo "<th>Facility</th>";
        echo "<th>Date</th>";
        echo "<th>Notes</th>";
    echo "</tr>";
    echo "<tr>";
    //Grab all rows from Abilities table that match the visitor's netid
    	echo "<td>something</td>";
        //Grab info of the employee who matches the row's employee_netid-->
        echo "<td>something</a></td>";
        echo "<td>something</td>";
       echo "<td>something</td>";
    echo "</tr>";
    echo "</table>";
    echo "</td>";
echo "</table>";
echo "<a href=\"#\">Edit This Visitor's Information</a><br />";
echo "<a href=\"#\">Delete This Visitor</a>";

echo "</tr>";
echo "</table>";

echo "<hr />";
echo "</div>";

echo "<div>";
echo "<form action=\"createvisitor.php\" method=\"post\">";
echo "Create a New Visitor Account:<br />";
echo "<input type=\"text\" name=\"newvisitor_netid\" value=\"visitor netid\" /><br />";
echo "<input type=\"text\" name=\"newvisitor_firstname\" value\"visitor first name\" />";
echo "<input type=\"text\" name=\"newvisitor_lastname\" value=\"visitor last name\" /><br />";
echo "<input type=\"text\" name=\"newvisitor_ability1\" value=\"Record an ability\" />";
echo "<input type\"date\" name=\"newvisitor_abilitydate1\" value=\"Date\" />";
echo "<input type=\"text\" name=\"newvisitor_note1\" value=\"Add a note to this ability (optional)\" />";
echo "<button type=\"button\" name=\"add_newability_row\">Add Another Ability Row</button>";

echo "</form>";
echo "</div>";
echo "<body>";
echo "</body>";

echo "</html>";

?>
