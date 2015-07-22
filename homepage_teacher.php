<!DOCTYPE html>
<?php
include_once 'connection-script.php';
session_start();
if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>HomePage</title>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
<body>

<div id="header" class="header">
	<?php
	$mail=$_SESSION['email'];
	$query="SELECT * from teacher where email='$mail'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	?>
	<ul><p><a href="homepage_teacher.php">NAME</a></p>
			<li style=" margin:-3% 1% 1% 0%;"><a href="teachers/edit-profile-teacher.php"><img src="icons/user.png" ><p  class="usrname"><?php echo $row['fname'];?> </p></a></li>
			<li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>

	</ul>
</div>
<div id="nav" class="nav">
	<ul>
		<li class="menu practice"><a href="#"><img src="icons/practice.png"></a>
		<br><h2><a href="teachers/new_assignment.php">Create new Assignment</a></h2>
		</li>
		
		<li class="menu submissions"><a href="#"><img src="icons/submission.png"></a>
		<br><h2><a href="teachers/assignment_display.php">Check Submissions</h2>

		</li>
		<li class=" menu leaderboard"><a href="leaderboard.php"><img src="icons/leader.png"></a>
		<br><h2><a href="teachers/all_performance.php">Evaluate Performance of students</a>
		</li>
		
		<li class="menu performance"><a href="#"><img src="icons/evaluate.png"></a>
		<br><h2><a href="teachers/monitor_student.php">Monitor a student</a></h2>
		</li>
		
		<li class="menu competition"><a href="#"><img src="icons/compete.png"></a>
		<br><h2><a href="teachers/host_competition.php">Host a Competition</a></h2>
		</li>
		
		<li class="menu notifications"><a href="#"><img src="icons/notifications.png"></a>
		<br><h2><a href="teachers/add_question.php">Add a question for practice</a></h2>
		</li>
	</ul>
</div>
</body>
</html>
