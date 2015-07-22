<?php
include_once '../connection-script.php';

if($_SERVER['REQUEST_METHOD']=='POST')
{
	session_start();
	$mail=$_SESSION['email'];
    $newmail=$_POST['newmail'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$pwd=$_POST['newpwd'];
	

	$result=mysql_query("SELECT * FROM teacher where email='$mail'");
    $row=mysql_fetch_array($result);

    if($fname=="")
    	$fname=$row['fname'];
    if($lname=="")
    	$lname=$row['lname'];
    if($newmail=="")
    	$newmail=$row['email'];
    
    if($pwd=="")
    {
    	$password=$row['password'];
    }
    else
    {
    	$password=$pwd;
    }

	$sql = "UPDATE teacher SET fname='$fname', lname='$lname', password='$password', email='$newmail' WHERE teacherid='$row[teacherid]'";
	mysql_query($sql);
}
mysql_close();
$_SESSION['email']=$newmail;
header('Location: ../homepage_teacher.php');
?>