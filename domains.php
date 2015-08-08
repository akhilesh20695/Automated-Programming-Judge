
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
	<title>Questions</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
			<link rel="stylesheet" type="text/css" href="css/hover.css">

<script type="text/javascript"></script>
	</head>
	<body  style="background-color: black; margin-top: 60px; height:auto">
<header>
  <div class="sub_header">
   <p class="compile"><a href="code-compile-run/code-compile-run.php">Code compile and run</a></p>
 </div>
  <div class='container'>
    <h1>Select your Domain</h1>
  </div>
</header>
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
<div class="navig" style="color:#ef7126">

<p><a style="color:#ef7126" href="homepage_student.php">Home</a> > <a style="color:#ef7126" href="domains.php">Domains</a></p>
</div>
<div class='container'>
  <ul>
	   <li>
      <a class='normal' href='questions.php?domain=contol'>
       <img src="icons/control.png">
      </a>
      <div class='info'>
        <h3>CONTROL STATEMENTS</h3>
        <p>If.. Then.. Else..<br>Control the flow of your programs with the control statements.</p>
      </div>
    </li>
    <li>
      <a class='normal' href='questions.php?domain=array'>
		   <img src="icons/array1.png">
      </a>
      <div class='info'>
        <h3>ARRAYS</h3>
        <p>The position you hold is what matters the most.<br> Take care of the indices.</p>
      </div>
    </li>
    <li>
      <a class='normal' href='questions.php?domain=strings'>
		   <img src="icons/string.png">
      </a>
      <div class='info'>
        <h3>STRINGS</h3>
        <p>Letters, words and sentences!<br>See their magic while you play with them.</p>
      </div>
    </li>
     <li>
      <a class='normal' href='questions.php?domain=recursion'>
		   <img src="icons/recursion1.png">
      </a>
      <div class='info'>
        <h3>RECURSION</h3>
        <p>Break it up!<br>This will make your problems seem much smaller and conquerable.</p>
      </div>
    </li>
     <li>
      <a class='normal' href='questions.php?domain=datastructures'>
		   <img src="icons/ds.png">
      </a>
      <div class='info'>
        <h3>DATA STRUCTURE</h3>
        <p>Manage your time along with the time complexity of these problems and learn how to store data efficiently.</p>
      </div>
    </li>
     <li>
      <a class='normal' href='questions.php?domain=oops'>
		   <img src="icons/oops.png">
      </a>
      <div class='info'>
        <h3>OBJECT ORIENTED PROGRAMMING</h3>
        <p>Create your own classes.<br>Play with the methods.<br>Manage your fields.</p>
      </div>
    </li>
	   <li>
      <a class='normal' href='questions.php?domain=inputoutput'>
         <img src="icons/i_o.png">
      </a>
      <div class='info'>
        <h3>INPUT / OUTPUT</h3>
        <p>Give yourself a kick start by solving these basic questions.</p>
      </div>
    </li>
     <li>
      <a class='normal' href='questions.php?domain=algorithms'>
		   <img src="icons/algo.png">
      </a>
      <div class='info'>
        <h3>ALGORITHMS</h3>
        <p>Try out these famous algorithms which takes up a large part of computer science.</p>
      </div>
    </li>
     <li>
      <a class='normal' href='questions.php?domain=ra'>
		   <img src="icons/sql.png">
      </a>
      <div class='info'>
        <h3>DATABASE</h3>
        <p>What will be the use of such complex applications when the data could not be stored?<br>Master this storage facility of data.</p>
      </div>
    </li>
     <li>
      <a class='normal' href='questions.php?domain=sql'>
		   <img src="icons/sql1.png">
      </a>
      <div class='info'>
        <h3>SQL</h3>
        <p>Master the official language of communication with the databases.</p>
      </div>
    </li>
    <li>
      <a class='normal' href='questions.php?domain=brainstormers'>
       <img src="icons/brain.png">
      </a>
      <div class='info'>
        <h3>BRAIN STORMERS</h3>
        <p>Play with numbers, strings, pointers all at one place!<br>Make them your puppets and let them dance on your tune.</p>
      </div>
    </li>
    <li>
      <a class='normal' href='questions.php?domain=aptitude'>
		   <img src="icons/aptitude1.png">
      </a>
      <div class='info'>
        <h3>APTITUDE</h3>
        <p>Get ready to face the world!<br>Challenge your brain to do better than its best.</p>
      </div>
    </li>
  </ul>
</div>


<script type="text/javascript">


// - Noel Delgado | @pixelia_me



var nodes  = document.querySelectorAll('li'),
    _nodes = [].slice.call(nodes, 0);

var getDirection = function (ev, obj) {
    var w = obj.offsetWidth,
        h = obj.offsetHeight,
        x = (ev.pageX - obj.offsetLeft - (w / 2) * (w > h ? (h / w) : 1)),
        y = (ev.pageY - obj.offsetTop - (h / 2) * (h > w ? (w / h) : 1)),
        d = Math.round( Math.atan2(y, x) / 1.57079633 + 5 ) % 4;
  
    return d;
};

var addClass = function ( ev, obj, state ) {
    var direction = getDirection( ev, obj ),
        class_suffix = "";
    
    obj.className = "";
    
    switch ( direction ) {
        case 0 : class_suffix = '-top';    break;
        case 1 : class_suffix = '-right';  break;
        case 2 : class_suffix = '-bottom'; break;
        case 3 : class_suffix = '-left';   break;
    }
    
    obj.classList.add( state + class_suffix );
};

// bind events
_nodes.forEach(function (el) {
    el.addEventListener('mouseover', function (ev) {
        addClass( ev, this, 'in' );
    }, false);

    el.addEventListener('mouseout', function (ev) {
        addClass( ev, this, 'out' );
    }, false);
});
</script>
</body>
</html>
