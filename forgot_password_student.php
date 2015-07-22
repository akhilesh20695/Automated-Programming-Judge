<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgot Password</title>
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/student_style.css">


	</head>
<body style="overflow-y:hidden;">

<div id="header" class="header">
	<ul><p><a href="index.php">NAME</a></p>
	</ul>
</div>
<div id="forgot" class="forgot">
	<form>
		<input type="email" placeholder="Email" name="email" id="email">
		<button type="button" id="login-button" onclick="sendpassword()">Send new Password</button>
	</form>
</div>
<style type="text/css">
form{
	left:0%;
}
</style>
</body>
</html>

<script>
function sendpassword()
		{
			var email=$('#email').val();
			jQuery.ajax({
				type: "POST",
				url: "forgot-password-student-script.php",
				data: 'email='+email,
				cache: false,
				success: function(response)
				{
					if(response==1)
					{
						$("#email").val("");
						alert("An email has been sent to your registered email for password reset.");
					}
					else
					{
						$("#email").val("");
						alert("Whoa whoa whoa! You are trying to change password for an account that doesn't exist.");
					}
				}
			})
		}
</script>