<?php
error_reporting(0);
include_once '../connection-script.php';
session_start();


$user = 'riaz2012';
$pass = 'snake123';
$code = '';
$input = '';
$run = true;
$private = false;

$subStatus = array(
    0 => 'Success',
    1 => 'Compiled',
    3 => 'Running',
    11 => 'Compilation Error',
    12 => 'Runtime Error',
    13 => 'Timelimit exceeded',
    15 => 'Success',
    17 => 'memory limit exceeded',
    19 => 'illegal system call',
    20 => 'internal error'
);

$error = array(
    'status' => 'error',
    'output' => 'Something went wrong :('
);

//echo json_encode( array( 'hi', 1 ) ); exit;
//print_r( $_POST ); exit;

if ( isset( $_POST['process'] ) && $_POST['process'] == 1 ) {
    $lang = isset( $_POST['lang'] ) ? intval( $_POST['lang'] ) : 1;
    $input = trim( $_POST['input'] );
    $code = trim( $_POST['source'] );
    $answerfile=$_POST['answerfile'];
    $outputfile=$_POST['outputfile'];

    $client = new SoapClient( "http://ideone.com/api/1/service.wsdl" );

    //create new submission
    $result = $client->createSubmission( $user, $pass, $code, $lang, $input, $run, $private );

    //if submission is OK, get the status
    if ( $result['error'] == 'OK' ) {
        $status = $client->getSubmissionStatus( $user, $pass, $result['link'] );
        if ( $status['error'] == 'OK' ) {

            //check if the status is 0, otherwise getSubmissionStatus again
            while ( $status['status'] != 0 ) {
                sleep( 3 ); //sleep 3 seconds
                $status = $client->getSubmissionStatus( $user, $pass, $result['link'] );
            }

            //finally get the submission results
            $details = $client->getSubmissionDetails( $user, $pass, $result['link'], true, true, true, true, true );
            if ( $details['error'] == 'OK' ) {
                //print_r( $details );
                if ( $details['status'] < 0 ) {
                    $status = 'waiting for compilation';
                } else {
                    $status = $subStatus[$details['status']];
                }

                $data = array(
                    'status' => 'success',
                    'meta' => "Status: $status | Memory: {$details['memory']} | Returned value: {$details['status']} | Time: {$details['time']}s",
                    'output' =>  $details['output'],
                    'raw' => $details
                );

                
                if( $details['cmpinfo'] ) {
                    $data['cmpinfo'] = $details['cmpinfo'];
                }
                
                $myfile=fopen("output.txt","w");
                fwrite($myfile, $data['output']); 
                fclose($myfile);

                $qid=$_POST['questionid'];
                $did=$_POST['domainid'];

                if(sha1_file("output.txt") == sha1_file($outputfile))
                {

                $file=fopen($answerfile,"w");
                fwrite($file,$code);
                fclose($file);

                $mail=$_SESSION['email'];
                $query="SELECT * from student where semail='$mail'";
                $result1=mysql_query($query);
                $row1=mysql_fetch_array($result1);
                $sid=$row1['studentid'];


                $sql="SELECT * from practiceques where did='$did' and quesid='$qid'";
                $result=mysql_query($sql);
                $row=mysql_fetch_array($result);
                $marks=$row['marks'];

                $curdate=date("Y-m-d H:i:s");

                $answer=mysql_query("INSERT INTO points VALUES ('$sid','$qid','$curdate',1,'$marks','$did')");

                echo json_encode( $data );
                
                }
                else 
                {
                    $mail=$_SESSION['email'];
                    $query="SELECT * from student where semail='$mail'";
                    $result1=mysql_query($query);
                    $row1=mysql_fetch_array($result1);
                    $sid=$row1['studentid'];



                    $sql="SELECT * from practiceques where did='$did' and quesid='$qid'";
                    $result=mysql_query($sql);
                    $row=mysql_fetch_array($result);
                    $marks=$row['marks'];

                    $curdate=date("Y-m-d H:i:s");

                    $answer=mysql_query("INSERT INTO points VALUES ('$sid','$qid','$curdate',0,0,'$did')");
                    echo json_encode($data);
                }
            } 
            else {
                //we got some error :(
                //print_r( $details );
                echo json_encode( $error );
            }
        } 
        else {
            //we got some error :(
            //print_r( $status );
            echo json_encode( $error );
        }
    } else {
        //we got some error :(
        //print_r( $result );
        echo json_encode( $error );
    }
}
?>