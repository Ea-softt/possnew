<?php include 'server/config.php'; 

/*$columns = array('username','discount','total','grandtotal','created_date');


$query = "SELECT * FROM sales ";

if($_POST["is_date_search"] == "yes"){

$query .= 'created_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';



}*/
if(isset($_POST["start_date"], $_POST['end_date']))
{
	  $grandtotal = 0;
      $total = 0;
	  $i = 1;
	  $start_date = $_POST["start_date"];
	  $end_date = $_POST["end_date"];

	$result = '';
	/* $query = "SELECT sp.*,ct.*, sum(sp.grandtotal) as grad FROM sales sp inner join newemployee ct on sp.username = ct.EmpID WHERE date_format(sp.created_date,'%Y-%m-%d') BETWEEN '".$start_date."' AND '".$end_date."' GROUP BY username order by unix_timestamp(sp.created_date) asc ";  

	 $sql =mysqli_query($conn, $query);*/

	  $payments = $conn->query("SELECT sp.*,ch.*,ct.*,sum(sp.grandtotal) as grad FROM sales sp inner join newemployee ct on sp.username = ct.EmpID inner join cashtype ch on sp.typeofcash = ch.id where strftime('%Y-%m-%d', sp.created_date) BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."' GROUP BY ch.id,strftime('%Y-%m-%d', sp.created_date) order by strftime('%s', sp.created_date) desc ");

	 $result .= '
 			<table   class="table table-bordered" id="report-list">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">User name</th>
                            <th class="text-center">Discount</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Cash Type</th>
                            <th class="text-center">Grandtotal</th>   
                            <th class="text-center">Date</th>                           
                        </tr>';
                         if($payments->num_rows ){


                      while($row = $payments->fetch(PDO::FETCH_ASSOC)){
                      	 $grandtotal += $row['grad'];
                        $customer_first = $row['FullName'];
                        $username = $row['username'];
                         $month1 = $row['created_date'];
                          $total += $row['total'];


                      	$result .='
                      	 <tr>
                        <td class="text-center">'.$i++.'</td> 
                        <td class="text-center">                            
                            <a href="usersalercodemonthpage.php?start_date='.date("Ymd",strtotime($start_date)).'&username='.$username.'&end_date='.date("Ymd",strtotime($end_date)).'">'.$customer_first.'</a>
                        </td>
                        <td class="text-center">
                            <p> <b>'.$row["discount"].'</b></p>
                        </td>
                        <td class="text-center">
                            <p> <b>'.$row["total"].'</b></p>
                        </td>
                         <td class="text-center">
                            <p> <b>' .$row["typeofcash"]. '</b></p>
                        </td>
                        <td class="text-center">
                            <p> <b>'.$row["grad"].'</b></p>
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
                            <th colspan="4" class="text-right ">Total</th>
                            <th class="text-right text-success">'.number_format($total,2).'</th>
                             <th class="text-right text-success">'.number_format($grandtotal,2).'</th>
                             
                            <th></th>
                        </tr>
                    </tfoot>';


                $result .='</table>';
                echo $result;
}




?>