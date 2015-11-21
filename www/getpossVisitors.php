<?php
//Get input and initialize output
$attempt = $_REQUEST["q"];
$return = array();

//SETUP THE CONNECTION
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "xfac";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
	die("Connection failed: ".$conn->connect_error);
	$error = $error."dead connection";
}

//Get and Store Visitors Information
$sql = "SELECT visitor_netid, firstname, lastname FROM Visitors";
$result = mysqli_query($conn, $sql);

$possibilities = array();
$posscount = 0;
while($row = mysqli_fetch_assoc($result)){
	$possibilities[$posscount] = $row;
	$posscount++;
}

//Build the returned list of possibilities
$returncount = 0;
if($attempt != ""){
	$length = strlen($attempt);
	foreach($possibilities as $poss){
		if((stristr($attempt, substr($poss["visitor_netid"], 0, $length)) || stristr($attempt, substr($poss["firstname"], 0, $length))) || stristr($attempt, substr($poss["lastname"], 0, $length))){
			$return[$returncount] = $poss;
			$returncount++;
		}
	}
}

echo "{\"Visitors\":".json_encode($return)."}";

?>
