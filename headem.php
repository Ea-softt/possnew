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


    </style>






    
</head>
 <body>
 
 <!--div class="container"-->
 <nav class=" align-items-stretch  border-dark  bd-header d-flex  navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fifth navbar example" style="font-size: 15px; padding: 10px;">



    <div class="container-fluid">
      <a class="navbar-brand text-success " style="font-size: 25px;" href="#">EA-Soft</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarsExample05">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           <li class="nav-item " style="width: 500px;">
            <a class="nav-link active" aria-current="page" href="homepageem.php">Home</a>
          </li>      
         
         

          
           
           


         

          

             


          
       
        </ul>
        
        
          <div class="d-flex flex-row-reverse flex-shrink-5 dropdown " style="margin-left:200px;">
        <a href="#" class="d-block link-secondary text-decoration-none text-success dropdown-toggle" id="dropdownUser2" data-toggle="dropdown" aria-expanded="false" style="margin-left: 80px; "><?php echo $FullName;?>
          <img src="<?php echo isset($meta['picture']) ? '../img/'.$meta['picture'] :'' ?>" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow " aria-labelledby="dropdownUser2">
              
           <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="backupandrestore2.php">Backup And Restore</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
        </ul>
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