<?php
include_once 'connection-script.php';
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$mail=$_POST['email'];
	$mail=mysql_real_escape_string($mail);
	$mail=strip_tags($mail);


	$query="SELECT * from student where semail = '$mail'";
	$result=mysql_query($query);
	$num=mysql_num_rows($result);
	$row=mysql_fetch_array($result);
	if($num == 0)
	{
		//header('location: index.php');
		echo 0;
	}
	else
	{
		$subject="Password Reset";
		$msg="Click on the following link to reset your password \n.. www..com/set-password.php?email=".$mail;
		mail($mail,$subject,$msg);
		echo 1;
	}			
}
?>