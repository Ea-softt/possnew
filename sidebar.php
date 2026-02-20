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
      <div class="position-sticky pt-3 bg-secondary text-white" >
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active  " aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>         
          <li class="nav-item">
            <a class="nav-link text-white" href="supplierslist.php">
              <span data-feather="file"></span>
              Supplier
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="SupplierDeliverlist.php">
              <span data-feather="file"></span>
              Supplier Deliver
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="product.php">
              <span data-feather="shopping-cart"></span>
            Market
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="Suppliers.php">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
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
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>