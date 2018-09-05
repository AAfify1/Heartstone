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
    <form action="register.php" method="POST" class="form-signin">

      <h2 class="form-signin-heading">Register a new staff member</h2>
      <input class="form-control" type="text" name="email" placeholder="Email Address" required="" autofocus="">
      <br>
      <input class="form-control" type="text" name="firstname" placeholder="First Name" required="" >
      <br>
      <input class="form-control" type="text" name="lastname" placeholder="Last Name" required="" >
      <br>
      <input class="form-control" type="password" name="pass1" placeholder="Password" required="" >

      <input class="form-control" type="password" name="pass2" placeholder="Confirm Password" required="">

      <label class="checkbox">
            <input type="checkbox" value="Yes" id="isadmin" name="isadmin"> Admin
          </label>
          <?php
          echo $_GET['msg'];
          ?>
      <input type="submit" value="Register" class="btn btn-lg btn-primary btn-block">


    </form>
  </div>


</body>

</html>
