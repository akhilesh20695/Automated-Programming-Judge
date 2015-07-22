<?php
include_once 'connection-script.php';
session_start();
$mail=$_SESSION['email'];
$pwd=$_GET['pwd'];
$sql="SELECT * FROM teacher WHERE email='$mail'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$origpwd=$row['password'];
if(strcmp($password,$origpwd)==0)
{
	echo "1";
}
else
{
	echo "0";
}
mysql_close();
?>
