<!DOCTYPE html>
<?php
include_once 'connection-script.php';
session_start();
if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Add Questions</title>
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/teacher_style.css">
</head>
<body style="background-color:whitesmoke; height:100%;">

<div id="header" class="header">
	<?php
	$mail=$_SESSION['email'];
	$query="SELECT * from student where semail='$mail'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$filename=$row['studentid']."_dp";
	 $id=$row['studentid'];
	?>
	<ul><p><a href="homepage_student.php">NAME</a></p>
		
		<?php
		if(file_exists('pictures/'.$filename.'.jpg'))
		{
			echo '<li style="margin:-3% 1% 1% 0%;"><a href="#"><img src="pictures/'.$filename.'.jpg" ><p  class="usrname">'.$row['fname'].'</p></a>';
		}
		else if(file_exists('pictures/'.$filename.'.gif'))
		{
			echo '<li style="margin:-3% 1% 1% 0%;"><a href="#"><img src="pictures/'.$filename.'.gif" ><p  class="usrname">'.$row['fname'].'</p></a>';
		}
		else if(file_exists('pictures/'.$filename.'.png'))
		{
			echo '<li style="margin:-3% 1% 1% 0%;"><a href="#"><img src="pictures/'.$filename.'.png" ><p  class="usrname">'.$row['fname'].'</p></a>';
		} 
		else
		{
			echo '<li style="margin:-3% 1% 1% 0%;"><a href="#"><img src="icons/user.png"><p  class="usrname">'.$row['fname'].'</p></a>';
		}
		?>
		<ul>
				<li><a href="edit-profile.php">My Profile</a></li>
				<li><a href="table.php">My submissions</a></li>
		</ul>

		</li>
			<li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>
	</ul>
</div>


</div>
<div id="form_wrapper" class="form_wrapper">
	<h1 style="color:black; text-align:center;">Add question</h1>
	<form id="addquesform" style="width: 900px" action="/">
		<label>Domain:</label>
		 <select name="domains" id="domains">
		 	<?php
	         $query="SELECT * from domain";
	         $answer=mysql_query($query);
	         while($row=mysql_fetch_assoc($answer))
	         {
				echo '<option value="$row[domainname]">'.$row['domainname'].'</option>';
			 }
			 ?>
				</select><br>
		<label>Difficulty:</label>
		 <select name="difficulty" id="difficulty">
			  <option value="easy">Easy</option>
			  <option value="medium">Medium</option>
			  <option value="hard">Hard</option>
			  </select><br>
		<label>Question Name</label>
		<input type="text"name="qname" id="qname" placeholder="Question name">
		<br><label>Question</label>
		<textarea name="question" id="question" rows="10" cols="60"></textarea>
		<br><label>Sample Input</label>
		<textarea name="test_cases" id="test_cases" rows="10" cols="60"></textarea>
		<br><label>Sample Output</label>
		<textarea name="output" id="output" rows="10" cols="60"></textarea>
		<br><label class="check"><input type="checkbox" name="add_more" id="add_more" onchange="show()" style="border:0px solid;">Add more test cases</label><br>
		<div class="moretestcases" id="moretestcases" style="display:none;">
			<br><label>Sample Input</label>
			<textarea name="test_cases" id="test_cases" rows="10" cols="60"></textarea>
			<br><label>Sample Output</label>
			<textarea name="output" id="output" rows="10" cols="60"></textarea>
		</div>	
		<button type="submit" id="question-button">Add Question</button><br>
	</form>
	</div>

<div id="quespost" class="form_wrapper results">
</div>

</body>
</html>

<script>
function show()
{
	var elems = document.getElementById('moretestcases');
	elems.style.display="block";
}


$("#addquesform").submit(function(event) {

                event.preventDefault();
                var posting = $.post("add-question-script.php", $("#addquesform").serialize());

                posting.done(function(data) {
				$("#quespost").html(data);
                });
            });


</script>