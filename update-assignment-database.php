<?php
include_once 'connection-script.php';
session_start();
//$mail=$_SESSION['email'];
//$query="SELECT * from student where semail='$mail'";
//$result=mysql_query($query);
//$row=mysql_fetch_array($result);

$id=$_POST['id'];
$courseid=$_POST['courseid'];
$assignmentno=$_POST['assignmentno'];

$query="SELECT * from question_submission where studentid='$id' and courseid='$courseid' and assignmentno='$assignmentno'";
$result=mysql_query($query);
$totalmarks=0;
while($row=mysql_fetch_array($result))
{
	$totalmarks=$totalmarks + $row['marks'];
}


$sql="INSERT INTO finalsubmission VALUES ('$id','$courseid','$assignmentno','$totalmarks')";
mysql_query($sql);
header("Location: homepage_student.php");
?>