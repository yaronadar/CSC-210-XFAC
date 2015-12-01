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
		
		<div id="login" style="width:25%; margin: 0px auto; text-align:left">
			<form name="login" method="post" action="authenticate.php">
				NetID: <input name="netid" type=text size="30"/>
				</br>
				Password: <input name="pass" type=password size="30"/>
				<br/>
				<div style="text-align: center;">
					<input type="submit" value="Submit"/> <input type="reset"value="Cancel"/>
				</div>
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