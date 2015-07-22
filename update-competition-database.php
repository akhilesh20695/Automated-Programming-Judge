<?php
include_once 'connection-script.php'
session_start();
//$mail=$_SESSION['email'];
//$query="SELECT * from student where semail='$mail'";
//$result=mysql_query($query);
//$row=mysql_fetch_array($result);

if($_SERVER['REQUEST_METHOD']=='POST')
{
$id=$_POST['id'];
$compid=$_POST['compid'];
$sql="INSERT into competition_participant VALUES ('$id','$compid')";
mysql_query($sql);
header('Location: homepage_student.php');
}
?>