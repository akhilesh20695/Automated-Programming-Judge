<?php
$link=mysql_connect('localhost','root','');
if(!$link)
{
	die('Connection failed: '.mysql_error());
}

mysql_select_db('summer_project');
?>

