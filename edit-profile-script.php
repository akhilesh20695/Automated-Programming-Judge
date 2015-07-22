<?php
include_once 'connection-script.php';

if($_SERVER['REQUEST_METHOD']=='POST')
{
	session_start();
	$mail=$_SESSION['email'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$pwd=$_POST['newpwd'];
	

	$result=mysql_query("SELECT * FROM student where semail='$mail'");
    $row=mysql_fetch_array($result);

    if($fname=="")
    	$fname=$row['fname'];
    if($lname=="")
    	$lname=$row['lname'];
    if($fname=="")
    	$fname=$row['fname'];
    
    if($pwd=="")
    {
    	$password=$row['password'];
    }
    else
    {
    	$password=$pwd."nimisha";
    	$password=md5($password);
    }

	$sql = "UPDATE student SET fname='$fname', lname='$lname', password='$password' WHERE semail='$mail'";
	mysql_query($sql);
}
mysql_close();
header('Location: homepage_student.php');
?>