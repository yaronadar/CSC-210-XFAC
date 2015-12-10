<!--
Moses Chen - mchen37@u.rochester.edu
Yaron Adar - yadar@u.rochester.edu
-->
<?php
$verified = (include 'verifyCookie.php');
if ($verified) {
    header("Location: profile.php");
    exit;
}
?>
<html>
	<head>
		<title>UR XFAC - Login</title>
		<?php include 'header.php' ?>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		
		<h1 style="text-align:center;">
			Login
		</h1>
		
		<?php
		if (isset($_GET['error'])) {
			$error = $_GET['error'];
		?>
		<?php if ($error == 1) : ?>
			<div style="text-align: center;">
				Password incorrect. Please try again.
			</div>
			</br>
		<?php elseif ($error == 2) : ?>
			<div style="text-align: center;">
				No account with that NetID exists. Please register or try again.
			</div>
			</br>
		<?php else : ?>
			<div style="text-align: center;">
				Error while authenticating. Please try again.
			</div>
			</br>
		<?php endif; } ?>
		
		<div class="container" style="width: 30%; margin: 0px auto; text-align: left;">
			<form role="form" name="login" method="post" action="authenticate.php">
				NetID: <input name="netid" class="form-control" type=text size="30"/>
				</br>
				Password: <input name="pass" class="form-control" type=password size="30"/>
				<br/>
				<div style="text-align: center;">
					<input type="submit" class="btn btn-default" value="Log In"/> <input type="reset" class="btn btn-default" value="Cancel"/>
				</div>
			</form>
		</div>
		
		</br>
		
		<div style="text-align: center;">
			Don't have an account yet?
			</br>
			<a href="registration.php" style="text-align: center;">Register</a>
		</div>
	</body>
</html>