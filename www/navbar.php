<?php
$verified = (include 'verifyCookie.php');
$netid = $_COOKIE['netid'];
?>
<?php if ($verified) : ?>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="home.php">
					<img alt="Brand" src="urxfac.png">
				</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="home.php">Home</a></li>
					<li><a href="profile.php">Profile</a></li>
					<li><a href="portal.php">Portal</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $netid; ?><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="profile.php">Profile</a></li>
							<li><a href="editprofile.php">Edit Profile</a></li>
						</ul>
					</li>
					<li><a href="logout.php">Log Out</a></li>
			</ul>
			</div>
		</div>
	</nav>
<?php else : ?>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="home.php">
					<img alt="Brand" src="urxfac.png">
				</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="home.php">Home</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Log In/Sign Up<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="login.php">Login</a></li>
						<li><a href="registration.php">Registration</a></li>
					</ul>
				</li>
			</ul>
			</div>
		</div>
	</nav>
<?php endif; ?>
<br/>