<?php 
include 'server/config.php';
$fees = $conn->query("SELECT p.*,ps.* FROM paymen_supplier p inner join paypay_supplier ps on p.id = ps.paymen_supplierID  where paymen_supplierID = {$_GET['paymen_supplierID']}");
foreach($fees->fetch(PDO::FETCH_ASSOC) as $k => $v){
	$$k= $v;
}
$payments = $conn->query("SELECT * FROM paypay_supplier where paymen_supplierID = $id ");
$pay_arr = array();
while($row=$payments->fetch(PDO::FETCH_ASSOC)){
	$pay_arr[$row['pay_id']] = $row;
}
?>

<style>
	.flex{
		display: inline-flex;
		width: 100%;
	}
	.w-50{
		width: 50%;
	}
	.text-center{
		text-align:center;
	}
	.text-right{
		text-align:right;
	}
	table.wborder{
		width: 100%;
		border-collapse: collapse;
	}
	table.wborder>tbody>tr, table.wborder>tbody>tr>td{
		border:1px solid;
	}
	p{
		margin:unset;
	}

</style>
<div class="container-fluid">
	<p class="text-center"><b><?php echo $_GET['paymen_supplierID'] == 0 ? "Payments" : 'Payment Receipt' ?></b></p>
	<hr>
	<div class="flex">
		<div class="w-50">
			<p>Batch No: <b><?php echo $batchno ?></b></p>
			<p>Supplier's Name <b><?php echo ucwords($companyname) ?></b></p>
			
		</div>
		<?php if($_GET['pid'] > 0): ?>
		<!-- <div class="w-50">
			<p>Payment Date: <b><?php echo isset($pay_arr[$_GET['id']]) ? date("M d,Y",strtotime($pay_arr[$_GET['pay_id']]['date_created'])): '' ?></b></p>
			<p>Paid Amount: <b><?php echo isset($pay_arr[$_GET['pay_id']]) ? number_format($pay_arr[$_GET['pay_id']]['amountt'],2): '' ?></b></p>
			<p>Remarks: <b><?php echo isset($pay_arr[$_GET['pay_id']]) ? $pay_arr[$_GET['pay_id']]['remark']: '' ?></b></p>
		</div> -->
		<?php endif; ?>
	</div>
	<hr>
	<p><b>Payment Summary</b></p>
	<table class="wborder">
		<tr>
			<td width="50%">
				<p><b>Fee Details</b></p>
				<hr>
				<table width="100%">
					<tr>
						<td width="50%">Fee Type</td>
						<td width="50%" class='text-right'>Amount</td>
					</tr>
					<?php 
				$cfees = $conn->query("SELECT * FROM paymen_supplier where id = $paymen_supplierID");
				$ftotal = 0;
				while ($row = $cfees->fetch(PDO::FETCH_ASSOC)) {
					$ftotal += $row['amount'];
				?>
				<tr>
					<td><b><?php echo $row['typeofpayment'] ?></b></td>
					<td class='text-right'><b><?php echo number_format($row['amount']) ?></b></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<th>Total</th>
					<th class='text-right'><b><?php echo number_format($ftotal) ?></b></th>
				</tr>
				</table>
			</td>			
			<td width="50%">
			<p><b>Payment Details</b></p>
				<table width="100%" class="wborder">
					<tr>
						<td width="50%">Date</td>
						<td width="50%" class='text-right'>Amount</td>
					</tr>
					<?php 
						$ptotal = 0;
						foreach ($pay_arr as $row) {
							if($row["paymen_supplierID"] <= $_GET['pid'] || $_GET['pid'] == 0){
							$ptotal += $row['amountt'];
					?>
					<tr>
						<td><b><?php echo date("Y-m-d",strtotime($row['date_create'])) ?></b></td>
						<td class='text-right'><b><?php echo number_format($row['amountt']) ?></b></td>
					</tr>
					<?php
						}
						}
					?>
					<tr>
						<th>Total<payment>
						<th class='text-right'><b><?php echo number_format($ptotal) ?></b></th>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td>Total Payable Fee</td>
						<td class='text-right'><b><?php echo number_format($ftotal) ?></b></td>
					</tr>
					<tr>
						<td>Total Paid</td>
						<td class='text-right'><b><?php echo number_format($ptotal) ?></b></td>
					</tr>
					<tr>
						<td>Balance</td>
						<td class='text-right'><b><?php echo number_format($ftotal-$ptotal) ?></b></td>
					</tr>
				</table>
			</td>			
		</tr>
	</table>
</div>