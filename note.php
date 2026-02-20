<?php
include("head.php");


$fees = $conn->query("SELECT * FROM newemployee WHERE EmpID = '{$_SESSION['uid']}' ");
foreach($fees->fetch_array() as $k => $v){
  $$k= $v;
  $meta[$k] = $v;
}
?>


<div id="msg" class="form-group"></div>
<form action="" id="new_note">
         <div class="row "> 
      
                <div class="col-lg-4 border-right ">
                <table class="table-responsive mt-5">
                        <tbody>                               
                        </div>
                                <label><b>Title:</b></label>
                                <div class="input-group"><input type="text" id="title" name="title" class="form-control-sm form-control" style = "text-transform:uppercase;"  ></div>

                                </tr>
                                <br>
                            <tr>
                                <label><b>Note:</b></label>
                                <textarea name="notee" id="notee" class="form-control-sm form-control" rows="8" data-minwords="15" data-required="true" placeholder="Take a Note ......"></textarea></div></td>
                            </tr>
                            <tr>
                               
                                <td><div class="input-group"> <button  type="submit" class="btn btn-sm btn-outline-primary" name="submit" id="submit" >Add an event</button></div></td>
                            </tr>                           
                            
                        </tbody>
                    </table>

</div>

<div class="col-lg-7 ">

      
      <div class="card mb-56 shadow-sm">
     
      <div class="card-body">
        <!-- <h1 class="card-title pricing-card-title"> <small class="text-muted">/ mo</small></h1> -->
        

      <table id="mytable" class="table table-condensed table-bordered table-hover">
              
              <tbody width = "100%">
                <?php 
                $i = 1;
                $fees = $conn->query("SELECT * FROM note ORDER BY created_date DESC ");

                while($row=$fees->fetch_assoc()):                 
                ?>
                <tr class="text-center">
                 
                    <p class="text-danger"><b>Date:</b><?php echo $row['created_date']?></p> </div>            
                    <p class="text-success" style = "text-transform:uppercase;"><b>Title:</b>  <?php echo $row['title']?></p>
                    <p><b>Note: </b><textarea cols="100" rows="4"><?php echo $row['notee']?></textarea></p>
                    <div class="row" style="margin-left:20px;" >
                    <button  class="btn btn-sm btn-outline-primary reply_notereply" type="button" data-id="<?php echo $row['id'] ?>">Reply</button>
                     <div class="col">
                     <button class="btn btn-sm btn-outline-danger delete_note" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                    </div>
                    </div>
                  <hr class="bg-black">              
                   <br>

                 
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          
    </div>
    </div>
     </div> 





</div>

</div>

<script>
    $('.reply_notereply').click(function(){
    uni_modal("Update Note","notereply.php?id="+$(this).attr('data-id'),'small')
    
  })


  
  $('.delete_note').click(function(){
    _conf("Are you sure to delete this Note?","delete_note",[$(this).attr('data-id')])
  })

function delete_note($id){
    start_load()
    $.ajax({
      url:'easoftfun.php?action=delete_note',
      method:'POST',
      data:{id:$id},
      success:function(resp){
        if(resp==1){
          alert_toast("Data successfully deleted",'success')
          setTimeout(function(){
            location.reload()
          },1500)

        }
      }
    })
  }


 $('#new_note').submit(function(e){
        e.preventDefault()
         start_load()

        $('#msg').html('')

        var title = $('#title').val();
         var notee = $('#notee').val();
           
         if(title == ''){
              swal("Warning","Please provide Title","warning");    
            return false;
        }

         if(notee == ''){
              swal("Warning","Please provide Note","warning");    
            return false;
        }


        $.ajax({
            url:'easoftfun.php?action=new_note',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){  
            alert(resp);        
                if(resp==1){
                    alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            location.reload()
                        },1000)
                }else if(resp == 2){
                $('#msg').html('<div class="alert alert-danger mx-2">Already exist, So Check the Name And The Phone Number.</div>')
                end_load()
                }   
            }
        })
    })






</script>


