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
		<title>UR XFAC - Delete Account</title>
		<?php include 'header.php' ?>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		
		<h1 style="text-align: center;">
			Delete Account
		</h1>
		
		<br/>
		
		<div style="text-align: center;">
			Are you sure you want to delete your account?
			<p style="color: red;">Warning: This change is permanent and cannot be reverted.</p>
			</br>
			<button class="btn btn-default" onclick="yes()">Yes</button>
			<button class="btn btn-default" onclick="no()">No</button>
			
			<script type="text/javascript">
			function getCookie(cookieName) {
				var name = cookieName + "=";
				var ca = document.cookie.split(';');
				for(var i=0; i<ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==' ')
						c = c.substring(1);
					if (c.indexOf(name) == 0)
						return c.substring(name.length,c.length);
				}
				return "";
			}
			function yes(){
				var datastring = "netid=" + getCookie("netid");
				$.ajax({
					type: "POST",
					url: "delete.php",
					data: datastring,
					dataType: 'text',
					success: function(response){
						console.log(response);
						if (response.localeCompare("yes") == 0)
							window.location.replace("/home.php");
						else
							window.location.replace("/profile.php?error=1");
					}
				});
			}
			function no(){
				window.location.replace("/profile.php");
			}
			</script>
		</div>
	</body>
</html>