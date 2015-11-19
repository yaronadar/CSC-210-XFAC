<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<?php
if (!isset($_COOKIE['netid'])) {
    header("Location: login.php");
    exit;
}
?>
<html>
	<head>
		<title>
			UR XFAC - Logout
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
				<li><a href="profile.php">My Profile</a></li>
				<li><a href="portal.html">Portal</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		
		<h1 style="font-family:verdana;text-align:center">
			Logout
		</h1>
		
		<br/>
		
		<div style="text-align:center">
			Are you sure you want to log out?
			</br>
			<button onclick="yes()">Yes</button>
			<button onclick="no()">No</button>
			
			<script>
			function yes() {
				document.cookie = "netid" + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
				window.location.replace("/login.php");
			}
			function no() {
				window.location.replace("/home.php");
			}
			</script>
		</div>
	</body>
</html>