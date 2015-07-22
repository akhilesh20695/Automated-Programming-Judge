<?php
include_once 'connection-script.php';
session_start();


$mail=$_SESSION['email'];
$query="SELECT * from student where semail='$mail'";
$result=mysql_query($query);
$row=mysql_fetch_assoc($result);


$id=$_POST['courses'];
echo '<h3>'.$id.'</h3>';

$answer=mysql_query("SELECT * from courses where courseid='$id'");
$final=mysql_fetch_assoc($answer);

echo '<h3>'.$final['coursename'].'</h3>';



$query1="SELECT * FROM finalsubmission where studentid='$row[studentid]' and courseid='$id'";
$result1=mysql_query($query1);
$num=mysql_num_rows($result1);
if($num==0)
{
	echo "<h3> Whoa! This looks a pretty clean area. Either you are procrastinating or the teacher is. LOL!  </h3>";
}
else
{
	echo '<table id="table11" class="table-11">';
	echo '<tr>';
	echo '<th>Assignment No.</th>';
	echo '<th>Submission Date</th>';
	echo '<th>Total Points</th>';
	echo '<th>Points Scored</th>';
	echo '</tr>';
	while($row=mysql_fetch_assoc($result1))
	{
	 	echo "<tr>"; 
	 	echo "<td>".$row['assignmentno']."</td>";
	 	echo '<th>Submission Date</th>';

	 	$total=0;
	 	$query2=mysql_query("SELECT * from `questions_assignment` where courseid='$id' and assignmentno='$row[assignmentno]'");
	 	while($tuple=mysql_fetch_assoc($query2))
	 	{
	 		$total=$total+$tuple['marks'];
	 	}


		echo '<th>'.$total.'</th>';
	 	echo "<td>".$row['totalmarks']."</td>";
	 	echo "</tr>";
	}
	echo "</table>";
}
?>