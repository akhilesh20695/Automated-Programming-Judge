<?php
include_once 'connection-script.php';
$id=$_GET['id'];
$sql= "SELECT * FROM student WHERE studentid='$id'";
$result=mysql_query($sql);
if($result && mysql_num_rows($result)>0)
{
	echo "1";
}
else
{
	echo "0";
}
mysql_close();
?>
