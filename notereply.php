<?php
include("server/config.php");


if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM note where id= ".$_GET['id']);
foreach($qry->fetch(PDO::FETCH_ASSOC) as $k => $val){
    $$k=$val;
}
}



?>

<main class="container">
  
  <form action="" id="save_commen">  
  
     
  <div class="form-group">  
  <input class="form-control "style="font-size:15px; "    type="hidden" id="id" name="id"   value="<?php echo isset($id)? $id :''?>" >  
  </div>     

  <div class="form-group">  
   <label>Title:</label>
    <div class="input-group"><input type="text" id="title" name="title" class="form-control-sm form-control" style = "text-transform:uppercase;"   value="<?php echo isset($title) ? $title : '' ?>"></div>
  </div>  
      

<div class="form-group">  
   <label>Note:</label>
   <textarea name="notee" id="notee" class="form-control-sm form-control" cols="100" rows="12"  placeholder=""><?php echo isset($notee)? $notee :''?></textarea></div></td>
  </div>  

   
  </form>  
</main>


<script type="text/javascript">
$('.select2').select2({
    placeholder:'Please select here',
    width:'100%'
  })

 




  $('#save_commen').submit(function(e){
    e.preventDefault()
    start_load()
    $.ajax({
      url:'easoftfun.php?action=new_note',
      data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
      error:err=>{
        console.log(err)       
      },
      success:function(resp){
        if(resp == 1){
          alert_toast('Data successfully saved.','success')
          setTimeout(function(){
            location.reload()
          },1000)
        }
      }
    })

  })




</script>