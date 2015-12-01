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
			
			#registration {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div id="nav">
			<img class="logo" src="URXFAC.png"/>
			<nav>
				<ul>
					<!-- Comments to remove whitespace between li elements -->
					<li><a href="home.php">Home</a></li><!--
				 --><li><a href="profile.php">Profile</a></li><!--
				 --><li><a href="portal.php">Portal</a></li><!--
				 --><li><a href="login.php">Login</a></li><!--
				 --><li><a href="registration.php">Registration</a></li>
				</ul>
			</nav>
		</div>
		
		<h1 style="font-family:verdana;text-align:center">
			Registration
		</h1>
		
		<br/>
		
		<div id="registration" style="width:25%; margin: 0px auto; text-align:left">
			<form method="post" action="employeereg.php">
				NetID: <input name="employee_netid" type=text size="30"/><br/>
				Password: <input name="password" type=password size="30"/><br/>
				First Name: <input name="firstname" type=text size="30"/><br/>
				Last Name: <input name="lastname" type=text size="30"/><br/>
				Facility Name: <input name="facility" type=text size="30"/><br/>
				UR Email: <input name="email" type=text size="30"/><br/>
				<br/>
				<div style="text-align: center;">
					<input type="submit" value="Submit"/> <input type="reset"value="Cancel"/>
				</div>
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