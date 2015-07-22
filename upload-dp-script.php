
<?php
include_once 'connection-script.php';
session_start();


$mail=$_SESSION['email'];
$query="SELECT * from student where semail='$mail'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$id=$row['studentid'];

$valid_formats = array("jpg", "png", "gif");

$temp=explode(".",$_FILES["images"]["name"]);
$newfilename = $id.'_dp'.'.'.end($temp);


$uploadOk = 1;
$size = $_FILES['images']['size'];

if(in_array(end($temp),$valid_formats))
{
	if($size<(1024*1024))
	{
		$uploadOk=1;
	}
	else
		$uploadOk=0;
}
else
{
	$uploadOk=0;
}



if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} 


else 
{
    if (move_uploaded_file($_FILES["images"]["tmp_name"],"C:/xampp/htdocs/summer_project/pictures/".$newfilename)) 
    {
    	echo "<img src='pictures/".$newfilename."' height=200px width=200px style='margin:0 25%;'> ";
    } 
    else {
        echo 0;
    }
}
?>