<?php
include_once '../connection-script.php';
session_start();


$mail=$_SESSION['email'];
$query="SELECT * from teacher where email='$mail'";
$result=mysql_query($query);
$row=mysql_fetch_assoc($result);


$id=$_POST['courses'];
echo '<h3>'.$id.'</h3>';

$answer=mysql_query("SELECT * from courses where courseid='$id'");
$final=mysql_fetch_assoc($answer);

echo '<h3>'.$final['coursename'].'</h3>';



$query1="SELECT * FROM assignment where teacherid='$row[teacherid]' and courseid='$id'";
$result1=mysql_query($query1);
$num=mysql_num_rows($result1);
if($num==0)
{
	echo "<h3> No assignments uploaded for this course yet!! </h3>";
}
else
{
	echo '<table id="table11" class="table-11">';
	while($row=mysql_fetch_assoc($result1))
	{
	 	echo "<tr>"; 
	 	echo '<td> <a href="last_submission.php?ass='.$row['assignmentno'].'&courseid='.$id.'"> Assignment No . '.$row['assignmentno'].'</td>';
	 	echo "</tr>";
	}
	echo "</table>";
}
?>