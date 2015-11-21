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
			UR XFAC - Login
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
				<li><a href="login.php">Login</a></li>
				<li><a href="registration.php">Registration</a></li>
			</ul>
		</div>
		
		<h1 style="font-family:verdana;text-align:center">
			Login
		</h1>
		
		<br/>
		
		<?php
		if (isset($_GET['error'])) {
			$error = $_GET['error'];
			if ($error == 1) {
				echo '<div style="text-align:center">';
				echo 'Password incorrect. Please try again.';
				echo '</div>';
				echo '</br>';
			}
			elseif ($error == 2) {
				echo '<div style="text-align:center">';
				echo 'NetID does exist. Please try again.';
				echo '</div>';
				echo '</br>';
			}
			else {
				echo '<div style="text-align:center">';
				echo 'Error while authenticating. Please try again.';
				echo '</div>';
				echo '</br>';
			}
		}
		?>
		
		<div id="login" style="text-align:center">
			<form name="login" method="post" action="authenticate.php">
				NetID: <input name="netid" type=text size="30"/>
				</br>
				Password: <input name="pass" type=password size="30"/>
				<br/>
				<input type="submit" value="Submit"/> <input type="reset"value="Cancel"/>
			</form>
		</div>
		
		</br>
		
		<div style="text-align:center">
			Don't have an account yet?
			</br>
			<a href="registration.php" style="text-align:center">Registration</a>
		</div>
	</body>
</html>