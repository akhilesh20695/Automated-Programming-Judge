<?php
include_once 'connection-script.php';

$mail=$_POST['email'];
$password=$_POST['password'];

$pwd=$_POST['password'];

$sql=mysql_query("UPDATE teacher SET password='$pwd' WHERE email='$mail'");
mysql_close();
echo 1;
?>