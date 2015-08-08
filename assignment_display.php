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
	<title>Assignment</title>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
		<body style="background-color:whitesmoke;">

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
logo" class="logo" style="position:relative; top:2%;">
		</div>
		<br>
		<br>
		<br>
		<br>
		<div id="ass-question" class="ass-question">
				<?php
					$courseid=$_POST['courseid'];
					$assignmentno=$_POST['assignmentno'];

					
					
					echo '<h2>'.$courseid.'</h2>';
					

					$result4=mysql_query("SELECT * from courses where courseid='$courseid'");
     				$row4=mysql_fetch_array($result4);
					
					echo '<h2>'.$row4['coursename'].'</h2>'; 
					echo '<h2>Assignment: '.$assignmentno.'</h2>';
					echo '<br>';


					//$answer=mysql_query("INSERT INTO result_timed_comp('tcompid','tsid') VALUES ('$cid','$id')");

					$query="SELECT * FROM questions_assignment where courseid='$courseid' and assignmentno='$assignmentno'";
					$result=mysql_query($query);

					while($row=mysql_fetch_array($result))
					{
						$query2="SELECT * from question_submission where studentid='$id' and courseid='$courseid' and quesno='$row[quesno]' and assignmentno='$assignmentno'";
					    $result2=mysql_query($query2);
					    $num=mysql_num_rows($result2);

					    if($num==0)
					    {
					    	echo '<div id="question" class="question1">';
					        echo '<p class="q_name">'.$row['question'].'</p>';
					        echo '<p class="max_points">Maximum Points: '.$row['marks'].'</p>';
					        

					        echo '<form method="post" action="compiler_assignment/assignment-question-attempt.php">';
					    	echo '<input type="hidden" name="courseid" id="courseid"  value="'.$row['courseid'].'">';
					    	echo '<input type="hidden" name="assignmentno" id="assignmentno" value="'.$row['assignmentno'].'">';
					    	echo '<input type="hidden" name="quesno" id="quesno"  value="'.$row['quesno'].'">';
					    	echo '<input type="submit" class="pending-button" style="float:right;top:-35px;" value="Try Yourself">';
					    	echo '</form>'; 
					      
					        echo '</div>';
					    }
					    else
					    {
					    	echo '<div id="question" class="question">';
					        echo '<p class="q_name">'.$row['question'].'</p>';
					        echo '<p class="max_points">Maximum Points: '.$row['marks'].'</p>';
					        echo '<p>Solved</p>';
					        echo '</div>';
					    }

					}
				?>
				<?php
		    echo '<form action="update-assignment-database.php" method="POST">';
			echo '<input type="hidden" name="id" id="id" value="'.$id.'">';
			echo '<input type="hidden" name="courseid" id="courseid"  value="'.$courseid.'">';
			echo '<input type="hidden" name="assignmentno" id="assignmentno" value="'.$assignmentno.'">';
			echo '<input type="submit" class="pending-button" style="  margin-top: 20px;margin-left: 90px;"value="Submit">';
			echo '</form>';
			?>
		</div>
</body>
</html>