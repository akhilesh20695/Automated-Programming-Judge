<?php
include_once 'connection-script.php';
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$mail=$_POST['email'];
	$mail=mysql_real_escape_string($mail);
	$mail=strip_tags($mail);


	$pwd=$_POST['password'];
	$password=$pwd."nimisha";
	$pwd=md5($password);





	$query="SELECT * from student where semail = '$mail'";
	$result=mysql_query($query);
	$num=mysql_num_rows($result);
	$row=mysql_fetch_array($result);
	if($num == 0)
	{
		//header('location: index.php');
		echo 3;
	}
	else
	{
		if ($pwd == $row['password']) 
		{
			if($row['activation']==1)
			{
				$_SESSION['email']=$row['semail'];
				echo 1;
				//header('Location: homepage_student.php');
			}
			else
			{
				echo 2;
				//header('Location: account_unactivated.php');
			}
		}
		else
		{
			echo 0;
			//header('Location: index.php');
		}
	}			
}
?>