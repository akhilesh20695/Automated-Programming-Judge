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
	<title>default</title>
	<head>
<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
 <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> 
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 
	</head>
<body  style="background-color:whitesmoke; overflow-x:hidden;">

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

<div class="sub_header">
   <p class="evaluate"><a href="#">Evaluate Submissions</a></p>
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

var options = {'showRowNumber': true, 'allowHtml': true, 'width':900, 'cssClassNames': cssClassNames};

		     var table = new google.visualization.DataTable();
		     table.addColumn('string' , 'Question');
		     table.addColumn('date' , 'Final Submission');
		     table.addColumn('number' , 'Maximum Points');
		     table.addColumn('number' , 'Points Scored');
		     table.addRows([
		      ['Mike', {v:new Date(2012,1,28), f:'February 28, 2012'}, 30 ,20],
		      ['Mike', new Date(2012,4,25), 30 ,20],
		      ['Mike', new Date(2012,6,18), 30 ,20],
		      ['Mike', new Date(2013,5,28), 30 ,20],
		      ['Mike', new Date(2014,8,28), 30 ,20],
		      ['Mike', new Date(2015,5,28), 30 ,20]
		      ]);
		     
       var t1 = new google.visualization.Table(document.getElementById('table_div_12'));
  t1.draw(table, options);
   drawChart(table);

      };
      function drawChart(table) {
var rows=table.getNumberOfRows();
	var percent; 
	var tip='';
        // Create the data table.
     var data= new google.visualization.DataTable();
      data.addColumn('date' , 'Final Submission');
       data.addColumn('number' , 'Performance Percentage');
        data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
   for(var i=0;i<rows;i++){
		 percent=((table.getValue(i,3)/table.getValue(i,2))*100);
		  tip='<b>'+table.getValue(i,0)+'</b><br>Total Points: '+table.getValue(i,2)+'<br>Points Scored : '+ table.getValue(i,3) + '<br>Success Percent: '+percent.toFixed(2);
		 data.addRow([table.getValue(i,1),percent,tip]);
	 }
    // Set chart options
        var options = {'title':'',
                       'width':900,
                       'legend':'none',
                       'colors': ['#8EDC9D'],
                        color: 'white',
                       backgroundColor: 'black',
                       tooltip: {isHtml: true},
                        bar: {groupWidth: '95%'},
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
  <div id="table_div_12"></div>

</body>
<style type="text/css">
.google-visualization-table-th, .google-visualization-table-td {
    border: 0px none;
}
</style>
</html>
