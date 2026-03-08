<?php 
include 'server/config.php';
require_once('TCPDF-main/tcpdf.php');


$fees = $conn->query("SELECT * FROM warehouse ");
foreach($fees->fetch(PDO::FETCH_ASSOC) as $k => $v){
	$$k= $v;
}

/*
$feet = $conn->query("SELECT * FROM  sales_product  where reciept_no = {$_GET['reciept_no']}");
foreach($feet->fetch_array() as $t => $u){
	$$t= $u;
}*/
?>

<style>
	

</style>

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
	p{
		margin:unset;
	}

</style>
</head>
<body>

 



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
						<th class="center">ID</th>
						<th width="center strong">Product</th>
						<th class="center">Quantity</th>
						<th class="center">Price</th>
						<th class="center">TCost</th>	
						<th class="center">Unit</th>
						<th class="center">Description</th>
						<th class="center">Expire Date</th>
						</tr>
					</thead>
					<tbody>
						 <?php  
                $i = 1;
                $fees = $conn->query("SELECT * FROM warehouse order by quantity desc ");

                while($row=$fees->fetch(PDO::FETCH_ASSOC)):
					
	   
                ?>
				<tr>
					<td class="center"><?php echo $i++ ?></td>
				 <td class="left strong " ><?php echo $row['sid'] ?></td> 
				
				<td class="center strong" ><?php echo $row['name'] ?></td>
				 
				 <td class="center" ><?php echo $row['quantity'] ?></td>
				 <td class="right"><?php echo number_format($row['price'])?></td> 
				 <td class="right"><?php echo number_format($row['multtota'])?></td> 
				<td class="center" ><?php echo $row['unit'] ?></td>
				<td class="right" ><?php echo $row['description']?></td>
				<td class="cente" ><?php echo $row['expire_date']?></td>

				</tr>
				<?php endwhile; ?>
				</tbody>
				</table>
			</div>
			

				
	<!-- 					
		</tr>
	</table>
	 -->
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