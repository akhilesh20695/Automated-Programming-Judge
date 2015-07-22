<?php
include_once 'connection-script.php';
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$mail=$_POST['teacher_email'];
	$mail=mysql_real_escape_string($mail);
	$mail=strip_tags($mail);


	$pwd=$_POST['teacher_password'];
	//$pwd=mysql_real_escape_string($password);
	//$pwd=strip_tags($pwd);
	//$pwd=md5($pwd);





	$query="SELECT * from teacher where email = '$mail'";
	$result=mysql_query($query);
	$num=mysql_num_rows($result);
	$row=mysql_fetch_array($result);
	if($num == 0)
	{
		//header('location: index.php');
		echo 0;
	}
	else
		if ($pwd == $row['password']) {
			$_SESSION['email']=$row['email'];
			echo 1;
			//header('Location: homepage_teacher.php');	
		}
		else {
			echo 2;
			//header('location: index.php');
		}
}
?>