<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<html>
	<head>
		<title>
			UR XFAC - Home
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
			University of Rochester Cross-Facility Fabrication Ability Communicator
		</h1>
	</body>
</html>