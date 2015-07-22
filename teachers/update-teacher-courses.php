 <?php 
 include_once 'connection-script.php';
 session_start();
 $mail=$_SESSION['email'];
   $result=mysql_query("SELECT * FROM teacher where email='$mail'");
   $row=mysql_fetch_array($result);
   $id=$row['teacherid'];

 if($_SERVER['REQUEST_METHOD']=='POST')
 {
 	$coursearr=$_POST['courses'];
 	foreach ($coursearr as $course) 
 	{
	$sql="INSERT INTO `teacher-course` VALUES ('$id','$course')";
 	$result=mysql_query($sql); 
 	echo "Query Successful";
}
}
mysql_close();
header("Location: ../homepage_teacher.php");
 ?>