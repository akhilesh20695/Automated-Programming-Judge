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
	<title>Previous Assignment Submissions</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='//www.google.com/fonts#UsePlace:use/Collection:Bree+Serif' rel='stylesheet' type='text/css'>

	<script src="js/jquery-1.9.1.js"></script>
</head>

<body  style="background-color:whitesmoke;">

<div id="header" class="header" style="background-color:#6ccecb;">
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



<div id="compete" class="compete" style="position:relative; top:5%;">
	<div id="table-wrapper" class="table-wrapper">
	<h2> Selct a course </h2>
	 <?php 
	 echo '<form id="queryform" name="queryform">';
		
			$result1=mysql_query("SELECT * from `student-course` WHERE studentid='$row[studentid]'");
			while($row1=mysql_fetch_assoc($result1))
			{
				$sql="SELECT * from courses where courseid='$row1[courseid]'";
          		$answer=mysql_query($sql);
    			$row2=mysql_fetch_assoc($answer);
				echo '<input type="radio" name="courses" id="courses" value="'.$row2['courseid'].'">'.$row2['coursename'];
				
			}
	echo '<button type="button" onclick="submitquery()"> Submit </button>';		
	echo '</form>';
	?>
</div>
</div>
<div id="showprevioussubmissions" >

</div>
	
<script>

function submitquery()
{
			var courses=$('#courses').val();
			jQuery.ajax({
				type: "POST",
				url: "previous-grades-student-script.php",
				data: "courses="+courses,
				cache: false,
				success: function(response)
				{
					$("#showprevioussubmissions").html(response);
				}
			})
}

</script>
</body>
</html>

