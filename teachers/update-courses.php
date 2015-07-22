 <?php 
 include_once 'connection-script.php';
 session_start();
 $mail=$_SESSION['email'];
   $result=mysql_query("SELECT * FROM student where semail='$mail'");
   $row=mysql_fetch_array($result);
   $id=$row['studentid'];

 if($_SERVER['REQUEST_METHOD']=='POST')
 {
 	$coursearr=$_POST['courses'];
 	foreach ($coursearr as $course) 
 	{
	$sql="INSERT INTO `student-course` VALUES ('$id','$course')";
 	$result=mysql_query($sql); 
 	echo "Query Successful";
}
}
header("Location: homepage_student.php");
 ?>