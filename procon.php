<?php
 include('server/config.php');
$image = '';
 $output = '';
 $sql = "SELECT * FROM products WHERE product_name LIKE product_name AND product_no > 0 order by quantity desc ";
 $result = mysqli_query($conn, $sql);
 
   $output .='
   
        <div class="card">          
                  <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <b>New List For Stock</b>
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)" id="SupplierDeliverlist">
                        <i class="fa fa-plus"></i> New Entry
                    </a>
                </div>








          <div class="card-body">

 		<table id="mytable" class="table table-condensed table-bordered table-hover">
     <thead>
 			<tr>
 			<th >barcode</th>
 			<th >Prod Name</th>
 			<th >Sell_Price</th>
 			<th >Quantity</th>
 			<th >Unit</th>
 			<th >Min_Stocks</th>
 			<th >Remarks</th>
 					
 			<th >Expire date</th>
      <th >Action</th>
 			</tr>
       </thead>';

 if(mysqli_num_rows($result) > 0)
 {

 	while($row = mysqli_fetch_array($result)){
  $output .= '<tr>

  <td class="product_no text-center" data-product_no="'.$row["product_no"].'" contenteditable>'.$row["product_no"].'</td>
 
 <td class="product_name text-center" data-product_name="'.$row["product_no"].'" contenteditable>'.$row["product_name"].'</td>

<td class="sell_price text-center" data-sell_price="'.$row["product_no"].'" contenteditable>'.$row["sell_price"].'</td>

<td class="quantity text-center" data-quantity="'.$row["product_no"].'" contenteditable>'.$row["quantity"].'</td>
<td class="unit text-center" data-unit="'.$row["product_no"].'" contenteditable>'.$row["unit"].'</td>

<td class="min_stocks text-center" data-min_stocks="'.$row["product_no"].'" contenteditable>'.$row["min_stocks"].'</td>

<td class="remarks text-center" data-remarks="'.$row["product_no"].'" contenteditable>'.$row["remarks"].'</td>



<td class="images" text-center" data-image="'.$row["product_no"].'" contenteditable>'.$row["expire_date"].'
</td>

<td class="text-center"><button name="btn delete" id="btn_delete" class="btn btn-xs btn-danger btn_delete" data-delete_btn="'.$row["product_no"].'" >x</button></td> </tr>';

 	}
 $output .= '<tr>
<td id="product_no"  contenteditable></td>
 <td id="product_name"  contenteditable></td>
<td id="sell_price"  contenteditable></td>
<td id="quantity"  contenteditable></td>
<td id="unit"  contenteditable></td>

<td id="min_stocks"  contenteditable></td>
<td id="remarks"  contenteditable></td>

<td id="images"  contenteditable></td>
<td class="text-center"><button name="btn_add" id="btn_add" class="btn btn-xs btn-success" >+</button></td>
</tr>';




 }
 else
 {
$output .='<tr>

		<td colspan="4">Data not Found! </ta>

		</tr>';

 }

 $output .= '</table>
 		</div>
    </div>
    </div>';

echo $output;
 ?>


<script>
  
  $('#SupplierDeliverlist').click(function(){
    
    window.location.href='productform.php';
  })


</script>