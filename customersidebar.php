

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

    
    <!-- Custom styles for this template -->
   
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
 
</header>

<div class="container-fluid" >
  <div class="row">
    <nav id="sidebarMenu"  class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" >
      <div class="position-sticky pt-3 text-white" style="background:skyblue;" >
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active  " aria-current="page" href="#">
              <span data-feather="home"></span><i class="fas fa-tachometer-alt">
              Dashboard</i>
            </a>
          </li>         
          <li class="nav-item">
            <a class="nav-link text-white" href="customerlist.php">
              <span data-feather="file"></span><i class="fas fa-user-plus">
              Customer</i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="SupplierDeliverlist.php">
              <span data-feather="file"></span><i class="fas fa-building">
              Customer List</i>
            </a>
          </li>
         <br>
          <br>   
          <br> 
          <br> 
          <br> 
          <br> 
          <br> 
          <br> 
          <br>   
         
         
         
        </ul>

       <!--  <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-4 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6> -->
        <ul class="nav flex-column mb-4">
          <br> 
          <br> 
          <br> 
          <br> 
          <br> 
          <br> 
          <br> 
         
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              <p ><i class="fas fa-calendar-alt"></i> &nbsp<?php
            date_default_timezone_set("Africa/Accra");
            $date = date("Y-m-d");
              echo $date;
              ?> </p>
            </a>
          </li>  
          <br>
          <br>   
             
        </ul>
      </div>
    </nav>