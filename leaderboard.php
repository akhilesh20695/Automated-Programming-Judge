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
	<title>Leaderboard</title>
	<head>
		<script src="files/jquery-1.9.1.js"></script>

<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">



	</head>
<body style="height:152%;">

<div id="header" class="header">
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
<div class="container" style="background-color: #473E3F;">
<div id="logo" class="leader logo">
	<img src="icons/leader.png">
	<h2>Leaderboard</h2>
</div>

<div id="top_performers" class="lead"><h2>Top Performers</h2>
	<table id="top">
		<tr>
		<th>Rank</th>
		<th>Name</th>
		<th>Total Points</th>
		</tr>
<?php
$query="SELECT SUM(p1.number) AS total,s1.studentid FROM points p1 INNER JOIN student s1 ON s1.studentid=p1.s_id GROUP BY s1.studentid ORDER BY total DESC";
$result=mysql_query($query);
$item=1;
while($row=mysql_fetch_assoc($result))
{
echo "<tr>";

$sql="SELECT * from student where studentid=$row[studentid]";
$answer=mysql_query($sql);
$row1=mysql_fetch_array($answer);



echo "<td>".$item."</td>";
echo "<td>".$row1['fname']." ".$row1['lname']."</td>";
echo "<td>".$row['total']."</td>";
echo "</tr>";
$item=$item+1;
}
?>
</table>
</div>
<div id="user_performance" class="lead">
	<h2>Where you Stand!</h2>
	<?php
	$mail="$_SESSION[email]";
	$result1=mysql_query("SELECT count(*) as attempts FROM points where s_id='$id'");
	$tattempts=mysql_fetch_assoc($result1);

	$result2=mysql_query("SELECT count(*) as correctattempts FROM points where s_id='$id' AND answer_status=1");
	$cattempts=mysql_fetch_assoc($result2);



	$query="SELECT SUM(number) AS score, FIND_IN_SET ( score, ( SELECT GROUP_CONCAT( score ORDER BY score DESC ) FROM scores )) AS rank FROM points WHERE s_id =  '$id'";
	$result3=mysql_query($query);
	$rank=mysql_fetch_assoc($result3);

	echo "<h1>RANK: ".$rank['total']."</h1>";
	echo "<h3>Total attempts: ".$tattempts['attempts']."</h3>";
	echo "<h3>Total Correct: ".$cattempts['correctattempts']."</h3>";
	?>
</div>
</div>
<div id="footer">
<p class="copy">&copy;All Rights Reserved</p>
</div>

</body>
</html>
