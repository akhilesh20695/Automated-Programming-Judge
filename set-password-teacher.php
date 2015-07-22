<!DOCTYPE html>
<?php
include_once 'connection-script.php';
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Set Password</title>
	<head>
<link href='//fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
<body>

<div id="header" class="header"
	<ul><p><a href="homepage_student.php">NAME</a></p>
</div>

<div>
<h3>Enter the password you want to set</h3>
<form method="post">
	<input type="password" id="password" placeholder="New password">
	<input type="hidden" id="email" value="<?php $email=$_GET['email']; echo  $email; ?>">
	<button type="button" id="setpasswordbutton" value="Set Password" onclick="setnewpassword()">
</form>
</body>
</html>

<script>
function setnewpassword()
		{
			var password=$('#password').val();
			var email=$('#email').val();
			jQuery.ajax({
				type: "POST",
				url: "set-password-teacher-script.php",
				data: 'email='+email+'&password='+password,
				cache: false,
				success: function(response)
				{
					if(response==1)
					{
						alert("Password set!");
						document.location.href="index.php";
					}
			})
		}
</script>

