<?php
include_once '../connection-script.php';
session_start();


$id=$_POST['studentid'];
$courses=$_POST['courses'];

$query1="SELECT * FROM `student-course` where studentid='$id' and courseid='$courses'";
$result1=mysql_query($query1);
$num=mysql_num_rows($result1);
if($num==0)
{
	echo "<h3> Student has not opted for this course </h3>";
}
else
{
	$query2="SELECT * FROM student where studentid='$id'";
	$result2=mysql_query($query2);
	$row=mysql_fetch_assoc($result2);

	echo "<h3>".$row['fname']." ".$row['lname']."</h3>";
	echo "<h3>".$id."</h3><br />";

	$sql="SELECT * from finalsubmission where studentid='$id' and courseid='$courses'";
	$answer=mysql_query($sql);
	$num=mysql_num_rows($answer);
	if($num==0)
	{
		echo '<h3> No submissions by this student for this course yet !</h3>';
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<td> Assignment No. </td>";
		echo "<td> Total Marks </td>";
		echo "</tr>";
		while($row=mysql_fetch_assoc($answer))
		{
		 	echo "<tr>"; 
		 	echo "<td>".$row['assignmentno']."</td>";
		 	echo "<td>".$row['totalmarks']."</td>";
		 	echo "</tr>";
		}
		echo "</table>";
	}
}
?>