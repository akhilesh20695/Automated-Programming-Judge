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
<body  style="background-color:whitesmoke;">

<div id="header" class="header"  style="background-color:#218C8D">
	<?php
	$mail=$_SESSION['email'];
	$query="SELECT * from student where semail='$mail'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$id=$row['studentid'];
	$filename=$row['studentid']."_dp";
	?>
	<ul><p><a href="homepage_student.php">NAME</a></p>
		<li style=" margin:-3% 1% 1% 0%;"><a href="edit-profile.php"><?php echo '<img src="pictures/'.$filename.'.jpg" >';?><p  class="usrname"><?php echo $row['fname'];?> </p></a></li>
			<li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>
	</ul>
</div>


<div id="compete" class="compete" style="position:relative; top:5%;">

<?php

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d', time());






$query="SELECT * FROM competition";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	$result1=mysql_query("SELECT * from competition_participant where student_id='$id' and comp_id='$row[comp_id]'");
	$num=mysql_num_rows($result1);

	if($num==0)
	{
		echo '<div class="event">';
		echo '<p class="c_name">'.$row['comp_name'].'</p>';
		echo '<p class="c_date">Starting Date: '.$row['startdate'].'</p>';
		echo '<p class="c_date">Ending date: '.$row['enddate'].'</p>';


		if($date<$row['enddate'])
		{
			echo '<p class="c_lastdate">Last date of registration: '.$row['registration'].'</p>';
			echo '<p class="c_know"><a href="competition-display.php?compid='.$row['comp_id'].'">Go for it!</a></p>';
		}
		else
		{
			echo '<p class="c_lastdate">Last date of registration: '.'Competition Ended'.'</p>';
			
			echo '<form action="competition-standings.php" method="post">';
			echo '<input type="hidden" name="compid" value="'.$row['comp_id'].'"">';
			echo '<button type="submit">Standings</button>';
			echo '</form>';
		}
		echo '</div>';
	}

}






$query1="SELECT * FROM timed_competition";
$result1=mysql_query($query1);
while($row1=mysql_fetch_array($result1))
{
	echo '<div class="event">';
	echo '<p class="c_name">'.$row1['tcomp_name'].'</p>';
	echo '<p class="c_date">Starting Date and Time: '.$row1['tcomp_sdate'].' '.$row1['tcomp_stime'].'</p>';
	echo '<p class="c_date">Time Limit: '.$row1['tcomp_timelimit'].' minutes</p>';


	$st_time    =   strtotime($row1['tcomp_stime']);

	$end_time   =   strtotime('+'.$row1['tcomp_timelimit'].' minutes',$st_time);

	$cur_time   =   strtotime(date('h:i:s',time()));
	
	if($date==$row1['tcomp_sdate'])
	{
		if($cur_time>$st_time && $cur_time<$end_time)
		{
			echo '<p class="c_know"><a href="timed-competition-display.php?compid='.$row1['tcomp_id'].'">Go for it!</a></p>';
		}
	}
	else
	{
		echo '<p class="c_lastdate">Competition Ended</p>';
		echo '<form action="competition-standings.php" method="post">';
			echo '<input type="hidden" name="compid" value="'.$row['tcomp_id'].'"">';
			echo '<button type="submit">Standings</button>';
			echo '</form>';
	}
	echo '</div>';
}

?>
	
</div>
</body>
</html>
