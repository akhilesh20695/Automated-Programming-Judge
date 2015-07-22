<!DOCTYPE html>
<?php
include_once '../connection-script.php';
session_start();
if(!isset($_SESSION['email']))
{
  header('Location: index.php');
}

?>
<html>
<head>
	<meta charset="utf-8">
	<title>Last Assignment Submitted</title>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="../css/style.css">

	</head>
<body style="background-color:whitesmoke; height:100%;">

<div id="header" class="header">
  <?php
  $mail=$_SESSION['email'];
  $query="SELECT * from teacher where email='$mail'";
  $result=mysql_query($query);
  $row=mysql_fetch_array($result);
  ?>
  <ul><p><a href="../homepage_teacher.php">NAME</a></p>
      <li style=" margin:-3% 1% 1% 0%;"><a href="edit-profile.php"><img src="../icons/user.png" ><p  class="usrname"><?php echo $row['fname'];?> </p></a></li>
      <li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>

  </ul>
</div>
<div id="figures-pie" class="figure-pie">
	<div id="pie-details" style="background-color:white; width:350px; padding:10px;">

<?php
$assignmentno=$_GET['ass'];
$courseid=$_GET['courseid'];

$query1=mysql_query("SELECT * from `student-course` where courseid='$courseid'");
$totalstudents=mysql_num_rows($query1);


$query2=mysql_query("SELECT * from finalsubmission where courseid='$courseid' and assignmentno='$assignmentno'");
$submittedstudents=mysql_num_rows($query2);

$notsubmittedstudents=$totalstudents-$submittedstudents;


echo '<p>Total number of students: <b>'.$totalstudents.'</b></p>';
	echo '<p>Number of students with correct answer: '. $submittedstudents.'</p>';
	echo '<p>Number of students who did not submit: '.$notsubmittedstudents .'</p></div>';
    echo '<div id="piechart" style="width: 350px; height: 300px;"></div>';
?>
</div>
<div id="last-submitted" class="last-submitted">
<h2>Students who have submitted</h2>
    <div id="table_div"></div>
 
</div>
<div id="last-not-submitted" class="last-not-submitted">
	<h2>Students who have not submitted</h2>
    <div id="table_div1"></div>
 
</div>
</body>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawTable);
//------------------submitted--------------------------
      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'ID');
        data.addColumn('string', 'Name');
        data.addColumn('number', 'Points scored');
         
         <?php
         echo 'data.addRows([';
         $query=mysql_query("SELECT * from finalsubmission where courseid='$courseid' and assignmentno='$assignmentno'");
         $num=mysql_num_rows($query);
         while($row=mysql_fetch_assoc($query))
         {
          $query1=mysql_query("SELECT * from student where studentid='$row[studentid]'");
          $id=mysql_fetch_assoc($query1);
          echo "[".$row['studentid']." , '".$id['fname']."  ".$id['lname']."',". $row['totalmarks']."],";

         }
         echo ']);';
         ?>
        

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true});
      }
    </script>
  
     <script type="text/javascript">
    //-------------not submitted---------------------
      google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'ID');
        data.addColumn('string', 'Name');
        data.addRows([
          <?php
        $query=mysql_query("SELECT * from `student-course` where studentid NOT IN (SELECT studentid from finalsubmission where assignmentno='$assignmentno' and courseid='$courseid')");
        while($row=mysql_fetch_assoc($query))
        {
          $query1=mysql_query("SELECT * from student where studentid='$row[studentid]'");
          $id=mysql_fetch_assoc($query1);
           echo "[".$row['studentid']." , '".$id['fname']."  ".$id['lname']."],";

        }  
?>
        ]);
        var table = new google.visualization.Table(document.getElementById('table_div1'));

        table.draw(data, {showRowNumber: true});
      }
    </script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Submissions', 'Number of students'],
          ['Correct', <?php echo $submittedstudents ?>  ],
          ['Not submitted', <?php echo $notsubmittedstudents ?> ]
                ]);

        var options = {
          title: 'Submission statistics'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</html>
