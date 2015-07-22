<?php
session_start();
include_once 'connection-script.php';
if($_SERVER['REQUEST_METHOD']=='POST')
{
session_start();	
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$id=$_POST['id1'];
$email=$id."@iiitvadodara.ac.in";
$pwd=$_POST['password'];
$password=$pwd."nimisha";
$password=md5($password);
$sql= "INSERT INTO student VALUES('$id','$fname','$lname','$email','$password','FALSE','')";
mysql_query($sql) or die("Error in transaction: ".mysql_error());
$mail=htmlentities($_POST['email']);
$_SESSION['email']=$email;
$subject="Account Activation";
$message="CLick on the following link to activate your account:
http://www..com/activate_account.php?id=".$id;
mail($email,$subject,$message);
header('Location: account_activate_page.php');
}
?>