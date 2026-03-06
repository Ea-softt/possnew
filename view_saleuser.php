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
                <label for="" class="control-label">Day</label>
               <select name="day" id="day" class="custom-select input-sm select2 "  cols="30" rows="4" required="">
               <?php
               for($i = 0; $i <= 31; ++$i){

                $time = strtotime(sprintf('+%d days',$i));
                $day_valye=date('d',$time);
                $days=date('d',$time);
                printf('<option class="text-center" value="%s">%s</option>',$day_valye,$days);
               }

               ?>
               <option selected="" value="<?php echo isset ($day)? $day :'' ?>"><?php echo isset ($day)? $day :'' ?></option>


               </select>
            </div>  
          <hr>
          </div>
 
          <div class="col-md-2 border-right ">
        <div class="form-group">
            <label for="" class="control-label">Month</label>
               <select name="month" id="month" class="custom-select input-sm select2" required="">
               <?php
               for($i = 0; $i <= 12; ++$i){

                $time = strtotime(sprintf('--%d months',$i));
                $monthValue=date('F',$time);
                $monthname=date('F',$time);
                printf('<option selected value="%s">%s</option>',$monthValue,$monthname);
               }
               ?>
                <option selected="" value="<?php echo isset ($month)? $month :'' ?>"><?php echo isset ($month)? $month :'' ?></option>
               </select>
            </div> 
            <hr>
          </div>
         
          <div class="col-md-2 border-right">
          <div class="form-group">
            <label for="" class="control-label">Year</label>
               <select name="years" id="years" class="custom-select input-sm select2"   required="">
               <?php $y=(int)date("Y"); ?>

               <option value="<?php echo $y; ?>" selected="true"><?php echo $y; ?></option>
               <?php $y--;
               for(; $y>"2019"; $y--){ ?>
                <option value="<?php echo $y; ?>"><?php echo $y; ?> </option>

            <?php } ?>        

               <option selected="" value="<?php echo isset ($year)? $year :'' ?>"><?php echo isset ($year)? $year :'' ?></option>
               </select>
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
 $day = "";
  $month = "";
   $years = "";
   $grandtotal = "0";
            if(isset($_POST['search'])){
                 $day = $_POST['day'];
                 $month = $_POST['month'];
                 $years = $_POST['years'];
}
                  

                   /* $sql1 = "SELECT * FROM sales WHERE days = '$day' AND month = '$month' AND years = '$years' GROUP BY  grandtotal";// DESC
                    $query1 = mysqli_query($conn,$sql1);
                    ($rowcount = mysqli_num_rows($query1))
*/
                     $query = "SELECT * FROM sales WHERE days = '$day' AND month = '$month' AND years = '$years'  GROUP BY grandtotal"; 
                     
                    $data =$conn->query($query);
                   if ($data->rowCount() > 0){
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
          <b>Student Statistic </b>            
           
          </div>          
          
            <table id="mytable" class="table table-condensed table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Customer Name</th>
                  <th class="text-center">Discount</th>
                  <th class="text-center">Total</th>                  
                  <th class="text-center">GrandTotal</th>
                  <th class="text-center">Day</th>
                  <th class="text-center">Month</th>
                  <th class="text-center">Years</th>
                  <th class="text-center">Print</th>

                  
                </tr>
              </thead>   
              <tbody> 
                
                 <?php
                 $i = 1;
                  if(isset($_POST['search'])){
        
                 $day = $_POST['day'];
                 $month = $_POST['month'];
                 $years = $_POST['years'];
                if($day != "" || $month != "" || $years != ""){

                $query = "SELECT * FROM sales sp inner join customer ct on sp.customer_id = ct.customer_id WHERE days = '$day' AND month = '$month' AND years = '$years'  GROUP BY grandtotal"; 
                     
                    $data =$conn->query($query);
                   if ($data->rowCount() > 0){
                    while($row=$data->fetch(PDO::FETCH_ASSOC)){
                      $customer_first = $row['firstnamec'];
                      $customer_last = $row['lastnamec'];

                       $day = $row['days'];
                       $month = $row['month'];
                       $years = $row['years']; 
                       $discount = $row['discount']; 
                       $total = $row['total'];
                       $grandtotal = $row['grandtotal'];
                     //  $reciept_no = $row['reciept_no'];
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
                     <?php echo $day;?>
                  </td>
                  <td class="text-center">
                     <?php echo $month;?>                     
                  </td>
                   <td class="text-center">
                     <?php echo $years;?>
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
  $(document).ready(function(){
    $('table').dataTable()
  
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
 
