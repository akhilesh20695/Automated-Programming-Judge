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
	<title>Evaluate Performance</title>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
 <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> 
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 
	</head>
<body  style="background-color:whitesoke;">

<div id="header" class="header">
  <?php
  $mail=$_SESSION['email'];
  $query="SELECT * from student where semail='$mail'";
  $result=mysql_query($query);
  $row=mysql_fetch_array($result);
  $filename=$row['studentid']."_dp";
  ?>
  <ul><p><a href="homepage_student.php">NAME</a></p>
    <li style=" margin:-3% 1% 1% 0%;"><a href="edit-profile.php"><?php echo '<img src="pictures/'.$filename.'.jpg" >';?><p  class="usrname"><?php echo $row['fname'];?> </p></a></li>
      <li style=" margin:-3% 1% 1% 0%;"><a href="signout-script.php">Log Out</a></li>
  </ul>
</div>
<div class="sub_header">
   <p class="evaluate"><a href="#">Evaluate Practice Session</a></p>
  </div>
    <!--Load the AJAX API-->
     <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart','table']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(initialize);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function initialize(){
		  createTable();
		 
	  }
      function createTable(){
		  var cssClassNames = {
'headerRow': 'headRow',
'tableRow': 'evenRow',
'oddTableRow': 'oddRow',
'selectedTableRow': 'selRow',
'hoverTableRow': 'hovRow',
'headerCell': '',
'tableCell': '',
'rowNumberCell': ''};

var options = {'showRowNumber': true, 'allowHtml': true, 'width':900, 'height':400, 'cssClassNames': cssClassNames};

		     var table = new google.visualization.DataTable();
		     table.addColumn('string' , 'Assignment');
		      table.addColumn('date' , 'Submission Due On');
		     table.addColumn('date' , 'Submitted On');
		     table.addColumn('number' , 'Maximum Points');
		     table.addColumn('number' , 'Points Scored');
		     table.addRows([
		      ['Assignment 1', {v:new Date(2014,2,8), f:'February 8, 2014'},{v:new Date(2014,2,9), f:'February 9, 2014'}, 30 ,20],
		      ['Assignment 2', new Date(2014,2,25),new Date(2014,2,27), 30 ,20],
		      ['Assignment 3', new Date(2014,3,10), new Date(2014,3,15),30 ,25],
		      ['Assignment 4', new Date(2014,4,28),new Date(2014,4,30), 30 ,10],
		      ['Assignment 5', new Date(2014,5,18), new Date(2014,5,21),30 ,20],
		      ['Assignment 6', new Date(2015,6,8), new Date(2014,6,10),30 ,22]
		      ]);
		     
       var t1 = new google.visualization.Table(document.getElementById('table_div_11'));
  t1.draw(table, options);
   drawChart(table);

      };
      function drawChart(table) {
var rows=table.getNumberOfRows();
	var percent; 
	var tip='';
        // Create the data table.
     var data= new google.visualization.DataTable();
      data.addColumn('string' , 'Assignment Number');
       data.addColumn('number' , 'Performance Percentage');
        data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
   for(var i=0;i<rows;i++){
		 percent=((table.getValue(i,4)/table.getValue(i,3))*100);
		  tip='<b>'+table.getValue(i,0) +'</b><br>Total Points: '+table.getValue(i,3)+'<br>Points Scored : '+ table.getValue(i,4) + '<br>Success Percent: '+percent.toFixed(2);
		 data.addRow([table.getValue(i,0),percent,tip]);
	 }
    // Set chart options
        var options = {'title':'',
                       'width':900,
                       'legend':'none',
                       'colors': ['#8EDC9D'],
                        color: 'white',
                       backgroundColor: 'black',
                       tooltip: {isHtml: true},
                        bar: {groupWidth: '85%'},
                         viewWindowMode: 'explicit',
                         hAxis: {textStyle:{color: '#8EDC9D'}},
           vAxis: { gridlines: { count: 5 },
			     textStyle:{color: '#8EDC9D'},
			    minValue: 0,
                maxValue:100},
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  <div id="chart_div"></div>
  <div id="table_div_11"></div>

</body>
<style type="text/css">
.google-visualization-table-th, .google-visualization-table-td {
    border: 0px solid #EEE;
}
</style>
</html>
