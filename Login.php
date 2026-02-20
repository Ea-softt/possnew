<?php 
include('server/database.php');
include('validation.php');
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <link  rel="shortcut icon" type="image/icon" href="img/Ea-Soft.ico">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <script src="bootstrap4/jquery/jquery.min.js"></script>
      <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
     <script src="bootstrap4/jquery/sweetalert.min.js"></script>
     <script type="text/javascript" src="bootstrap4/js/script.js"></script>
           <!-- <script src="bootstrap4/js/time.js"></script> -->
      <script src="bootstrap4/jquery/accounting.min.js"></script>    
        <script src="bootstrap4/js/typeahead.js"></script>
         <script src="bootstrap4/js/jquery.datetimepicker.full.min.js"></script>
          <script src="bootstrap4/jquery/datepicker.js"></script>



    <link rel="stylesheet" type="text/css" href="bootstrap4/css/style.css">
    <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="bootstrap4/css/dashboard.css" rel="stylesheet">          
    <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="bootstrap4/css/main.css" rel="stylesheet"> 
    <link href="bootstrap4/css/all.min.css" rel="stylesheet"> 
    


   

  </head>
  <body class="text-center" style="background: linear-gradient(rgba(0,0,50,0.5),rgba(0,0,50,0.5)),  
  url(img/Login-icon.png);
  background-size: cover;
  background-position: center">
   <main class="form-signin">






  <div class=" container  d-flex justify-content-end align-items-center" style="max-width: 300px;
  float: none;
  margin: 50px auto;">  
 
  <form class="border shadow p-3 rounded" action="validation.php" method="post" style="width: 300px; background: #fff;  ">
    <img class="mb-4" src="img/login.png" alt="" width="72" height="57">
   <div>
   <?php

    if (isset($_SESSION['meg'])){
        echo "<div id='meg'></div>";
        unset($_SESSION['meg']);

    }
   ?>
    </div>

    <h1 class="h3 mb-3 fw-normal" >Please sign in</h1>    


   <div class="mb-3">
   <!--  <label  class="visually-hidden">Username</label> -->
    <input type="text" id="username" name="username" class="form-control" placeholder="Username"  >
   </div>
   <div class="mb-3">
   <!--  <label  class="visually-hidden">Your ID </label> -->
    <input type="text" id="uid" name="uid" class="form-control" placeholder="ID"  >
   </div>

   <div class="mb-3">
   <!--  <label  class="visually-hidden">Password</label> -->
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" >
  </div>

   
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
   
    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    
    <br/>
    <p class="mt-5 mb-3 text-muted">&copy; 2021-2030</p>
  </form>
  </div>
</main>


    
  </body>

<script type="text/javascript">
    
  
 

$('#meg').html('<div class="alert alert-danger">Check Password, ID and Username .</div>')
     
   </script>




  
</html>
