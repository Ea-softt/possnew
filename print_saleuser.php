<?php 
include 'server/config.php';
require_once('TCPDF-main/tcpdf.php');

$fees = $conn->query("SELECT * FROM sales sp inner join users us on sp.username = us.id inner join customer ct on sp.customer_id = ct.customer_id where username = {$_GET['username']}");
foreach($fees->fetch(PDO::FETCH_ASSOC) as $k => $v){
	$$k= $v;
}

$feet = $conn->query("SELECT * FROM  sales_product  where username = {$_GET['username']}");
foreach($feet->fetch(PDO::FETCH_ASSOC) as $t => $u){
	$$t= $u;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>

	 <link  rel="shortcut icon" type="image/icon" href="../img/Ea-Soft.ico">
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">    
     <script src="bootstrap4/jquery/jquery.min.js"></script>
      <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
     <script src="bootstrap4/jquery/sweetalert.min.js"></script>
     <script type="text/javascript" src="bootstrap4/js/script.js"></script>
           <!-- <script src="bootstrap4/js/time.js"></script> -->
      <script src="bootstrap4/jquery/accounting.min.js"></script>    
        <script src="bootstrap4/js/typeahead.js"></script>
         <script src="bootstrap4/js/jquery.datetimepicker.full.min.js"></script>
         <script type="text/javascript" src="bootstrap4/js/select2.min.js"></script>
          <script src="bootstrap4/js/ddtf.js"></script>
           <script type="text/javascript" src="bootstrap4/datatable/datatables.min.js"></script>



    <link rel="stylesheet" type="text/css" href="bootstrap4/css/style.css">
    <link href="bootstrap4/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="bootstrap4/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap4/css/dashboard.css" rel="stylesheet">          
     <link href="bootstrap4/css/select2.min.css" rel="stylesheet">
    <link href="bootstrap4/css/main.css" rel="stylesheet"> 
    <link href="bootstrap4/css/all.min.css" rel="stylesheet"> 
     <link href="bootstrap4/datatable/datatables.min.css" rel="stylesheet">



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
	.wborder1{
		border-top: 1px solid;
	}
	p{
		margin:unset;
	}

</style>
</head>
<body>


<p class="text-center"><b><?php echo $_GET['reciept_no'] == 0 ?>	
	<p><h4 class="text-center">Invoice Details</h4>Invoice #:<b><?php echo $days?></b><b><?php echo $username ?></b><b><?php echo $years ?></b><b><?php echo $reciept_no ?></b></p>
	<div class="flex">
		<div class="w-20">
			
		<!-- <img src="<?php echo isset($meta['image']) ? '../img/'.$meta['image'] :'' ?>" alt="" id="cimg"> -->
	</div>
		<div class="">
			<p><b>From:</b></p>
			
			<p>Salers Name: <b><?php echo $firstname . " " . $lastname  ?></b></p>
			
		</div>

		<div class="ml-auto">
				<p><b>To:</b></p>
			 <p>Customers Name: <b><?php echo $firstnamec . " " . $lastnamec ?></b></p>
			 

		</div>



	</div> 
	
	
	</p>
	<hr>
	
	<div class="table-responsive-sm">
				
	<!-- <table >
		<tr>
			<td width="100%">
				<p><b>Product Details</b></p>
				<p class="text-right"><?php echo $datesale ?></p>
				<hr> -->
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="center" >#</th>
						<th class="center">Barcode</th>
						<th width="center strong">Product</th>
						<th class="center">Price</th>
						<th class="center">Unit</th>
						<th class="center">Qty</th>	
						<th class="center">Subtotal</th>
						
						</tr>
					</thead>
					<tbody>
						 <?php  
                $i = 1;
                $reciept1 = $conn->query("SELECT * FROM  sales sl inner join sales_product sp on sl.reciept_no = sp.reciept_no inner join products pd on pd.product_no = sp.product_id where sl.reciept_no = {$_GET['username']}");

                while($row=$reciept1->fetch(PDO::FETCH_ASSOC)):
					$subtotal = ($row['qty']*$row['price']);
					$totalsales =($row['total']);
					
			//SELECT mi.*,mi.name as Name  FROM moneyin mi inner join moneyin_des md on mi.id = md.money_id  where id= ".$_GET['id'])





//"SELECT sl.*,sp.*,pd.*, FROM  sales sl inner join sales_product sp on sl.reciept_no = sp.recipt_no inner join products pd on sp.product_id = pd.product_no where reciept_no = {$_GET['reciept_no']}")

                  
                ?>
				<tr>
					<td class="center"><?php echo $i++ ?></td>
				 <td class="left strong " ><?php echo $row['product_id'] ?></td> 
				
				<td class="center strong" ><?php echo $row['product_name'] ?></td>
				 <td class="right"><?php echo number_format($row['price'])?></td> 
				<td class="center" ><?php echo $row['unit'] ?></td>
				<td class="right" ><?php echo $row['qty']?></td>
				<td class="cente" ><?php echo $subtotal?></td>
				</tr>
				<?php endwhile; ?>
				</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-5  ml-auto">
					<table class="table table-clear">
						<tbody>
							<tr>
								<td class="left">
							<strong class="text-dark">SubTotal</strong>
							</td>
							<th class='text-right text-primary '><b>Ghc <?php echo number_format($totalsales) ?></b>
							</th>								
							</tr>
							
							<tr>
							<td class="left">
							<strong class="text-dark">Discount:</strong>
							</td>
							<th class='text-right text-primary '><b>Ghc (<?php echo number_format($discount)?>%)</b>
							</th>								
							</tr>

							<tr>
							<td class="left">
							<strong class="text-dark">GrandTotal:</strong>
							</td>
							<th class='text-right text-primary '><b>Ghc <?php echo number_format($grandtotal)?></b>
							</th>								
							</tr>

						</tbody>
					</table>
				</div>

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
</body>
</html>