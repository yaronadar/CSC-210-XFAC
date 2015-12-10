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
		<title>UR XFAC - Registration</title>
		<?php include 'header.php' ?>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		
		<h1 style="text-align:center;">
			Registration
		</h1>
		
		<?php
		if (isset($_GET['error'])) {
			$error = $_GET['error'];
		?>
		<?php if ($error == 0) : ?>
			<div style="text-align:center">
				Account successfully registered.
			</div>
			</br>
		<?php elseif ($error == 1) : ?>
			<div style="text-align:center">
				Account with NetID already exists. Please try again.
			</div>
			</br>
		<?php elseif ($error == 2) : ?>
			<div style="text-align:center">
				Error while registering. Please try again.
			</div>
			</br>
		<?php else : ?>
			<div style="text-align:center">
				Unknown error. Please try again.
			</div>
			</br>
		<?php endif; } ?>
		
		<div class="container" style="width:60%; margin:0px auto; text-align:left;">
			<form role="form" method="post" action="employeereg.php">
				<div class="row">
					<div class="col-xs-6">
					NetID: <input name="employee_netid" class="form-control" type=text size="30"/><br/>
					Password: <input name="password" class="form-control" type=password size="30"/><br/>
					UR Email: <input name="email" class="form-control" type=text size="30"/><br/>
					</div>
					<div class="col-xs-6">
					First Name: <input name="firstname" class="form-control" type=text size="30"/><br/>
					Last Name: <input name="lastname" class="form-control" type=text size="30"/><br/>
					Facility Name: <input name="facility" class="form-control" type=text size="30"/><br/>
					</div>
				</div>
				<br/>
				<div style="text-align: center;">
					<input type="submit" class="btn btn-default" value="Register"/> <input type="reset" class="btn btn-default" value="Cancel"/>
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