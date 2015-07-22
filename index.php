<!DOCTYPE html>
<?php 
include_once 'connection-script.php';
session_start();
if (isset($_SESSION['email']))
{
	$mail=$_SESSION['email'];
	$result1=mysql_query("SELECT fname from student where semail='$mail' and activation=1");
	$result2=mysql_query("SELECT * from teacher where email='$mail'");
	$num1=mysql_num_rows($result1);
	$num2=mysql_num_rows($result2);
	if($num1==0)
	{
		if($num2==1)
		{
			header('Location: homepage_teacher.php');
		}
	}
	else
	{
		header('Location: homepage_student.php');
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Dangling Else</title>
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<script type="text/javascript">
		function clicked(){
		 
		 $('#teacher-signin').addClass('current');
		 $('#student-signin').removeClass('current');

       }
		</script>	
		<script>
		function stud(){
		 
		 $('#teacher-signin').removeClass('current');
		 $('#student-signin').addClass('current');
		 
		}
		</script>
		
		<script>
		function checkstudent()
		{
			var email=$('#email').val();
			var password=$('#password').val();
			jQuery.ajax({
				type: "POST",
				url: "signin-script.php",
				data: "email="+email+"&password="+password,
				cache: false,
				success: function(response)
				{
					if(response==1)
					{
						document.location.href="homepage_student.php";
					}
					else if(response==2)
					{
						document.location.href="account_unactivated.php";
					}
					else if(response==3)
					{
						$("#email").val("");
						$("#password").val("");
						alert("It seems like you are invisible! Please sign up first!");	
					}
					else
					{
						$("#email").val("");
						$("#password").val("");
						alert("Whoops! Seems like wrong password!");
					}
				}
			})
		}
		

		function checkteacher()
		{
			var email=$('#teacher_email').val();
			var password=$('#teacher_password').val();
			jQuery.ajax({
				type: "POST",
				url: "signin-teacher-script.php",
				data: "teacher_email="+email+"&teacher_password="+password,
				cache: false,
				success: function(response)
				{
					if(response==1)
					{
						document.location.href="homepage_teacher.php";
					}
					else if(response==2)
					{
						$("#email").val("");
						$("#password").val("");
						alert("Whoops! Seems like wrong password!");
					}
					else
					{
						$("#email").val("");
						$("#password").val("");
						alert("It seems like you are not added");	
					}
				}
			})
		}



		$(document).ready(function(){$('#id1').blur(id_check);});
		function id_check()
		{
			var id=$('#id1').val();
			jQuery.ajax({
				type: "GET",
				url: "id-checker-script.php",
				data: 'id='+id,
				cache: false,
				success: function(response)
				{
					if(response==1)
					{
						$("#id1").val("");
						alert("ID already exist");
					}
					else
					{
						$("#email").val($("#id1").val());
					}
				}
			})
		}
		</script>
		<link rel="stylesheet" type="text/css" href="css/form.css">

		</head>
<body>
<div id="header" class="header">
	<ul><p><a href="#">Automated Judge</a></p>
		<li style=" margin:-3% 1% 1% 0%;"> <a href="forum/index.php" target="_blank">Forum</a></li>
	<li style=" margin:-3% 1% 1% 0%;"> <a class="js-open-modal" href="#" data-modal-id="page3">The Team</a></li>
	<li style=" margin:-3% 1% 1% 0%;"> <a href="#page2">About us</a></li>
	
	</ul>
</div>
<div id="move_back" class="back_img">
<img src="icons/e.png">
</div>
	<div id="page1" class="home">
		<h2>Dangling Else</h2>
	   <a class="js-open-modal btn btn1" href="#" data-modal-id="popup1"> Sign In</a>
	   <a class="js-open-modal btn btn2" href="#" data-modal-id="popup2"> Sign Up</a>
	 </div>
  
   
<div id="popup1" class="modal-box" style="top: 108.5px;left: 452.5px;">
	 
   	<div class="sinin-up">
    	<ul class="sinin-up-links">
	        <li id="student1" class="current"><a href="#student-signin" onclick="stud()">Student</a></li>
	        <li id="teacher1" ><a href="#signin1" onclick="clicked()">Teacher</a></li>
    	</ul>
   	</div>
  
  	<header><a href="#" class="js-modal-close close">×</a></header>
   	<div class="sign-content">
        <div id="student-signin" class="swap current">
		<div id="signin" class="popup">
		<form class="form popup-content"  action="signin-script.php" method="post">
				<input type="email" placeholder="Email" id="email" name="email" required="true">
				<input type="password" placeholder="Password" id="password" name="password" required="true">
				<button type="button" id="login-button" onclick="checkstudent()" class="button">Login</button>
				<p style="text-align:center;"><a href="forgot_password_student.php">Oops! I forgot my Password!</a></p>	
		</form>
		</div>		
		</div>

	
	
		<div id="teacher-signin" class="swap">
		<div id="signin1" class="popup">
		<form class="form popup-content" action="signin-teacher-script.php" method="post">
				<input type="email" placeholder="Email" name="teacher_email" id="teacher_email" required="true">
				<input type="password" placeholder="Password" name="teacher_password" id="teacher_password" required="true">
				<button type="button" id="login-button" onclick="checkteacher()" class="button">Login</button>	
				<p style="text-align:center;"><a href="forgot_password_teacher.php">Oops! I forgot my Password!</a></p>
		</form>
		</div>
		</div>
	</div>
</div>
	<div id="popup2" class="modal-box" style="top: 108.5px;left: 452.5px;">
  <header><h2>signUp(student)</h2><a href="#" class="js-modal-close close">×</a></header>
	<div id="signup" class="popup">
		<form class="form popup-content" action="signup-script.php" method="post">
			<input type="text" name="fname" placeholder="First name" required="true">
			<input type="text" name="lname" placeholder="Last name" required="true">
			<input type="text" name="id" id="id1" placeholder="ID" value="" required="true">
			<label>@iiitvadodara.ac.in<input type="text" name="email" id="email" placeholder="Email" value="" required="true"></label>
			<input type="password" name="password" placeholder="Password" required="true">
			<button type="submit" id="login-button" class="button">Sign Up</button><br>
			 <footer> <a href="#" class="btn btn-small js-modal-close">Close</a> </footer>
					</form>
	</div></div>
	<div id="page2" class="roll">
	<div class="wrap">
		<h3 style="text-align:center";>Easy access! Easy submissions!</h3>
	<table id="index_table">
	<tr>
		<td><div class="image"><img src="icons/index/notification.png"></div>
			<div class="we-do"><h4>Notifications</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
			<td><div class="image"><img src="icons/index/assignments.png"></div>
			<div class="we-do"><h4>Submit assignments</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
			<td><div class="image"><img src="icons/index/practice.png"></div>
			<div class="we-do"><h4>Practice questions</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
	</tr>
		<tr>
		<td><div class="image"><img src="icons/index/performance.png"></div>
			<div class="we-do"><h4>Performance graphs</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
			<td><div class="image"><img src="icons/index/competition.png"></div>
			<div class="we-do"><h4>Competitions</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
			<td><div class="image"><img src="icons/index/compile.png"></div>
			<div class="we-do"><h4>Code compiler</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
	</tr>
		<tr>
		<td><div class="image"><img src="icons/index/add_ques.png"></div>
			<div class="we-do"><h4>Add questions</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
			<td><div class="image"><img src="icons/index/ranking.png"></div>
			<div class="we-do"><h4>Ranking</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
			<td><div class="image"><img src="icons/index/aptitude.png"></div>
			<div class="we-do"><h4>General Aptitude</h4>
			<p>With the new notification center you'll easily stay updated and on track. </p></div>
		</td>
	</tr>
	</table>

</div>  
	</div>
	<div id="page3" class="pg3 modal-box" style="top: 138.5px; width: 700px;height: 330px;left: 25%; background-color: rgba(0,0,0,0.8);">
		 <header><h2 style="color:white;"x>Our Team</h2> <a href="#" class="js-modal-close close">×</a></header>
 
<div id="akhil"  class="flip-container">
  <div class="front"><img class="dp" src="files/akhilesh.jpg">
  </div>
  <div class="back"> <h2 style="margin-top: 20%;">AKHILESH<br> KUMAR</h2>
  <img class="link-icon" src="icons/email.png">
  <img class="link-icon"  src="icons/linkedin.png">
  </div>
</div>
 <div id="shalinee" class="flip-container">
  <div class="front">  <img class="dp" src="files/shalinee.jpg">
  </div>
 <div class="back"> <h2 style="margin-top: 20%;">SHALINEE<br> SINGH</h2>
  <img  class="link-icon"  src="icons/email.png">
  <img  class="link-icon"  src="icons/linkedin.png">
  </div>
</div>
<div id="nitin" class="flip-container">
  <div class="front"><img class="dp" src="files/nitin.jpg">
</div>
  <div class="back">
	   <h2 style="margin-top: 20%;"> NITIN<br> SINGH</h2>
  <img class="link-icon"  src="icons/email.png">
  <img  class="link-icon"  src="icons/linkedin.png">
  </div>
</div>
	</div>
<div id="footer">
<p class="copy">&copy;All Rights Reserved</p>
</div>
<script type="text/javascript">
$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

	$('a[data-modal-id]').click(function(e) {
		e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());
	});  
  
  
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
    });
 
});
 /*
$(window).resize(function() {
    $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
    });
});
 
$(window).resize();
*/
});
</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
    jQuery('.sinin-up .sinin-up-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.sinin-up' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current swap to current
        
 
        e.preventDefault();
    });
});
</script>
</body>
</html>
