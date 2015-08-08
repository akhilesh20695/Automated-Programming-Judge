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
	<title>Competitgon Standings</title>
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

	<center><h3>Compeition Standings</h3></center>
<table id="table11" class="table-11">
<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Answerime</th>
	<th>Score</th>
</tr>


<?php 
$compid=$_POST['compid'];


$query="SELECT * from result_timed_comp where tcompid='$compid' order by answertime asc, points desc";
$answer=mysql_query($query);
$num=mysql_num_rows($answer);


if($num==0)
{
	echo 'Competition not held yet!';
}
else
{


		$query1=mysql_query("SELECT * from competition where comp_id='$compid'");
		$numofrows=mysql_num_rows($query1);
		if($numofrows==0)
		{
			$query2=mysql_query("SELECT * from timed_competition where tcomp_id='$compid'");
			$numofrows2=mysql_num_rows($query2);
			$tuple2=mysql_fetch_assoc($query2);
			echo '<h3>'.$tuple2['tcomp_name'].'</h3>';
		}
		else 
		{
			$tuple1=mysql_fetch_assoc($query1);
			echo '<h3>'.$tuple1['comp_name'].'</h3>';
		}


		while($tuple=mysql_fetch_assoc($answer))
		{
			
			$result=mysql_query("SELECT * from student where studentid='$tuple[tsid]'");
			$row=mysql_fetch_array($result);

			echo '<tr>';
			echo '<td>'.$row['studentid'].'</td>';
			echo '<td>'.$row['fname'].' '.$row['lname'].'</td>';
			echo '<td>'.$tuple['answertime'].'</td>';
			echo '<td>'.$tuple['points'].'</td>';
			echo '</tr>';

		}
}
?>
</table>
</div>
	
</div>
</body>
</html>
