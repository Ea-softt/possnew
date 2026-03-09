<?php
include 'head.php';
    $month = isset($_GET['month']) ? $_GET['month'] : date('Y-m-d');
?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card_body">
            <div class="row justify-content-center pt-4 bg-success">
                <label for="" class="mt-2">Select Month</label>
                <div class="col-sm-3">
                    <input type="text" name="month" id="month" placeholder="Select Date" class="form-control">
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <table  class="table table-bordered" id='report-list'>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="">Barcode</th>
                            <th class="">CompanyName</th> 
                            <th class="">Product Name</th>                            
                            <th class="">Quantity</th>   
                            <th class="">Unit</th> 
                            <th class="">Cost Price</th>
                             <th class="">Total Cost</th>
                            <th class="">Expire Date</th>                             
                            <th class="">Remarks</th>                             
                            <th class="">Date</th>                        
                        </tr>
                    </thead>       
                    <tbody>
			          <?php
                      $i = 1;
                      $tcost1 = 0.0;
                      $payments = $conn->query("SELECT *, (cprice * Quantity) as tcost FROM newstock ns inner join supplier sp on ns.supplier_id = sp.supplier_id  where strftime('%Y-%m-%d', date_created) = '$month' order by strftime('%s', date_created) desc");
                     
			          while($row = $payments->fetch(PDO::FETCH_ASSOC)):
                       $month1 = $row['date_created'];
                      // $grandtotal += $row['grad'];
                       $tcost1 += $row['tcost'];
			          ?>
			          <tr>
                        <td class="text-center"><?php echo $i++ ?></td>
                      <!--  -->
                        <td class="text-center">
                            <p> <b><?php echo $row['product_no'] ?></b></p>
                        </td>
                         <td class="text-center">
                            <p> <b><?php echo $row['companyname'] ?></b></p>
                        </td>
                        <td class="text-center">
                            <p> <b><?php echo $row['product_name'] ?></b></p>
                        </td>                       
                        <td class="text-center">
                            <p> <b><?php echo $row['quantity'] ?></b></p>
                        </td>
                        <td class="text-center">
                            <p> <b><?php echo $row['unit'] ?></b></p>
                        </td>
                         <td class="text-center">
                            <p> <b><?php echo $row['cprice'] ?></b></p>
                        </td>
                         <td class="text-center">
                            <p> <b><?php echo $row['tcost'] ?></b></p>
                        </td>
                        <td class="text-center">
                            <p> <b><?php echo $row['expire_date'] ?></b></p>
                        </td>
                         <td class="text-center">
                            <p> <b><?php echo $row['remarks'] ?></b></p>
                        </td>

                        <td class="text-center">
                            <p> <b><?php echo date("Y-m-d",strtotime($month1)) ?></b></p>
                        </td>                  
                    </tr>
                    <?php 
                        endwhile;
                      
                    ?>
                   
			        </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" class="text-center">Total</th>
                            <th class="text-right"><?php echo number_format($tcost1) ?></th>
                            

                        </tr>
                    </tfoot>
                </table>
                <hr>
                <div class="col-md-12 mb-4">
                    <center>
                        <button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                    </center>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<noscript>
	<style>
		table#report-list{
			width:100%;
			border-collapse:collapse
		}
		table#report-list td,table#report-list th{
			border:1px solid
		}
        p{
            margin:unset;
        }
		.text-center{
			text-align:center
		}
        .text-right{
            text-align:right
        }
	</style>
</noscript>
<script>
$(document).ready(function(){
    $('.table').dataTable()
  
$('#report-list').ddTableFilter();
  })

$(function(){
    $("#month").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true

    });
     });

$('#month').change(function(){
    location.replace('newstock.php?page=loaded_stock&month='+$(this).val())
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
	})
</script>