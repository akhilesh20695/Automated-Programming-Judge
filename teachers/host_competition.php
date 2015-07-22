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
	<title>Questions</title>
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


<div id="form_wrapper" class="form_wrapper">
		<h1 style="color:black; text-align:center;">Add competition</h1>

	<form style="width:900px;">
		<br><label>Name of the Event</label>
		<input type="text" name="event_name" placeholder="Event Name">
		<br><label>Date of event</label>
		<input type="date" name="event_date" placeholder="Date">
		<br><label>Time of event</label>
		 <input type="time" name="event_time" placeholder="12:00 AM">
		 <br><label>Last date of registration</label>
		 <input type="date" name="event_date" placeholder="Date">
		 <br><label>Registation ends at:</label>
		  <input type="time" name="last_time" value="12:00 AM">
		  <br><label>Competiton Details</label>
		<textarea name="question" rows="10" cols="30"></textarea>
		<br><button type="submit" id="query-button">See Performance</button><br>
	</form>
</div>



</body>
</html>
