<?php
session_start();
include('server/config.php');
if(isset($_SESSION["uid"])){



$fees = $conn->query("SELECT * FROM newemployee WHERE EmpID = '{$_SESSION['uid']}' ");
foreach($fees->fetch_array() as $k => $v){
  $$k= $v;
  $meta[$k] = $v;
 }
}else{
  header('location:Login.php?error=wrong username,password and role');
}
?>



<!DOCTYPE html>
<html>
<head>
     <title>EA-Soft System</title>
     <link  rel="shortcut icon" type="image/icon" href="img/Ea-Soft.ico">
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">    
       <script src="bootstrap5/bootstrap.bundle.min.js"></script>
     <script src="bootstrap5/jquery-3.6.0.min.js"></script> 
     <script src="bootstrap5/sweetalert.min.js"></script>  
   <script src="bootstrap5/select2.min.js"></script>  
   <script src="bootstrap5/jquery.dataTables.js"></script>  

<script type="text/javascript" src="bootstrap4/js/ddtf.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

 <!-- 
     <script src="bootstrap4/jquery/jquery.min.js"></script>
   <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
     <script src="bootstrap4/jquery/sweetalert.min.js"></script>
     <script src="bootstrap4/jquery/datepicker.js"></script>
     <script type="text/javascript" src="bootstrap4/js/script.js"></script>
       <script src="bootstrap4/js/time.js"></script> 
      <script src="bootstrap4/jquery/accounting.min.js"></script>    
        <script src="bootstrap4/js/typeahead.js"></script>
         <script src="bootstrap4/js/jquery.datetimepicker.full.min.js"></script>
         <script type="text/javascript" src="bootstrap4/js/select2.min.js"></script>
          <script src="bootstrap4/js/ddtf.js"></script>
           <script type="text/javascript" src="bootstrap4/datatable/datatables.min.js"></script>
     <script type="text/javascript" src="bootstrap4/jquery-ui/jquery-ui.js"></script>


   
     <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="bootstrap4/css/bootstrap.css" rel="stylesheet"> 
    <link href="bootstrap4/css/dashboard.css" rel="stylesheet">          
     <link href="bootstrap4/css/select2.min.css" rel="stylesheet">
    <link href="bootstrap4/css/main.css" rel="stylesheet"> 
    <link href="bootstrap4/css/all.min.css" rel="stylesheet">  
       <link href="bootstrap4/css/datepicker.css" rel="stylesheet">

        <link href="bootstrap4/jquery-ui/jquery-ui.css" rel="stylesheet"> 

     <link href="bootstrap4/datatable/datatables.min.css" rel="stylesheet">   -->
     <link rel="stylesheet" type="text/css" href="bootstrap5/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="bootstrap5/select2.min.css">
      <link rel="stylesheet" type="text/css" href="bootstrap4/css/style.css">
 <link rel="stylesheet" type="text/css" href="bootstrap5/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap5/font_awesome_all.min.css">


 <style>
  input[type=checkbox]

  
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

.modal-dialog.large-large {
    width: 90% !important;
    margin-bottom: 100%;
    max-width: unset;
   /* //max-height: unset;*/
  }
      .modal-dialog.large {
    width: 80% !important;
    max-width: unset;
  }
  .modal-dialog.mid-large {
    width: 50% !important;
    max-width: unset;
  }
  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    /*right: -4.5em;*/
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
}
#viewer_modal .modal-dialog {
        width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
}
  #viewer_modal .modal-content {
       background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #viewer_modal img,#viewer_modal video{
    max-height: calc(100%);
    max-width: calc(100%);
  }

  #mytable th {
  background-color: #000000;
  color: white;
  font-weight: bold;
}


<style>
    /* General Styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }
    .container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }
    /* Header Styling */
    .form-header {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
        padding: 15px;
        border-radius: 5px 5px 0 0;
        font-weight: bold;
        margin: -20px -20px 20px -20px;
    }
    /* Form Group Styling */
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        font-weight: 600;
        color: #495057;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
    }
    /* Border Right for Columns */
    .border-right {
        border-right: 1px solid #dee2e6;
    }
    /* Button Styling */
    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
    }
    .btn-danger {
        background: linear-gradient(135deg, #dc3545, #bb2d3b);
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
    }
    /* Image Preview */
    #cimg {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 5px;
        max-height: 200px;
        max-width: 200px;
    }
    /* Modal Footer */
    .modal-footer {
        border-top: none;
        padding-top: 20px;
    }
    /* Responsive */
    @media (max-width: 768px) {
        .border-right {
            border-right: none;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
    }

    .loading-indicator {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.loading-indicator:after {
    content: "";
    width: 50px;
    height: 50px;
    border: 5px solid #ddd;
    border-top: 5px solid #007bff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>


    </style>






    
</head>
 <body>
 
 <!--div class="container"-->
 
 

 


<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999; color: white;">
  <div id="alert_toast" class="toast" role="alert" data-autohide="true">
    <div class="toast-body"></div>
  </div>
</div>


  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-ms" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
        <h5 class="modal-title">Confirmation</h5>
      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
 -->

<!-- Confirmation Modal -->
<div class="modal fade" id="confirm_modal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-ms">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirm">Continue</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Universal Modal -->
<div class="modal fade" id="uni_modal" tabindex="-1" aria-labelledby="uniModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="uniModalLabel"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <!-- <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit"><i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i>&nbsp;&nbsp;Cancel</button>
      </div> -->
    </div>
  </div>
</div>

<!-- Viewer Modal -->
<div class="modal fade" id="viewer_modal" tabindex="-1" aria-labelledby="viewerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</div>



  <!-- <div class="modal fade" id="uni_modal" role='dialog'>

    <div class="modal-dialog modal-lg" role="document">      
      <div class="modal-content">
        <div class="modal-header bg-success">           
        <h5 class="modal-title text-white"></h5>
        <button type="button" class="btn-danger btnn"  data-dismiss="modal" aria-label="Close"><span class="fa fa-times"></span></button> <i class=""> 
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer btnn">
        <button type="button" class="btn btnn btn-primary" id='submit' onclick="$('#uni_modal form').submit()"><i class="fas fa-thumbs-up">&nbsp&nbsp</i>Save</button>
        <button type="button" class="btn btnn btn-danger" data-dismiss="modal"><i class="fas fa-ban">&nbsp&nbsp</i>Cancel</button>
      </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
        </div>
      </div>
    </div>
  </div> -->
</body>



<script>


   // Preloader functions
/*  window.start_load = function() {
      $('body').prepend('<div id="preloader2"></div>');
  };

  window.end_load = function() {
      $('#preloader2').fadeOut('fast', function() {
          $(this).remove();
      });
  };
*/
  function start_load() {
    $('body').prepend('<div class="loading-indicator"></div>');
}
function end_load() {
    $('.loading-indicator').fadeOut('fast', function() {
        $(this).remove();
    });
}


  // Modal functions using Bootstrap 5 API
  window.uni_modal = function($title = '', $url = '', $size = "") {
      start_load();
      $.ajax({
          url: $url,
          error: function(err) {
              console.log(err);
              alert("An error occurred");
              end_load();
          },
          success: function(resp) {
              if (resp) {
                  $('#uni_modal .modal-title').html($title);
                  $('#uni_modal .modal-body').html(resp);
                  if ($size != '') {
                      $('#uni_modal .modal-dialog').addClass($size);
                  } else {
                      $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-lg");
                  }

                  const uniModal = new bootstrap.Modal(document.getElementById('uni_modal'));
                  uniModal.show();
                  end_load();
              }
          }
      });
  };

  window._conf = function($msg = '', $func = '', $params = []) {
      $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
      $('#confirm_modal .modal-body').html($msg);

      const confirmModal = new bootstrap.Modal(document.getElementById('confirm_modal'));
      confirmModal.show();
  };

  window.viewer_modal = function($src = '') {
      start_load();
      var t = $src.split('.');
      t = t[1];
      var view;
      if (t == 'mp4') {
          view = $("<video src='" + $src + "' controls autoplay></video>");
      } else {
          view = $("<img src='" + $src + "' />");
      }
      $('#viewer_modal .modal-content video, #viewer_modal .modal-content img').remove();
      $('#viewer_modal .modal-content').append(view);

      const viewerModal = new bootstrap.Modal(document.getElementById('viewer_modal'));
      viewerModal.show();
      end_load();
  };

   // In a shared JS file (e.g., global.js)
window.alert_toast = function($msg = 'TEST', $bg = 'success') {
    $('#alert_toast').removeClass('bg-success bg-danger bg-info bg-warning');
    if ($bg == 'success') $('#alert_toast').addClass('bg-success');
    if ($bg == 'danger') $('#alert_toast').addClass('bg-danger');
    if ($bg == 'info') $('#alert_toast').addClass('bg-info');
    if ($bg == 'warning') $('#alert_toast').addClass('bg-warning');
    $('#alert_toast .toast-body').html($msg);
    $('#alert_toast').toast({delay: 3000}).toast('show');
};




  $(document).ready(function() {
      $('#preloader').fadeOut('fast', function() {
          $(this).remove();
      });

      // Initialize Select2
      $('.select2').select2({
          placeholder: "Please select here",
          width: "100%"
      });
  });
</script> 

























<!-- 

 
  <script src="../js/cheatsheet.js"></script> -->









</html>