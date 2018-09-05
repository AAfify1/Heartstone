<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
//connection database

$user = 'aafify1@goshdb';
$pass = 'UCLprojectA1!';
$db = 'hospital';
$host = 'goshdb.mysql.database.azure.com';
$port = 3306;



//Establishes the connection
$conn = mysqli_init();
$success=mysqli_connect( $host, $user, $pass, $db, $port);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}
   $sql1="SELECT temperature FROM temphum ORDER BY time DESC LIMIT 1";
$sql2="SELECT MotionLevel FROM motion ORDER BY Time DESC LIMIT 1";
$sql3="SELECT NoiseLevel FROM noise ORDER BY Time DESC LIMIT 1";
$sql4="SELECT LightIntensity FROM light ORDER BY Time DESC LIMIT 1";



$temp = mysqli_query( $success,$sql1 );
$motion = mysqli_query( $success,$sql2 );
$noise = mysqli_query( $success,$sql3 );
$light = mysqli_query( $success,$sql4 );

   if (!$temp || !$motion|| !$noise|| !$light) {
       echo 'Could not run query: ' ;
       exit;
   }
   $row1 = mysqli_fetch_row($temp);
 $row2 = mysqli_fetch_row($motion);
 $row3 = mysqli_fetch_row($noise);
 $row4 = mysqli_fetch_row($light);

$temp = $row1[0];
$motion = $row2[0];
$noise = $row3[0];
$light = $row4[0];



//echo ("$temp + $motion + $noise + $light");

if ($temp > 20)
{
    $light1 = 'A';
}
else  $light1 = 'B';

if ($motion > 5)
{
    $light2 = 'A';
}
else  $light2 = 'B';

if ($noise > 5)
{
    $light3 = 'A';
}
else  $light3 = 'B';
if ($light > 5)
{
    $light4 = 'A';
}
else  $light4 = 'B';

   //header("L1=$light1 ,L2=$light2 X");


    mysqli_close($conn);


header("X-Sample-Test: $light1 + $light2 + $light3 + $light4^");
//echo("X-Sample-Test: $light1 + $light2 + $light3 + $light4");

/* Specify plain text content in our response */
header('Content-type: text/plain');

/* What headers are going to be sent? */
//var_dump(headers_list());

 ?>
