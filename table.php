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
	<title>My Submissions</title>
	<head>
			<link rel="stylesheet" type="text/css" href="css/style.css">

<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	
	</head>
<body  style="background-color:whitesmoke;">

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


<div id="compete" class="compete" style="position:relative; top:5%;">
	<div id="table-wrapper" class="table-wrapper">

	<center><h3> My Submissions</h3></center>
<table id="table11" class="table-11">
<tr>
	<th>Problem</th>
	<th>Time</th>
	<th>Result</th>
	<th>Score</th>
</tr>


<?php 

$query="SELECT * from points where s_id='$row[studentid]' and answer_status=1";
$answer=mysql_query($query);
$num=mysql_num_rows($answer);
if($num==0)
{
	echo 'No Submissions Yet!';
}
else
{

	while($tuple=mysql_fetch_assoc($answer))
	{
		$query1=mysql_query("SELECT * from practiceques where quesid='$tuple[ques_id]' and did='$tuple[domain_id]'");
		$tuple1=mysql_fetch_assoc($query1);
		echo '<tr>';
		echo '<td>'.$tuple1['quesname'].'</td>';
		echo '<td>'.$tuple['timestamp'].'</td>';
		echo '<td>Accepted</td>';
		echo '<td>'.$tuple['number'].'</td>';
		echo '</tr>';

	}
}
?>
</table>
</div>
	
</div>
</body>
</html>
