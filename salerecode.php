<?php
include("head.php");
?>


<style>
  input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.3); /* IE */
  -moz-transform: scale(1.3); /* FF */
  -webkit-transform: scale(1.3); /* Safari and Chrome */
  -o-transform: scale(1.3); /* Opera */
  transform: scale(1.3);
  padding: 10px;
  cursor:pointer;
}
</style>



<div class="container-fluid">   
   
      <!-- FORM Panel -->

  <form action="salerecode.php" method="post"> 
  <div class="row "> 
      <div class="col-md-2 border-right ">
        <div class="form-group">
                 <label for="" class="control-label">From Date</label>
                
               <input type="date" name="from_date" class="form-control">
            </div>  


          <hr>
          </div>
 
          <div class="col-md-2 border-right ">
        <div class="form-group">
            <label for="" class="control-label">To Date</label>
               
               <input type="date" name="to_date" class="form-control">
            </div> 
            <hr>
          </div>
         
          
  <div class="col-md-2 "  style="margin-top: 25px;" >
  <div class="form-group">
  <input align="right" type="submit" class="btn btn-primary btn-right btn-lg" name="search" value="Search">
</div>
</div>
<div>
<?php
   $grandtotal = '0';
    $from_date = '';
    $to_date = '';
   
            if(isset($_POST['search'])){
                 $from_date = $_POST['from_date'];
                 $to_date = $_POST['to_date'];
}
                  

                   /* $sql1 = "SELECT * FROM sales WHERE days = '$day' AND month = '$month' AND years = '$years' GROUP BY  grandtotal";// DESC
                    $query1 = mysqli_query($conn,$sql1);
                    ($rowcount = mysqli_num_rows($query1))
*/
                     $query = "SELECT * FROM sales WHERE created_date BETWEEN '$from_date' AND '$to_date' GROUP BY grandtotal"; 
                     
                    $data =$conn->query($query);
                   if ($data && $data->rowCount() > 0){
                    while($row=$data->fetch(PDO::FETCH_ASSOC)){
                      
                       $grandtotal += $row['grandtotal'];
                    
                  }
     
               }
?>
</div> 


<div class="col-md-2 text-primary" style="margin-top: 10px; font-size: 20px;">

 <span class="number counter"><?php echo "Total:Ghc  "; echo  htmlentities($grandtotal);?></span>
 
</div>


<!-- Table Panel -->
      <div class="col-md-12">
        <div class="card">          
          <div class="card-header bg-success text-white">
          <b>Customer Sale History </b>            
           
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
                 <th class="text-center">Action</th>
                  
                </tr>
              </thead>   
              <tbody> 
                
                 <?php
                 $i = 1;
                  if(isset($_POST['search'])){
        
                /* $day = $_POST['day'];sp inner join customer ct on sp.customer_id = ct.customer_id    GROUP BY grandtotal
                 $month = $_POST['month'];
                 $years = $_POST['years'];*/
                 $from_date = $_POST['from_date'];
                 $to_date = $_POST['to_date'];

                if($from_date != "" || $to_date != ""){

                $query = "SELECT * FROM sales sp inner join customer ct on sp.customer_id = ct.customer_id WHERE created_date BETWEEN '$from_date' AND '$to_date' "; 
                     
                    $data =$conn->query($query);
                   if ($data && $data->rowCount() > 0){
                    while($row=$data->fetch(PDO::FETCH_ASSOC)){
                      $customer_first = $row['firstnamec'];
                      $customer_last = $row['lastnamec'];

                       $day = $row['days'];
                       $month = $row['month'];
                       $years = $row['years']; 
                       $discount = $row['discount']; 
                       $total = $row['total'];
                       $grandtotal = $row['grandtotal'];
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
                     <?php echo $grandtotal;?>
                  </td>
                  <td class="text-center">
                     <?php echo $total;?>
                  </td>
                  <td class="text-center">
                     <?php echo $datee;?>
                  </td>
                  
                  <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary view_sales" type="button" data-id="<?php echo  $row['reciept_no']; ?>"
                      data-examID="<?php echo $row['reciept_no']; ?>">View</button>

                  </td>
               <tr>                            
                
                    <?php
                    }
                  }

                  else{
                      ?>
                        <tr>
                          <td> Records Not Found! </td>

                        </tr>
                      <?php
                  }  

                }
              }                 
                        
                ?>

              </tbody>
                
            </table>
          
        
        </form>        
      </div>

    
    <script>
  

  


</script>
 
