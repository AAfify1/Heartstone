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
$user = 'aafify1@goshdb';
$pass = 'UCLprojectA1!';
$db = 'hospital';
$host = 'goshdb.mysql.database.azure.com';
$port = 3306;
 
 $conn = mysqli_init();
 $success=mysqli_connect( $host, $user, $pass, $db, $port);
 if (mysqli_connect_errno($conn)) {
 die('Failed to connect to MySQL: '.mysqli_connect_error());
 }

if(isset($_POST['temp']))
{
$temp=mysqli_real_escape_string($success,$_POST['temp']);
$hum = mysqli_real_escape_string($success,$_POST['hum']);
$room = mysqli_real_escape_string($success,$_POST['roomNo']);

$query = "INSERT INTO temphum ". "(time, temperature, humidity, roomNo)" . "VALUES(NOW(), '$temp', '$hum', '$room')";


$retval = mysqli_query( $success, $query );

if(! $retval ) {
   die('Could not enter data: ' . mysql_error());
   echo 'FAIL';
}
}

else{//query to get data from the table

    // if(isset($_GET['max']))
    // {
    //     $max = $_GET['max'];
    // }
    // else $max="100";
    $query2 = sprintf("SELECT time, temperature, humidity, roomNo FROM  temphum ");

//execute query
$result = $success->query($query2);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}


//free memory associated with result
$result->close();

//close connection


//now print the data
print json_encode($data);
}
mysqli_close($success);
// $data = substr($data, 0, strlen($data) - 1);
// $data .= ']]';
// header('Content-Type: application/json');
// echo $data;


?>
