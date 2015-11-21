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
		
		<div id="registration">
			<form method="post" action="employeereg.php">
				NetID: <input name="employee_netid" type=text size="30"/><br/>
				Password: <input name="password" type=password size="30"/><br/>
				First Name: <input name="firstname" type=text size="30"/><br/>
				Last Name: <input name="lastname" type=text size="30"/><br/>
				Facility Name (Formal): <input name="facility" type=text size="30"/><br/>
				UofR Email Address: <input name="email" type=text size="30"/><br/>
				<br/>
				<input type="submit" value="Submit"/> <input type="reset"value="Cancel"/>
			</form>
		</div>
		
		</br>
		
		<div style="text-align:center">
			Already have an account?
			</br>
			<a href="login.php">Log In</a>
		</div>
	</body>
</html>