<!DOCTYPE html>
<?php
include_once '../connection-script.php';
session_start();
if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
?>
<script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
<html>
<head>
	<meta charset="utf-8">
	<title>Display Assignments</title>
	<script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
	
	<head>
		<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
<body>

<div id="header" class="header">
	<?php
	$mail=$_SESSION['email'];
	$query="SELECT * from teacher where email='$mail'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	?>
	<ul><p><a href="../homepage_teacher.php">Automated Programming Judge</a></p>
			<li style=" margin:-3% 1% 1% 0%;"><a href="edit-profile.php"><img src="../icons/user.png" ><p  class="usrname"><?php echo $row['fname'];?> </p></a></li>
			<li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>

	</ul>
</div>

<div>
	<h2> Please select a Course for which you want to see the assignment</h2>
	<form id="askcourseform" action="/">
		<?php 
			$result1=mysql_query("SELECT * from `teacher-course` WHERE teacherid='$row[teacherid]'");
			$num=mysql_num_rows($result1);
			if($num==0)
			{
				echo '<h3> No opted courses </h3>';
			}
			else {
			while($row1=mysql_fetch_assoc($result1))
			{
				$sql="SELECT * from courses where courseid='$row1[courseid]'";
          		$answer=mysql_query($sql);
    			$row2=mysql_fetch_assoc($answer);
				echo '<input type="radio" name="courses" id="courses" value="'.$row2['courseid'].'">'.$row2['coursename'];
				echo '<br>';
			}
			echo '<button type="button" onclick="submitquery()"> Submit </button>';
		}
			?>
	</form>
	</div>

	<div id="assignmentdisplay">
	</div>



</body>
</html>


<script>
function submitquery()
{
			var courses=$('#courses').val();
			jQuery.ajax({
				type: "POST",
				url: "assignment-display-script.php",
				data: "courses="+courses,
				cache: false,
				success: function(response)
				{
					$("#assignmentdisplay").html(response);
				}
			})
}

</script>

</script>