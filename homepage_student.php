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
<link href='//fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
<body>

<div id="header" class="header">
	<?php
	$mail=$_SESSION['email'];
	$query="SELECT * from student where semail='$mail'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$filename=$row['studentid']."_dp";
	?>
	<ul><p><a href="homepage_student.php">NAME</a></p>
		
		<?php
		if(file_exists('pictures/'.$filename.'.jpg'))
		{
			echo '<li style="margin:-3% 1% 1% 0%;"><a href="#"><img src="pictures/'.$filename.'.jpg" ><p  class="usrname">'.$row['fname'].'</p></a>';
		}
		else if(file_exists('pictures/'.$filename.'.gif'))
		{
			echo '<li style="margin:-3% 1% 1% 0%;"><a href="#"><img src="pictures/'.$filename.'.gif" ><p  class="usrname">'.$row['fname'].'</p></a>';
		}
		else if(file_exists('pictures/'.$filename.'.png'))
		{
			echo '<li style="margin:-3% 1% 1% 0%;"><a href="#"><img src="pictures/'.$filename.'.png" ><p  class="usrname">'.$row['fname'].'</p></a>';
		} 
		else
		{
			echo '<li style="margin:-3% 1% 1% 0%;"><a href="#"><img src="icons/user.png"><p  class="usrname">'.$row['fname'].'</p></a>';
		}
		?>
		<ul>
				<li><a href="edit-profile.php">My Profile</a></li>
				<li><a href="table.php">My submissions</a></li>
		</ul>

		</li>
			<li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>
	</ul>
</div>
<br>
<br>
<br>
<br>
<div class="navig">
<p><a href="homepage_student.php">Home</a></p>
</div>
<div id="nav" class="nav">
	<ul>
		<li class="menu practice"><img src="icons/practice.png">
		<br><h2><a href="domains.php">Practice</a></h2>
		</li>
		<li class="menu submissions"><img src="icons/submission.png">
		<br><h2><h2>Assignments</h2>
			<ul>
				<li><a href="pending_submissions.php">Pending Assignments</a></li>
				<li><a href="previous_grades_student.php">Previous Grades</a></li>
			</ul>
		</li>
		<li class=" menu leaderboard"><a href="leaderboard.php"><img src="icons/leader.png"></a>
		<br><h2><a href="leaderboard.php">Leaderboard</a>
		</li>
		<li class="menu performance"><img src="icons/evaluate.png">
		<br><h2><a href="add-question-student.php">add a<br>question for <r>practice</a></h2>
					</li>
		<li class="menu competition"><img src="icons/compete.png">
		<br><h2><a href="competition.php">Join<br> Competition</a></h2>
		</li>
		<li class="menu notifications"><img src="icons/notifications.png">
		<br><h2><a href="notifications.php">Notifications</a></h2>	
		</li>
	</ul>
</div>
</body>
</html>
