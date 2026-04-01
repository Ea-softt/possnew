<?php
session_start();
include('server/config.php');
include_once('server/License.php');

// Check License Status
$license = new License($conn);
if (!$license->checkLicense()) {
    header('location:activate.php');
    exit();
}

if(isset($_SESSION["uid"])){



$fees = $conn->query("SELECT * FROM newemployee WHERE EmpID = '{$_SESSION['uid']}' ");
foreach($fees->fetch(PDO::FETCH_ASSOC) as $k => $v){
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
     <script src="bootstrap4/jquery/jquery.min.js"></script>
      <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
     <script src="bootstrap4/jquery/sweetalert.min.js"></script>
     <script type="text/javascript" src="bootstrap4/js/script.js"></script>
           <!-- <script src="bootstrap4/js/time.js"></script> -->
      <script src="bootstrap4/jquery/accounting.min.js"></script>    
        <script src="bootstrap4/js/typeahead.js"></script>
         <script src="bootstrap4/js/jquery.datetimepicker.full.min.js"></script>
         <script type="text/javascript" src="bootstrap4/js/select2.min.js"></script>
          <script src="bootstrap4/js/ddtf.js"></script>
           <script type="text/javascript" src="bootstrap4/datatable/datatables.min.js"></script>



    <link rel="stylesheet" type="text/css" href="bootstrap4/css/style.css">
    <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="bootstrap4/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap4/css/dashboard.css" rel="stylesheet">          
     <link href="bootstrap4/css/select2.min.css" rel="stylesheet">
    <link href="bootstrap4/css/main.css" rel="stylesheet"> 
    <link href="bootstrap4/css/all.min.css" rel="stylesheet"> 
     <link href="bootstrap4/datatable/datatables.min.css" rel="stylesheet">






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

    :root {
        --nav-bg: #1a1d20;
        --accent-green: #28a745;
    }

    /* Modern Navbar Styling */
    .navbar-custom {
        background-color: var(--nav-bg) !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        padding: 0.6rem 1.5rem;
    }

    .navbar-brand {
        font-weight: 700;
        letter-spacing: 1px;
        transition: 0.3s;
    }

    .navbar-brand:hover {
        color: #fff !important;
        text-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
    }

    /* User Profile Section */
    .user-profile-link {
        display: flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 50px;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.05);
        color: #e9ecef !important;
        text-decoration: none !important;
    }

    .user-profile-link:hover {
        background: rgba(40, 167, 69, 0.2);
    }

    .profile-img {
        border: 2px solid var(--accent-green);
        padding: 2px;
        object-fit: cover;
    }

    /* Dropdown Refinement */
    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        border-radius: 8px;
        margin-top: 15px !important;
    }

    .dropdown-item {
        padding: 10px 20px;
        font-size: 14px;
        transition: 0.2s;
    }

    .dropdown-item:hover {
        background-color: var(--accent-green);
        color: white;
    }

    /* Preloader Overlay */
    #preloader2 {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
    
</head>
 <body>

<nav class="navbar navbar-expand-md navbar-dark navbar-custom sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand text-success" href="homepageem.php">
            <i class="fas fa-graduation-cap me-2"></i> EA-Soft
        </a>

        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
<!-- 
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link px-3" href="homepageem.php"><i class="fas fa-home me-1"></i> Dashboard</a>
                </li>
            </ul> -->

            <div class="navbar-nav ml-auto align-items-center">
                <div class="dropdown">
                    <a href="#" class="user-profile-link dropdown-toggle" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline"><?php echo $FullName ?? 'User'; ?></span>
                        <img src="<?php echo !empty($meta['picture']) ? '../img/'.$meta['picture'] : 'img/default-avatar.png'; ?>" 
                             alt="Profile" width="35" height="35" class="rounded-circle profile-img">
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="userMenu">
                        <h6 class="dropdown-header">Account Management</h6>
                        <!-- <a class="dropdown-item" href="profile.php">
                            <i class="fas fa-user-cog mr-2"></i> My Profile
                        </a> -->
                        <a class="dropdown-item" href="backupandrestore2.php">
                            <i class="fas fa-database mr-2"></i> Database Backup
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="logoutpage.php">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>




<div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">      
  <div class=" text-success"><b>Welcome to EA-Soft School System</b></div>
  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
          </div>
  <div class="toast-body">    
  </div>
</div>





<!-- 

<div class="toast"  role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white"  >
    </div>
  </div>
 -->
  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<div class="modal fade" id="confirm_modal" role='dialog'>
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
  <div class="modal fade" id="uni_modal" role='dialog'>

    <div class="modal-dialog modal-lg" role="document">      
      <div class="modal-content">
        <div class="modal-header bg-success">           
        <h5 class="modal-title text-white"></h5>
        <button type="button" class="btn-close btn-danger"  data-dismiss="modal" aria-label="Close"><span class="fa fa-times"></span></button>  
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
  </div>


</body>

<script>
window.start_load = function(){
    $('body').prepend('<di id="preloader2"></di>')
   

  }
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
  }
 window.viewer_modal = function($src = ''){
    start_load()
    var t = $src.split('.')
    t = t[1]
    if(t =='mp4'){
      var view = $("<video src='"+$src+"' controls autoplay></video>")
    }else{
      var view = $("<img src='"+$src+"' />")
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view)
    $('#viewer_modal').modal({
            show:true,
            backdrop:'static',
            keyboard:false,
            focus:true
          })
          end_load()  

}


  
  window.uni_modal = function($title = '', $url='',  $size=""){
    start_load()
    $.ajax({
        url:$url,
        error:err=>{
            console.log()
            alert("An error occured")
        },
        success:function(resp){
            if(resp){
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                if($size != ''){
                    $('#uni_modal .modal-dialog').addClass($size)
                }else{
                    $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-lg")
                
                }
                $('#uni_modal').modal({
                  show:true,
                  backdrop:'static',
                  keyboard:false,
                  focus:true
                })
                end_load()
            }
        }
    })
}

window._conf = function($msg='',$func='',$params = []){
     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
     $('#confirm_modal .modal-body').html($msg)
     $('#confirm_modal').modal('show')
  }
   window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

    if($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({delay:3000}).toast('show');
  }
  $(document).ready(function(){
    $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
  })
  $('.datetimepicker').datetimepicker({
      format:'Y/m/d H:i',
      startDate: '+3d'
  })
  $('.select2').select2({
    placeholder:"Please select here",
    width: "100%"
  })


 $('#alert_toast').toast({delay:1000}).toast('show');


</script> 



























 
  <script src="../js/cheatsheet.js"></script>









</html>