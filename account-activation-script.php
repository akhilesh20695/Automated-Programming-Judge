<?php
include_once 'connection-script.php';
session_start();
$id=$_GET['id'];
$act=1;
$query="UPDATE student SET activation='$act' WHERE id='$id'";
$result=mysql_query($query);
header('location: account_activated.php');
?>