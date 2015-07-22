<!DOCTYPE html>
<?php
include_once 'connection-script.php';
session_start();
if(!isset($_SESSION['email']))
{
    header('Location: index.php');
}
$mail=$_SESSION['email'];
$domain=$_GET['domain'];
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Questions</title>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.9.1.js">
</script>

	</head>
<body style="background-color:whitesmoke; height:100%;">

<div id="header" class="header">
    <?php
    $mail=$_SESSION['email'];
    $query="SELECT * from student where semail='$mail'";
    $result=mysql_query($query);
    $row=mysql_fetch_array($result);
    $filename=$row['studentid']."_dp";
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
<br>
<br>
<br>
<br>
<br>
<div class="navig" >
<p><a href="homepage_student.php">Home</a> > <a href="domains.php">Domains</a> > <a href="questions.php?domain= <?php echo $domain ?>"> <?php echo $domain ?> </a> </p></div>
  <div class="sub_header">
   <p class="compile"><a href="code-compile-run/code-compile-run.php">Code compile and run</a></p>
<div class="content_wrapper">
	<div class="tabs">
    <ul class="tab-links">
        <li class="active"><a href="#tab1">Easy</a></li>
        <li><a href="#tab2">Medium</a></li>
        <li><a href="#tab3">Hard</a></li>
       
    </ul>
 
    <div class="tab-content">
        <div id="tab1" class="tab active">
            


            <?php
$query="SELECT * FROM practiceques,domain WHERE domain.domainname='$domain' and domain.id=practiceques.did and practiceques.difficulty='easy'";
$result=mysql_query($query);

    
$result3=mysql_query("SELECT studentid from student where semail='$mail'");
$row1=mysql_fetch_assoc($result3);
$id=$row1['studentid'];


while($row=mysql_fetch_array($result))
{
    $query3="SELECT * from points where s_id='$id' and ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";
    $result4=mysql_query($query3);
    $num=mysql_num_rows($result4);

    if($num == 0)
    {

        $query1="SELECT count(*) as total from points where ques_id=$row[quesid] and domain_id=$row[did]";
        $query2="SELECT count(*) as correct from points where ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";

        $result1=mysql_query($query1);
        $result2=mysql_query($query2);

        $row1=mysql_fetch_assoc($result1);
        $row2=mysql_fetch_assoc($result2);

        if($row1['total']==0)
        {
            $percent=0;
        }
        else
        {
            $percent=($row2['correct'])/$row1['total'];
            $percent=$percent*100;
        }
       
        echo '<div id="question" class="question">';
        echo '<p class="q_name">'.$row['quesname'].'</p>';
        echo '<p class="max_points">Maximum Points: '.$row['marks'].'</p>';
        echo '<p class="percent">Success Percentage: '.$percent.'%</p>';
        $id=$row['quesid'];
        $did=$row['did'];
        echo '<p class="try_it"><a href="compiler/question_display.php?qid='.$id.'&did='.$did.'"'.'>Try It</a></p>';
        echo '</div>';
    }
    else
    {
        $query1="SELECT count(*) as total from points where ques_id=$row[quesid] and domain_id=$row[did]";
        $query2="SELECT count(*) as correct from points where ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";

        $result1=mysql_query($query1);
        $result2=mysql_query($query2);

        $row1=mysql_fetch_assoc($result1);
        $row2=mysql_fetch_assoc($result2);
       
         if($row1['total']==0)
        {
            $percent=0;
        }
        else
        {
            $percent=($row2['correct'])/$row1['total'];
            $percent=$percent*100;
        }
       
        echo '<div id="question" class="question">';
        echo '<img src="icons/tick.png">';
        echo '<p class="q_name">'.$row['quesname'].'</p>';
        echo '<p class="max_points">Maximum Points: '.$row['marks'].'</p>';
        echo '<p class="percent">Success Percentage: '.$percent.'%</p>';
        echo '</div>';

    }

}
    ?>
      </div>
 
        <div id="tab2" class="tab">
        <?php
$query="SELECT * FROM practiceques,domain WHERE domain.domainname='$domain' and domain.id=practiceques.did and practiceques.difficulty='medium'";
$result=mysql_query($query);

    
$result3=mysql_query("SELECT studentid from student where semail='$mail'");
$row1=mysql_fetch_array($result3);


while($row=mysql_fetch_array($result))
{
    $query3="SELECT * from points where s_id='$id' and ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";
    $result4=mysql_query($query3);
    $num=mysql_num_rows($result4);

    if($num == 0)
    {

       $query1="SELECT count(*) as total from points where ques_id=$row[quesid] and domain_id=$row[did]";
        $query2="SELECT count(*) as correct from points where ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";

        $result1=mysql_query($query1);
        $result2=mysql_query($query2);

        $row1=mysql_fetch_assoc($result1);
        $row2=mysql_fetch_assoc($result2);
       
         if($row1['total']==0)
        {
            $percent=0;
        }
        else
        {
            $percent=($row2['correct'])/$row1['total'];
            $percent=$percent*100;
        }
        echo '<div id="question" class="question">';
        echo '<p class="q_name">'.$row['quesname'].'</p>';
        echo '<p class="max_points">Maximum Points: '.$row['marks'].'</p>';
        echo '<p class="percent">Success Percentage: '.$percent.'%</p>';
        $id=$row['quesid'];
        $did=$row['did'];
        echo '<p class="try_it"><a href="compiler/question_display.php?qid='.$id.'&did='.$did.'"'.'>Try It</a></p>';
        echo '</div>';
    }
    else
    {
        $query1="SELECT count(*) as total from points where ques_id=$row[quesid] and domain_id=$row[did]";
        $query2="SELECT count(*) as correct from points where ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";

        $result1=mysql_query($query1);
        $result2=mysql_query($query2);

        $row1=mysql_fetch_assoc($result1);
        $row2=mysql_fetch_assoc($result2);
       
        if($row1['total']==0)
        {
            $percent=0;
        }
        else
        {
            $percent=($row2['correct'])/$row1['total'];
            $percent=$percent*100;
        }
        echo '<div id="question" class="question">';
        echo '<img src="icons/tick.png">';
        echo '<p class="q_name">'.$row['quesname'].'</p>';
        echo '<p class="max_points">Maximum Points: '.$row['marks'].'</p>';
        echo '<p class="percent">Success Percentage: '.$percent.'%</p>';
        echo '</div>';

    }

}
    ?>
            </div>
 
        <div id="tab3" class="tab">
             	<?php
$query="SELECT * FROM practiceques,domain WHERE domain.domainname='$domain' and domain.id=practiceques.did and practiceques.difficulty='hard'";
$result=mysql_query($query);

    
$result3=mysql_query("SELECT studentid from student where semail='$mail'");
$row1=mysql_fetch_array($result3);


while($row=mysql_fetch_array($result))
{
    $query3="SELECT * from points where s_id='$id' and ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";
    $result4=mysql_query($query3);
    $num=mysql_num_rows($result4);

    if($num == 0)
    {

        $query1="SELECT count(*) as total from points where ques_id=$row[quesid] and domain_id=$row[did]";
        $query2="SELECT count(*) as correct from points where ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";

        $result1=mysql_query($query1);
        $result2=mysql_query($query2);

        $row1=mysql_fetch_assoc($result1);
        $row2=mysql_fetch_assoc($result2);
       
         if($row1['total']==0)
        {
            $percent=0;
        }
        else
        {
            $percent=($row2['correct'])/$row1['total'];
            $percent=$percent*100;
        }
        echo '<div id="question" class="question">';
        echo '<p class="q_name">'.$row['quesname'].'</p>';
        echo '<p class="max_points">Maximum Points: '.$row['marks'].'</p>';
        echo '<p class="percent">Success Percentage: '.$percent.'%</p>';
        $id=$row['quesid'];
        $did=$row['did'];
        echo '<p class="try_it"><a href="compiler/question_display.php?qid='.$id.'&did='.$did.'"'.'>Try It</a></p>';
        echo '</div>';
    }
    else
    {
        $query1="SELECT count(*) as total from points where ques_id=$row[quesid] and domain_id=$row[did]";
        $query2="SELECT count(*) as correct from points where ques_id=$row[quesid] and domain_id=$row[did] and answer_status=1";

        $result1=mysql_query($query1);
        $result2=mysql_query($query2);

        $row1=mysql_fetch_assoc($result1);
        $row2=mysql_fetch_assoc($result2);
       
         if($row1['total']==0)
        {
            $percent=0;
        }
        else
        {
            $percent=($row2['correct'])/$row1['total'];
            $percent=$percent*100;
        }
        echo '<div id="question" class="question">';
        echo '<img src="icons/tick.png">';
        echo '<p class="q_name">'.$row['quesname'].'</p>';
        echo '<p class="max_points">Maximum Points: '.$row['marks'].'</p>';
        echo '<p class="percent">Success Percentage: '.$percent.'%</p>';
        echo '</div>';

    }

}
    ?>   </div>
 
    </div>
	</div>
	</div>
    </div>	<script type="text/javascript">
	jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
</script>

</body>
</html>
