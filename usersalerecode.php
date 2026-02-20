<?php
include("head.php");

 $month = isset($_GET['month']) ? $_GET['month'] : date('Ymd');

$fees = $conn->query("SELECT sp.*,us.*,ct.* FROM sales sp inner join newemployee us on sp.username = us.EmpID inner join customer ct on sp.customer_id = ct.customer_id where date_format(sp.created_date,'%Y%m%d') = {$_GET['month']} and sp.username = {$_GET['username']} order by unix_timestamp(sp.created_date) asc ");
foreach($fees->fetch_array() as $k => $v){
	$$k= $v;
}

// date_format(sp.created_date,'%Y-%m-%d') = {$_GET['month']} and
?>


<body>
<!-- Table Panel -->
      <div class="col-md-12">
        <div class="card">          
          <div class="card-header bg-success text-white">
          <b>User customer view</b>            
           <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="saleusertwo.php" id="new_supplier">
          <i class="fa fa-plus"></i> back 
        </a></span>

          </div>          
          
            <table id="mytable" class="table table-condensed table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Customer Name</th>
                  <th class="text-center">Discount</th>
                  <th class="text-center">Total</th>                  
                  <th class="text-center">GrandTotal</th>
                  <th class="text-center">Date</th>                  
                  <th class="text-center">Print</th>

                  
                </tr>
              </thead>   
              <tbody> 
                
                 <?php
                 $i = 1;
                    $day1 = "";
                    $month1 = "";
                    $year1 = "";
                /*  $day1 = $_SESSION['days'];
                  $month1 = $_SESSION['month'];
                   $year1 =  $_SESSION['years']; 

                   date_format(sp.created_date,'%Y-%m-%d') = {$_GET['month']} and*/


                $payments = $conn->query("SELECT sp.*,ct.* FROM sales sp inner join customer ct on sp.customer_id = ct.customer_id  WHERE  date_format(sp.created_date,'%Y%m%d') = {$_GET['month']} and sp.username = {$_GET['username']} order by unix_timestamp(sp.created_date) asc"); 
                     
                   
                   if ($payments->num_rows > 0){
                    while($row = $payments->fetch_assoc()){
                      $customer_first = $row['firstnamec'];
                      $customer_last = $row['lastnamec'];

                       $day = $row['days'];
                       $month = $row['month'];
                       $years = $row['years']; 
                       $discount = $row['discount']; 
                       $total = $row['total'];
                       $grandtotal = $row['grandtotal'];
                      $reciept_no = $row['reciept_no'];
                       $datee = $row['created_date'];
                    ?>
                    <tr>
                  <td class="text-center"><?php echo $i++ ?></td>
                  <td class="text-center">
                   <?php echo $customer_first. " ".$customer_last;?>
                  </td>
                  <td class="text-center">
                     <?php echo $discount;?>
                  </td>
                   <td class="text-center">
                     <?php echo $total;?>
                  </td>
                  <td class="text-center">
                     <?php echo $grandtotal;?>
                  </td>
                  <td class="text-center">
                     <?php echo date("Y-m-d",strtotime($datee)) ?>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary view_sales" type="button" data-id="<?php echo   $reciept_no; ?>"
                      data-examID="<?php echo  $reciept_no; ?>">View</button>

                  </td>
                 
                 
               </
               vtr>                           
            
                    <?php
                    }
                  }

                  else{
                      ?>
                        
                      <?php
                  }  

                
                              
                        
                ?>

              </tbody>
                
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
    $('.table').dataTable();
  
$('#mytable').ddTableFilter();
  })
  


  
$('.view_sales').click(function(){
    uni_modal("Report Details","view_salerecode.php?reciept_no="+$(this).attr('data-examin_ID')+"&reciept_no="+$(this).attr('data-id'),"mid-large")
    


   
  })

  
  

  
  
  
  function supplier_company($id){
    start_load()
    $.ajax({
      url:'easoftfun.php?action=supplier_company',
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

  


</script>
 





</body>
</html>