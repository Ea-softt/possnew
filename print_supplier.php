<?php 
include 'server/config.php';
require_once('TCPDF-main/tcpdf.php');
$classexamin = $conn->query("SELECT * FROM supplier where supplier_id = {$_GET['supplier_id']}");

foreach($classexamin->fetch_array() as $k => $v){
	$$k= $v;
	  $meta[$k] = $v;
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
	<p class="text-center"><b><?php echo $_GET['supplier_id'] == 0  		
	?>	
	<h4 class="text-center">Supplier Details<h6 class="text-right">EA-Soft</h6>
	</h4>
	</p>
	<hr>
	<div class="flex">
		<div class="w-50">
			<p>Supplier ID: <b><?php echo $supplier_id ?></b></p>
			<br>
			<p>Company Name: <b><?php echo ucwords($companyname) ?></b></p>
			<br>
			<p>First Name: <b><?php echo $firstname ?></b></p>
			<br>
			<p>Last Name: <b><?php echo $lastname ?></b></p>
			<br>
			<p>Contact: <b><?php echo $contact_number ?></b></p>
			<br>
			<p>Address: <b><?php echo $address ?></b></p>
		</div>

<div class="w-50">
			<img src="<?php echo isset($meta['image']) ? '../img/'.$meta['image'] :'' ?>" alt="" id="cimg"> 
		
</div>		
	</div>	


<style>
	img#cimg{
		max-height: 100vh;
		max-width: 10vw;
	}
</style>