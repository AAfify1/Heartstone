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

//$link = mysqli_init();


  /* $success = mysqli_real_connect(
    $link,
    $host,
    $user,
    $password,
    $db,
    $port
 ) or die('Error connecting to MySQL server.');
 */

$flag = FALSE;

if ($success)
{
  echo ('Connection Made');
}

/*Post variable*/
if(isset($_POST['firstname'])){

 $firstname = mysqli_real_escape_string($success,$_POST['firstname']);

 $lastname  = mysqli_real_escape_string($success,$_POST['lastname']);

 $email     = mysqli_real_escape_string($success,$_POST['email']);

 $password  = mysqli_real_escape_string($success,$_POST['pass1']);

 $password2  = mysqli_real_escape_string($success,$_POST['pass2']);

 if(isset($_POST['isadmin']))

{

    $admin = "1";

}

else

{

$admin = "0";

}   


if ( $password == $password2)

{
$salted = "dflasgfaipurghaouierga;gljaiguoan".$password."adknf'oasgiubwgnbns";
$hashed = password_hash($password,PASSWORD_BCRYPT);


$register_query = " INSERT INTO  staff (FirstName,LastName,Email,Authentication,isAdmin)VALUES 
('".$firstname."','".$lastname."','".$email."','".$hashed."','".$admin."')";


echo("$register_query");
  

 try{

$register_result = mysqli_query($success, $register_query);

echo ("\n $firstname , $lastname, $email, $cardid, $password \n");

echo("$register_result");
  
if(mysqli_affected_rows($success)>0){
echo ('it works');
 header("Location:index.php?msg=goodboy");

}
else{
  header("Location:registration.php?msg=DB Error");
  
}
 
 


}catch(Exception $ex){
echo("error".$ex->getMessage());
  }


  
}
else{header("Location:registration.php?msg=passwords do not match");

 echo ("passwords do not match");
}
}
else echo ("no data");

?>
 
