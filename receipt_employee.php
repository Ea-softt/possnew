<?php 
include 'server/config.php';
require_once('TCPDF-main/tcpdf.php');


$classexamin = $conn->query("SELECT * FROM  newemployee  where EmpID = {$_GET['EmpID']}");

foreach($classexamin->fetch(PDO::FETCH_ASSOC) as $k => $v){
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
	<!-- <h4 class="text-center">Nashrudin Islamic Primary School
	 <br>Post office box 23 Elubo
	 <br>Western Jomoro <h6 class="text-right">EA-Soft</h6>
	</h4>
	</b>
	</p>
	<hr>
	<hr> -->
	<p><b>Employee Details </b></p>
	<hr>
	<div class="flex">		
		<div class="w-50">
			<br>
			<br>
			<p>Employee ID: <b><?php echo $EmpID ?></b></p>
			<br>
			<p>Employee Name: <b><?php echo ucwords($FullName) ?></b></p>
			<br>
			<p>Date of Birth: <b><?php echo $DOB ?></b></p>


		</div>
		
		<div class="w-50">			
			
		
		</div>
		<div class="" style="width: 150px;">
			<img src="<?php echo isset($meta['picture']) ? '../img/'.$meta['picture'] :'' ?>" alt="" id="cimg"> 
		</div>
	</div>
	<hr>
	
	<div class="flex">		
		<div class="w-50">	
			<br>		
			<p>Age: <b><?php echo $Age ?></b></p>
			<br>
			<p>Gender: <b><?php echo $Gender ?></b></p>
			<br>
			<p>Nationality: <b><?php echo $Nationality ?></b></p>
			<br>
			<p>Hometown: <b><?php echo $Hometown ?></b></p>
		</div>
		
		<div class="w-50">
			<br>
			<p>Status: <b><?php echo $Status ?></b></p>
			<br>
			<p>Department: <b><?php echo $Department ?></b></p>
			<br>
			<p>Last School: <b><?php echo $Lastschool ?></b></p>
			<br>
			<p>Qualification: <b><?php echo $Qualification ?></b></p>
		</div>
		
	</div>
	<hr>
	
	<div class="flex">		
		<div class="w-50">
			<br>
			<p>Starting Date: <b><?php echo $StartingDate ?></b></p>
			<br>
			<p>Religion: <b><?php echo $Religion ?></b></p>
			<br>
			<p>Language: <b><?php echo $Language ?></b></p>
			<br>
			<p>Employer: <b><?php echo $Employer ?></b></p>
			
		</div>
		
		<div class="w-50">
			
			
		</div>
		
	</div>
	<hr>
	








		
	
	<table class="wborder">
				
				</table>
<style>
	img#cimg{
		max-height: 100vh;
		max-width: 10vw;
	}
</style>

<br>
<br>
<br>
<br>
<br>
<br>
<p><b>Design by EA-Soft</b></p>
