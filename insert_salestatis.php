<?php include 'server/config.php'; 

/*$columns = array('username','discount','total','grandtotal','created_date');


$query = "SELECT * FROM sales ";

if($_POST["is_date_search"] == "yes"){

$query .= 'created_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';



}*/
if(isset($_POST["start_date"], $_POST['end_date']))
{
	 $stotal = 0;
    $ctotal = 0;
    $diff = 0;
    $month1 =0;
	  $i = 1;
	  $start_date = $_POST["start_date"];
	  $end_date = $_POST["end_date"];

	$result = '';
	
      $payments = $conn->query("SELECT sp.*, p.*, sum(sp.qty) as qty1, (p.sell_price * sum(sp.qty)) as stotal, (p.cprice * sum(sp.qty)) as ctotal,((p.sell_price * sum(sp.qty))-(p.cprice * sum(sp.qty))) as diff FROM sales_product sp inner join products p on sp.product_id = p.product_no where date_format(sp.created_date,'%Y-%m-%d') BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."'  GROUP BY sp.product_id,date_format(sp.created_date,'%Y-%m-%d') order by unix_timestamp(sp.created_date) desc ");




	 /* $payments = $conn->query("SELECT sp.*,ct.*,sum(sp.grandtotal) as grad FROM sales sp inner join newemployee ct on sp.username = ct.EmpID where date_format(sp.created_date,'%Y-%m-%d') BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."' GROUP BY sp.username,date_format(sp.created_date,'%Y-%m-%d') order by unix_timestamp(sp.created_date) desc ");
*/
	 $result .= '
 			<table   class="table table-bordered" id="report-list">
                    <thead>
                        <tr>
                             <th class="text-center">#</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Sprice</th>
                            <th class="text-center">Cprice</th>
                            <th class="text-center">Qty sole</th>   
                            <th class="text-center">STotal</th>  
                            <th class="text-center">CTotal</th>  
                             <th class="text-center">Diff</th>  
                             <th class="text-center">Date</th>                             
                        </tr>';
                         if($payments->num_rows ){


                      while($row = $payments->fetch_array()){
                      	 $stotal += $row['stotal'];
                        $ctotal += $row['ctotal'];
                        $diff += $row['diff'];
                         $month1 = $row['created_date'];





                
                      	$result .='
                      	 <tr>
                        <td class="text-center">'.$i++.'</td> 
                       
                        <td class="text-center">
                            <p> <b>'.$row["product_name"].'</b></p>
                        </td>
                        <td class="text-center">
                            <p> <b>'.$row["sell_price"].'</b></p>
                        </td>
                        <td class="text-center">
                            <p> <b>'.number_format($row['cprice'],2).'</b></p>
                        </td>
                         <td class="text-center">
                            <p> <b>'.$row['qty1'].'</b></p>
                        </td>
                        <td class="text-center">
                            <p> <b>'.number_format($row['stotal'],2).'</b></p>
                        </td>
                        
                        <td class="text-center">
                            <p> <b>'.number_format($row['ctotal'],2).'</b></p>
                        </td>
                         <td class="text-center">
                            <p> <b>'.number_format($row['diff'],2).'</b></p>
                        </td>
                        <td class="text-center">
                            <p> <b>'. date("Y-m-d",strtotime($month1)) .'</b></p>
                        </td>                  
                    </tr>';
                    	}
                      }
                      else
                      {
                      	$result .='
                      	<tr>
                      	<td colspan="5">No Sale found </td>
                      	</tr>';

                      	
                      }

                    $result .=' 
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right ">Total</th>
                            <th class="text-right text-success">'.number_format($stotal,2).'</th>
                             <th class="text-right text-success">'.number_format($ctotal,2).'</th>
                               <th class="text-right text-success">'.number_format($diff,2).'</th>
                            <th></th>
                        </tr>
                    </tfoot>';


                $result .='</table>';
                echo $result;
}




?>
<script>
$(document).ready(function(){
    $('.table').dataTable();
  
$('#report-list').ddTableFilter();
  });
  </script>