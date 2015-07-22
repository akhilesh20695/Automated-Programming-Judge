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
	<title>Competitions</title>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
<body style="background-color:#218C8D">

<div id="header" class="header">
	<?php
	$mail=$_SESSION['email'];
	$query="SELECT * from student where semail='$mail'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$filename=$row['studentid']."_dp";
	?>
	<ul><p><a href="homepage_student.php">NAME</a></p>
		<li style=" margin:-3% 1% 1% 0%;"><a href="edit-profile.php"><?php echo '<img src="pictures/'.$filename.'.jpg" >';?><p  class="usrname"><?php echo $row['fname'];?> </p></a></li>
			<li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>
	</ul>
</div>
<h2>Competition</h2>
<?php
$cid=$_GET['compid'];
$query="SELECT * FROM timed_competition where tcomp_id='$cid'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
echo '<h2>'.$row['tcomp_name'].'</h2>';
echo '<br>';
echo '<p>'.$row['tcomp_details'].'</p>';
echo '<a class="btn" href="timed-competition-question-display.php?compid='.$row['tcomp_id'].'">Start the clock!!</a>';
?>
</body>
</html>