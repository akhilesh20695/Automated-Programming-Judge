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

		<div id="logo" class="logo" style="position:relative; top:2%;">
		</div>
		<br>
		<br>
		<br>
		<br>
				<?php
					$cid=$_GET['compid'];
					$query="SELECT * FROM competition where comp_id='$cid'";
					$result=mysql_query($query);
					$row=mysql_fetch_array($result);
					echo '<h2>'.$row['comp_name'].'</h2>';
					echo '<br>';


					$answer=mysql_query("INSERT INTO result_timed_comp(tcompid,tsid) VALUES ('$cid','$id')");


					$query1="SELECT * from questions_comp where compid='$row[comp_id]'";
					$result1=mysql_query($query1);

					while($row1=mysql_fetch_array($result1))
					{
						$query2="SELECT * from answer_comp where sid='$id' and cid='$cid' and qid='$row1[questionid]'";
					    $result2=mysql_query($query2);
					    $num=mysql_num_rows($result2);

					    if($num==0)
					    {
					    	echo '<div id="question" class="question">';
					        echo '<p class="q_name">'.$row1['question'].'</p>';
					        echo '<p class="max_points">Maximum Points: '.$row1['points'].'</p>';
					        echo '<p class="try_it"><a href="compiler_competition/competition-question-attempt.php?compid='.$cid.'&qid='.$row1['questionid'].'"'.'>Try It</a></p>';
					        echo '</div>';
					    }
					    else
					    {
					    	echo '<div id="question" class="question">';
					        echo '<p class="q_name">'.$row1['question'].'</p>';
					        echo '<p class="max_points">Maximum Points: '.$row1['points'].'</p>';
					        echo '<p>Solved</p>';
					        echo '</div>';
					    }

					}
				?>
		    <?php
		    echo '<form action="update-competition-database.php" method="POST">';
			echo '<input type="hidden" name="id" id="id" value="'.$id.'">';
			echo '<input type="hidden" name="compid" id="compid" value="'.$cid.'">';
			echo '<input type="submit" value="Submit">';
			echo '</form> ';
			?>
</body>
</html>