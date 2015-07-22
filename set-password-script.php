<?php
include_once 'connection-script.php';

$mail=$_POST['email'];
$password=$_POST['password'];

$pwd=$_POST['password'];
	$password=$pwd."nimisha";
	$pwd=md5($password);

$sql=mysql_query("UPDATE student SET password='$pwd' WHERE semail='$mail'");
mysql_close();
echo 1;
?>