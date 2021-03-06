<?php
require_once('dbConn.php');
ini_set('display_errors', 'On');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
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
if(isset($_POST['lightLevel']))
{
$lightLevel=mysqli_real_escape_string($success,$_POST['lightLevel']);
$lightIntensity = mysqli_real_escape_string($success,$_POST['lightIntensity']);
$room = mysqli_real_escape_string($success,$_POST['roomNo']);

$query = "INSERT INTO light ". "(Time, LightLevel, LightIntensity, RoomNo)" . "VALUES(NOW(), '$lightLevel', '$lightIntensity', '$room')";


$retval = mysqli_query( $success, $query );

if(! $retval ) {
   die('Could not enter data: ' . mysql_error());
   echo 'FAIL';
}

echo "Entered data successfully\n";
}
else{//query to get data from the table
    $query2 = sprintf("SELECT time, LightLevel, LightIntensity, RoomNo FROM  light");
    
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
?>