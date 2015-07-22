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
	<title>Evaluate performance of all students</title>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="../css/style.css">

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  
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

<div id="figures-line" class="figures-line">

    <div id="curve_chart" style="width: 900px; height: 500px"></div>

</div>

<div id="figures-bar" class="figures-bar">
	<div id="columnchart_material" style="width: 900px; height: 500px;"></div>
</div>

<div id="best-performers" class="best-performers">
	<h1 style="text-align:center;">Best performers</h1>
<table>
<thead>
	<th>Name</th>
	<th>ID</th>
	<th>Points</th>
</thead>
<tbody>
	<tr>
	<td>Shalinee Singh</td>
	<td>201351024</td>
	<td>300</td>
	</tr>
		<tr>
	<td>Nitin Singh</td>
	<td>201351024</td>
	<td>200</td>
	</tr>
		<tr>
	<td>Jigri</td>
	<td>201351009</td>
	<td>05</td>
	</tr>
</tbody>
</table>
</div>
</body>

 <script type="text/javascript">
	 
	 //--------------barchart------------------
      google.load("visualization", "1.1", {packages:["bar","corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
         
        var data = new google.visualization.DataTable();
         data.addColumn('number' , 'Assignments');
       data.addColumn('number' , 'Correct Answers');
         data.addColumn('number' , 'Inorrect Answers');
           data.addColumn('number' , 'Not Submitted');
          data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
        data.addRows([
          [1,  90,30,20,null],
          [2,  80,10,30,null],
          [3,  95,30,50,null],
          [4, 85,20,10,null],
           [5, 150,0,0,null]
        ]);
var rows=data.getNumberOfRows();
  for(var i=0;i<rows;i++){
		  tip='<br><b> Assignment: '+data.getValue(i,0)+'</b><br>Correct: '+data.getValue(i,1)+'</b><br>Incorrect: '+data.getValue(i,2)+
		  '</b><br>Not Submitted: '+data.getValue(i,3)+'<br>';
		 data.setCell(i,4,tip);
	 }
	 
        var options = {
          title: 'Submission of assignments',
         vAxis: { gridlines: { count: 10 },
			 axis:{label: 'number of students'},
			    minValue: 0,
                maxValue:150},
           hAxis: { gridlines: { count: 5 },
			    minValue: 0,
                maxValue:5},
                 title: "Date",
                 tooltip: {isHtml: true}
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
 
    <script type="text/javascript">
		//--------------linechart-----------------
		
      google.setOnLoadCallback(drawChart);

      function drawChart() {
		  
        var data = new google.visualization.DataTable();
         data.addColumn('number' , 'Assignment');
       data.addColumn('number' , 'Average Performance');
          data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
        data.addRows([
          [1,  90,null],
          [2,  80,null],
          [3,  95,null],
          [4, 85,null]
        ]);
var rows=data.getNumberOfRows();
  for(var i=0;i<rows;i++){
		  tip='<br><b>Assignment: '+data.getValue(i,0)+'</b><br>Average Points(out of 100): '+data.getValue(i,1)+'<br>';
		 data.setCell(i,2,tip);
	 }
	 
        var options = {
          title: 'Average performance of students',
         vAxis: { gridlines: { count: 5 },
			    minValue: 0,
                maxValue:100},
           hAxis: { gridlines: { count: 5 },
			    minValue: 0,
                maxValue:5},
                 tooltip: {isHtml: true}
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
</html>
