<?php session_start(); 
  //var_dump($_SESSION);
   if(!isset($_SESSION['username'])){
	  
	   header("Location:index.php");
    }
  

?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>


  <link rel='stylesheet' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

  <link rel="stylesheet" href="css/style.css">


  <style>
    .chart-container {
      width: 80%;
      height: 80%;
    }
  </style>


<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <a class="navbar-brand" href="#">DashBoard</a>
    </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right nav justify-content-end">
       
        <?php
    if($_SESSION['admin'] == '1') {
?>
      <li class="nav-item">
        <a class="nav-link" href="/registration.php">Register New User</a>
      </li>
      <?php
}
?>
<li class="nav-item ">
  
        <a class="nav-link" href="/logout.php">Logout </a>
      </li>
      <li class="nav-item ">
      
 

</li> 
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</head>
<body>

 
 
    
  <h2>
    <?php

if(isset($_SESSION["username"])){

   print "Welcome ". $_SESSION["username"];
   print"<br/>";
  


}  

?>
  </h2>
  <div class="row">
    <div class="col-md-6">
      <div class="chart-container">
        <canvas id="temphum"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="chart-container">
        <canvas id="motion"></canvas>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="chart-container">
        <canvas id="noise"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="chart-container">
        <canvas id="light"></canvas>
      </div>
    </div>
  </div>



  <!-- javascript -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/Chart.min.js"></script>
  <script type="text/javascript" src="js/temphum.js"></script>
  <script type="text/javascript" src="js/motion.js"></script>
  <script type="text/javascript" src="js/noise.js"></script>
  <script type="text/javascript" src="js/light.js"></script>
</body>

</html>