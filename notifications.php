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
	<title>Notifications</title>
	<script src="js/jquery-1.9.1.js"></script>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
<body style="background-color: whitesmoke">

<div id="header" class="header">
	<?php
	$mail=$_SESSION['email'];
	$query="SELECT * from student where semail='$mail'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$filename=$row['studentid']."_dp";
	 $id=$row['studentid'];
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

<div id="logo" class="logo" style="position:relative;">
	<img src="icons/notifications.png">
	<h2>Notifications</h2>
</div>
<div id="notify">
	<?php
	
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d', time());
		$answer=mysql_query("SELECT * from practiceques");
		while($row=mysql_fetch_assoc($answer))
		{
			$uploaddate=date('Y-m-d', strtotime($row['uploaddate']. '+ 7 days'));
			$num1=0;
			if($uploaddate>$date)
			{
				echo '<div class="not_details">';
				echo '<p class="n_heading"> A new question has been posted</p>';
				$num1=1;
				echo '</div>';
			}
		}
	
	

			date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d', time());
		$answer=mysql_query("SELECT * from competition ");
		while($row=mysql_fetch_assoc($answer))
		{
			$uploaddate=date('Y-m-d', strtotime($row['startdate']. '+ 7 days'));
			$num2=0;
			if($uploaddate>$date)
			{
				echo '<div class="not_details">';

				echo '<p class="n_heading"> A new competition is being hosted</p>';
				$num2=1;
				echo '</div>';
			}
		}
	

	
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d', time());
		$answer=mysql_query("SELECT * from assignment");
		while($row=mysql_fetch_assoc($answer))
		{
			$uploaddate=date('Y-m-d', strtotime($row['uploaddate']. '+ 7 days'));
			$num3=0;
			if($uploaddate>$date)
			{
				echo '<div class="not_details">';
				echo '<p class="n_heading"> A new assignment has been uploaded</p>';
				$num3=1;
				echo '</div>';
			}
		}

		if($num1==0 && $num2==0 && $num3==0)
		{ 
			echo '<center><img src="icons/nonotification.jpg"></center>';
		}
	


	?>
	
</div>


</body>
</html>
