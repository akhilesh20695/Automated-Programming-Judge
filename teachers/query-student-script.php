<?php
include_once '../connection-script.php';
session_start();


$mail=$_SESSION['email'];
$query=mysql_query("SELECT * from teacher where email='$mail'");
$result=mysql_fetch_assoc($query);







$id=$_POST['id'];

$query1="SELECT * FROM student where studentid='$id'";
$result1=mysql_query($query1);
$num=mysql_num_rows($result1);
if($num==0)
{
	echo "<h3> No such Student with this ID exist </h3>";
}
else
{
			$result1=mysql_query("SELECT * from `teacher-course` WHERE teacherid='$result[teacherid]'");
			$num=mysql_num_rows($result1);
			if($num==0)
			{
				echo '<h3> You have no opted courses </h3>';
			}
			else 
			{
				while($row1=mysql_fetch_assoc($result1))
				{
					$sql="SELECT * from courses where courseid='$row1[courseid]'";
	          		$answer=mysql_query($sql);
	    			$row2=mysql_fetch_assoc($answer);
					echo '<input type="radio" name="courses" id="courses" value="'.$row2['courseid'].'">'.$row2['coursename'];
					echo '<br>';
				}
				echo '<input type="hidden" name="studentid" id="studentid" value="'.$id.'">';
				echo '<button type="button" id="query-button-2"> Submit </button>';
			}


		echo '<script>';
		echo '$(document).ready(function(){';
		echo "$('#query-button-2').click(function(){";
		echo "var id=$('#studentid').val();";
		echo "var course=$('#courses').val();";
		echo "$.ajax({";
		echo "type: 'POST',";
		echo "url: 'monitor-student-script.php',";
		echo 'data: "studentid="+id+"&courses="+course,';
		echo 'success: function(response){';
		echo '$("#results").append(response);';
		echo '}';
		echo '});';
		echo '});';
		echo '});';
		echo '</script>';
}
?>