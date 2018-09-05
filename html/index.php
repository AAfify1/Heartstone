<?php
session_start();?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GOSH Project</title>


  <link rel='stylesheet' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

  <link rel="stylesheet" href="css/style.css">


</head>

<body>
  <div class="wrapper">
    <form action="login.php" method="POST" class="form-signin">

      <h2 class="form-signin-heading">Heartstone Login</h2>
      <input class="form-control" type="text" name="username" placeholder="Email" required="" autofocus="">






      <input class="form-control" type="password" name="password" placeholder="Password" required="">
<?php
echo $_GET['msg'];
?>
      <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">


    </form>
  </div>







</body>

</html>