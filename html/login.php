<?php
session_start();
//connection database

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
if (mysqli_connect_errno($success)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}


//echo"<script type='text/javascript'>alert('ok');</script>";
  


if(!empty($_POST["username"])) {

  //echo"<script type='text/javascript'>alert('ok');</script>";

  $email = mysqli_real_escape_string($success,$_POST["username"]);
  $password = $_POST["password"];
  

 

  $query = "SELECT * FROM staff WHERE Email='$email'";
     $result = mysqli_query($success,$query);
     if(! $result ) {
      die('Could not get data: ' . mysql_error());
      echo 'FAIL';
   }
     
    

     

  //echo (mysqli_num_rows($result));

  if(mysqli_num_rows($result)>0 ) {
    $row = mysqli_fetch_row($result);
    //echo $row;
    // if(password_verify($password,$row['4']))
    // {
    
   
    $msg= "Success";
    $_SESSION["username"] = $row['1'];
    $_SESSION["admin"] = $row['5'];
    $_SESSION["row"] = $row;
    header("Location:dashboard.php");
  //   }
    
  //   else
  //   {

  //  $msg = "Invalid Username or Password!";
  //  echo "<script type='text/javascript'>alert('$msg');</script>";
  //  header("Location:index.php?msg=Pass FAILED ".$row['4']);
   

  //  }

  }

   else
    {

   $msg = "Invalid Username or Password!";
   echo "<script type='text/javascript'>alert('$msg');</script>";
   header("Location:index.php?msg=email FAILED");
   

   }
   
   
}
else echo("post not working");
?>