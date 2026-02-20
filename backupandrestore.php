<?php
include 'head.php';
   
?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card_body">
            
                <hr>
                <div class="col-md-12 mb-4 ">
                    <center>
                        <button class="btn btn-primary btn-sm col-sm-3" type="button" id="backu"><i class="fa fa-database"></i> Backup</button><!--  -->
                    </center>
                </div>
                 <hr>
                 <br>
                 <hr>
                <div class="col-md-12 mb-4">
                    <center>
                      
                        <button class="btn btn-success btn-sm col-sm-3" type="button" id="restore"><i class="fa fa-trash-restore"></i> Restore </button><!-- fa-trash-restore -->
                    </center>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<
<script>


$('#backu').click(function(){   
   
    swal({
      title: "Are You Sure of making backup, Cancel and Reload?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })

    .then((willedite) => {
      if (willedite) {

        $.ajax({
            url: "backupage.php",                
            method: 'POST',
            type: 'POST',           
            success:function(data){
             if(data==1){
                swal({
                     title: "BACKUP",
                     text: "Database successfull backup",
                     icon: "success",
                     buttons: "Ok",


                }); 
                    alert_toast("Data successfully backup.",'success')
                        setTimeout(function(){
                            location.reload()
                        },5000)
                }
               
            }


        });
    
    }
    });
    });

$('#restore').click(function(){  
    swal({
      title: "Are You Sure Of Making Restore, If Yes Wait for 2 Minute?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willedite) => {
      if (willedite) {

 /* if(resto){*/
    $.ajax({
      url: 'restoredb.php',
      type: 'post',
      method: 'POST',     
      success: function (Response){
       if(Response){
                swal({
                     title: "RESTORE",
                     text: (Response),
                     icon: "success",
                     buttons: "Ok",


                }); 
                    alert_toast("Data successfully Restore.",'success')
                        setTimeout(function(){
                            location.reload()
                        },10000)
                }
      }
    });
 /* }*/
}
});
});





/*
$('#end_date').change(function(){

   location.replace('saleusermonth.php?page=payments_report&start_date = '+$(this).val())
})
$('#print').click(function(){
		var _c = $('#report-list').clone();
		var ns = $('noscript').clone();
            ns.append(_c)
		var nw = window.open('','_blank','width=900,height=600')
		nw.document.write('<p class="text-center"><b>Total Sale as at <?php echo date("F, Y",strtotime($month)) ?></b></p>')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})*/
</script>