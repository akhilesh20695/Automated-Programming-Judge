<!DOCTYPE html>
<?php
include_once '../connection-script.php';
session_start();
if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Check Performance</title>
	<script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/teacher_style.css">

	</head>
<body style="background-color:whitesmoke; height:100%;">

<div id="header" class="header">
	<?php
	$mail=$_SESSION['email'];
	$query="SELECT * from teacher where email='$mail'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	?>
	<ul><p><a href="../homepage_teacher.php">NAME</a></p>
			<li style=" margin:-3% 1% 1% 0%;"><a href="edit-profile.php"><img src="../icons/user.png" ><p  class="usrname"><?php echo $row['fname'];?> </p></a></li>
			<li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>

	</ul>
</div>

<div id="form_wrapper" class="form_wrapper" style="position:relative; top:23%; padding: 20px;">
		<h1 style="color:black; text-align:center;">Check performance</h1>
	

<!--<form method="post" action="monitor-student-script.php">-->
		<label>ID:</label>
		 <input type="number" name="id" id="id" min="201351001" step="1" placeholder="201351001">
		 <br>
	<button type="submit" id="query-button">See Performance</button><br>
<!--</form>-->
</div>
<div id="results" class="form_wrapper results" style="top:23%;">
	</div>
	<div id="finalresults" class="form_wrapper results" style="top:30%;">
	</div>


</body>
</html>
<script>
$(document).ready(function(){
	$('#query-button').click(function(){
		var id=$('#id').val();
		$.ajax({
			type: 'POST',
			url: 'query-student-script.php',
			data: "id="+id,
			success: function(response){
				$("#results").html(response);
			}
		});
	});
});

</script>


