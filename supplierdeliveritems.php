<?php
include("head.php");

  $qry = $conn->query("SELECT sc.*,su.*,sd.* FROM suppliercompany sc inner join supplier su on sc.companynameid = su.supplier_id inner join supplierdeliver sd on sc.id = sd.supplierid where id = {$_GET['id']}");
foreach($qry->fetch_array() as $k => $val){
    $$k=$val;
}


?>


<body>
<!-- Table Panel -->
      <div class="col-md-12">
        <div class="card">          
          <div class="card-header bg-success text-white">
          <b><?php echo $companyname ?> items delivered on the <?php echo $created_date ?></b>            
            <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="SupplierDeliverlist.php" id="new_supplier">
          <i class="fa fa-back"></i> Back 
        </a></span>
          </div>
            <table id="mytable" class="table table-condensed table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Name</th>
                        <th class="text-center">quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">TCost</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $price2 = 0;
                    $multtota2 = 0;

                    $i = 1;
                        if(isset($id)):
                    $fees = $conn->query("SELECT sc.*,sd.* FROM suppliercompany sc inner join supplierdeliver sd on sc.id = sd.supplierid where  id= $id");
                        
                    while($row=$fees->fetch_assoc()): 
                          $price2 += $row['price'];
                          $multtota2 += $row['multtota'];
                    ?>
                        <tr>   
                          <td class="text-center"><?php echo $i++ ?></td>                         
                            <td class="text-center">
                                <?php echo $row['name'] ?>
                               
                            </td>
                             <td class="text-center">
                                <?php echo $row['quantity'] ?>                               
                            </td>

                            <td class="text-center">                         
                               <?php echo $row['price'] ?>                   
                            </td> 

                            <td class="text-center">                                
                              <?php echo $row['multtota'] ?>                  
                            </td>

                             <td class="text-center">                        
                               <?php echo $row['unit'] ?>                     
                            </td> 
                              
                             <td class="text-center">                         
                                <?php echo $row['description'] ?>
                            </td> 
                           
                            <td class="text-center">
                            <button class="btn btn-sm btn-outline-danger delete_erdeliver" type="button" data-id="<?php echo $row['sid'] ?>" >Delete</button>
                             </td>

                        </tr>
                    <?php
                        endwhile; 
                        endif; 
                    ?>





                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" class="text-right">Total Price</th>
                        <th  class="text-center text-success">
                           
                          <?php echo isset($price2) ? number_format($price2,2) : '0.00' ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-right">Total Cost</th>
                        <th class="text-center text-success">                         
                            
                            <?php echo isset($multtota2) ? number_format($multtota2,2) : '0.00' ?>
                        </th>
                    </tr> 
                </tfoot>
            </table>

        </form>        
      </div>











<style>
	img#cimg{
		max-height: 100vh;
		max-width: 10vw;		
		position: relative;
	}
	img {
		padding-right: 30px;
	}
</style>

 <script>
  $(document).ready(function(){
    $('.table').dataTable()
  
$('#mytable').ddTableFilter();
  })
  


  
$('.view_sales').click(function(){
    uni_modal("Report Details","view_salerecode.php?reciept_no="+$(this).attr('data-examin_ID')+"&reciept_no="+$(this).attr('data-id'),"mid-large")
    


   
  })

  
  
$('.delete_erdeliver').click(function(){
    _conf("Are you sure to delete this item?","delete_erdeliver",[$(this).attr('data-id')])
  })
  
  function delete_erdeliver($id){
    start_load()
    $.ajax({
      url:'easoftfun.php?action=delete_erdeliver',
      method:'POST',
      data:{sid:$id},
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

  


</script>
 





</body>
</html>