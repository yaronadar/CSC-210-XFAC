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
?>
<html>
	<head>
		<title>UR XFAC - Logout</title>
		<?php include 'header.php' ?>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		
		<h1 style="text-align: center;">
			Logout
		</h1>
		
		<br/>
		
		<div style="text-align: center;">
			Are you sure you want to log out?
			</br>
			<button class="btn btn-default" onclick="yes()">Yes</button>
			<button class="btn btn-default" onclick="no()">No</button>
			
			<script type="text/javascript">
			function yes(){
				document.cookie = "netid" + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
				document.cookie = "pass" + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
				window.location.replace("/login.php");
			}
			function no(){
				window.location.replace("/home.php");
			}
			</script>
		</div>
	</body>
</html>