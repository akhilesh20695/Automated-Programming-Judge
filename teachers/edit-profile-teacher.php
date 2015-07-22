<!DOCTYPE html>
<?php
include_once '../connection-script.php';
session_start();
?>
<html>
<head>
  <title> Profile Setting</title>
  <link rel="stylesheet" type="text/css" href="../css/editprofile.css">
  <script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="../js/upload-dp.js"></script>
  	<link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/student_style.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">


<script>
    $(document).ready(function(){$('#pwd').blur(password_check);});
    function password_check()
    {
      var id=$('#pwd').val();
      jQuery.ajax({
        type: "GET",
        url: "password-checker-script.php",
        data: 'pwd='+id,
        cache: false,
        success: function(response)
        {
          if(response==0)
          {
            $("#pwd").val("");
            alert("Wrong Password");
          }
          else
          {
            
            $("#newpwddiv").fadeIn();
          }
        }
      })
    }

    </script>




</head>

<script type="text/javascript" src="../scripts/jquery.min.js"></script>
<script type="text/javascript" src="../scripts/jquery.form.js"></script>

<style>
.preview
{
width:200px;
border:solid 1px #dedede;
padding:10px;
}
#preview
{
color:#cc0000;
font-size:12px
}

</style>









<body>
<?php
   $mail=$_SESSION['email'];
   $result=mysql_query("SELECT * FROM teacher where email='$mail'");
   $row=mysql_fetch_array($result);
?>
<div id="header" class="header">
  <ul><p><a href="../homepage_teacher.php">NAME</a></p>
      <li style=" margin:-3% 1% 1% 0%;"><a href="../signout-script.php">Log Out</a></li>
  </ul>
</div>
<div class="container_outer" >
<div class="row">
    <div >
       <div class="well profile" name="dpdiv" id="dpdiv">
            <div >
                <div>
                  <?php
                    echo '<h2 style="text-align:center;">'.$row['fname'].' '.$row['lname'].'</h2>';
                  ?>    
                    </p>
                </div>             
                <div class="col-xs-12 col-sm-4 text-center">
                   <div id="profile-pic">
                    <figure>
                      <center>
                      <img style="margin:0 25%;" src="../icons/user.png" alt="" class="img-circle img-responsive" id="dp" height=200px width=200px >
                      </center>
                    </figure>
                  </div>

					
					
					
          <?php
          echo '<h2>My Courses:</h3>';
          $sql="SELECT * from `teacher-course` where teacherid='$row[teacherid]'";
          $query=mysql_query($sql);
          while($answer=mysql_fetch_assoc($query))
          {
            $query1=mysql_query("SELECT * from courses where courseid='$answer[courseid]'");
            $result=mysql_fetch_assoc($query1);
            echo '<h3>'.$result['coursename'].'</h3>';
          }
          ?>


          <!--Enter the current courses here -->
					<form method="POST" action="update-teacher-courses.php" style="left:5%;">
          <?php
          $sql="SELECT * from courses";
          $answer=mysql_query($sql);
          while($row1=mysql_fetch_array($answer))
          {
          echo '<input style="  display: inline; width: 100px;" type="checkbox" name="courses[]" value="'.$row1['courseid'].'"  >'.$row1['coursename'];
          echo '<br>';
          }
          ?>
          <input type="submit" value="Update">
					</form>
                

            </div>            
            
       </div>                 
    </div>
  </div>
</div>
<div class="container" style="height:100%;">
  <form style="top:0%; left:20%;" method="post" action="edit-profile-teacher-script.php">
    <div class="row">
      <h4>Account</h4>
      <div class="input-group input-group-icon">
        <?php
        echo '<input type="text" name="fname" placeholder="'.$row['fname'].'"/>';
        ?>
          <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
         <div class="input-group input-group-icon">
         <?php
        echo '<input type="text" name="lname" placeholder="'.$row['lname'].'"/>';
        ?>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <?php
        echo '<input type="text" name="newmail" placeholder="'.$row['email'].'"/>';
        ?>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      
    </div>
    <h4>To change your password, enter your current password and then the password you desire!</h4>
        <div class="row">

        <h4>Current Password</h4>
        <div class="input-group">
          
          <input type="password" placeholder="current password" id="pwd"/>
        
        </div>
      
      <div class="col-half"  id="newpwddiv" style="display:none;">
        <h4>New Password</h4>
        <div class="input-group">
          <input style="width:250px;" type="password" name="newpwd" placeholder="New Password" id="newpwd"/>
        </div>
      </div>

    </div>
    <button	 type="submit" value="Save!">Save!</button>
  </form>
</div>
<style type="text/css">
form input{
  width:350px;
}
.fa-envelope, .fa-user{
  left: -30px;
  position: relative;
}
</style>
</body>
</html>
