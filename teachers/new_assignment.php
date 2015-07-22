<!DOCTYPE html>
<html>
<?php
include_once '../connection-script.php';
session_start();
if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
?>
<head>
	<meta charset="utf-8">
	<title>Add new Assignment</title>
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
<style type="text/css">
label{
  margin-left: 30px;
}
</style>

<div id="form_wrapper" class="form_wrapper">
	<h1 style="color:black; text-align:center;">Create Assignment</h1>

	<form style="width:900px;">
		<br><label>Assignment Name / Topic</label>
		<input type="text"name="aa_name" placeholder="Assignment name">
		<br><label>Last date of submission</label>
		<input type="date" name="submission_date" placeholder="Date">
			<br><label> Number of Questions:</label>
		 <input type="number" name="no_questions" min="1" max="100" step="1" value="1">
		<br><label>Maximum Points for each question</label>
		 <label for="same" class="radio">Same for all
		<input type="radio" name="q_points" id="same"></label>
		<label for="different" class="radio">Different for each
		<input type="radio" name="q_points" id="different"></label>
		<br><br><br><br><br><textarea name="question" rows="10" cols="30"></textarea>
		<br><label>Test Case</label>
		<textarea name="test_cases" rows="10" cols="30"></textarea>
		<br><label>Output</label>
		<textarea name="output" rows="10" cols="30"></textarea>
	<br><label class="check"><input type="checkbox" name="add_more">Add more test cases</label><br>
		<button type="submit" id="question-button">Create Assignment</button><br>
	</form>
</div>

</body>
</html>
