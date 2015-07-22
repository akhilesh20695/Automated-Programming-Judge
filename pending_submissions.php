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
	<title>Pending Submissions</title>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
<body style="background-color:whitesmoke;">
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
  <div class="sub_header">
   <p class="grades"><a href="previous_grades_student.php">See Previous Grades</a></p>
  </div>
  <div id="pending_submission" class="pending_submission">
	<h1>Pending Submissions</h1>

<?php
$curdate=date("Y-m-d");
$query="SELECT * FROM assignment WHERE duedate>='$curdate'";
$result=mysql_query($query);
$total=mysql_num_rows($result);
if($total==0)
{
   echo "<h3>Damn! You are a hard worker.<br> You have no assignments to do.<br> It's play time or movie time or TV show time.</h3>";
   echo '<img src="icons/noassignment.jpg" height=40% >'; 
}
while($row=mysql_fetch_array($result))
{
	$query3="SELECT * from finalsubmission where studentid='$id' and courseid='$row[courseid]' and assignmentno='$row[assignmentno]'";
    $result4=mysql_query($query3);
    $num=mysql_num_rows($result4);
    if($num==0)
    {
    	echo '<h3>Course ID:'.$row['courseid'].'</h3><br><br>';

    	$result4=mysql_query("SELECT * from courses where courseid='$row[courseid]'");
    	$row4=mysql_fetch_array($result4);

    	echo '<h3>Course: '.$row4['coursename'].'</h3>';
        echo '<br><br>';
    	echo '<h3>Assignment No.: '.$row['assignmentno'].'</h3>';
        echo '<br><br>';
    	echo '<h3>Due Date: '.$row['duedate'].'</h3>';
        echo '<br><br>';
    	echo '<form method="post" action="assignment_display.php">';
    	echo '<input type="hidden" name="courseid" id="courseid"  value="'.$row['courseid'].'">';
    	echo '<input type="hidden" name="assignmentno" id="assignmentno" value="'.$row['assignmentno'].'">';
        echo '<br><br>';
    	echo '<input class="pending-button" type="submit" value="Submit">';
    	echo '</form>';
    }
}
?>

</div>
</body>
</html>
