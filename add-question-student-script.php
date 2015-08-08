<?php
include_once 'connection-script.php';

$subject="Request for adding a new question";
$msg="A request have been posted to post a new question for practice\n.."." Ques. Name: ".$_POST['qname']."\n..Domain name: ".
$_POST['domains']."\n.. Question: ".$_POST['question']."\n.. Difficulty level: ".$_POST['difficulty']."\n.. Input: ".$_POST['test_cases']."\n.. Output: ".
$_POST['output'];

mail("akhilkr.delhi@gmail.com",$subject,$msg);
echo "<h3>"."Your Question has been uploaded "."</h3>";

?>