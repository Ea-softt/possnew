<?php
include 'server/config.php';
require_once('TCPDF-main/tcpdf.php');
$classexamin = $conn->query("SELECT * FROM supplierdeliver sl  INNER JOIN supplier s ON sl.name = s.supplier_id WHERE sid  = {$_GET['id']}");

foreach($classexamin->fetch(PDO::FETCH_ASSOC) as $k => $v) {
    $$k = $v;
    $meta[$k] = $v;
}
?>

<style>
    .flex {
        display: inline-flex;
        width: 100%;
    }
    .w-50 {
        width: 50%;
    }
    .w-20 {
        width: 20%;
    }
    .text-center {
        text-align: center;
    }
    .text-right {
        text-align: right;
    }
    p {
        margin: unset;
    }

    /* Image Gallery Styles */
    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }
    .image-container {
        position: relative;
        width: 150px;
        height: 150px;
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .zoom-controls {
        margin-top: 10px;
        text-align: center;
    }
    .zoom-controls button {
        margin: 0 5px;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        overflow: auto;
    }
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }
    .modal-content img {
        width: 100%;
        height: auto;
        display: block;
        margin: auto;
    }
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        cursor: pointer;
    }
    .close:hover {
        color: #bbb;
    }
</style>

<div class="container-fluid">
    <p class="text-center">
    <h4 class="text-center">Supplier Details</h4>
    <div class="flex">
        <div class="w-20">
            <?php
            // Fetch images from the supplierdeliver table
            $imagesQuery = $conn->query("SELECT image FROM supplierdeliver WHERE sid = $sid");
            $images = [];
            while ($row = $imagesQuery->fetch_assoc()) {
                if (!empty($row['image'])) {
                    $imagePaths = explode(',', $row['image']);
                    $images = array_merge($images, $imagePaths);
                }
            }
            if (!empty($images)) {
                echo '<img src="../img/' . $images[0] . '" alt="Supplier Image" id="cimg" onclick="openModal(\'../img/' . $images[0] . '\')">';
            } else {
                echo '<img src="" alt="No Image" id="cimg">';
            }
            ?>
        </div>
        <div class="w-50">
            <p>Supplier ID: <b><?php echo $supplier_id?></b></p>
            <p>Company Name: <b><?php echo ucwords($companyname) ?></b></p>
            <p>Address: <b><?php echo $address ?></b></p>
        </div>
        <div class="w-50">
            <p>First Name: <b><?php echo $firstname ?></b></p>
            <p>Last Name: <b><?php echo $lastname ?></b></p>
            <p>Contact: <b><?php echo $contact_number ?></b></p>
        </div>
    </div>
    <hr>

    <!-- Image Gallery -->
    <div class="text-center">
        <h4>Product Images</h4>
        <div class="image-gallery" id="imageGallery">
            <?php
            if (!empty($images)) {
                foreach ($images as $image) {
                    echo '<div class="image-container">';
                    echo '<img src="/img/' . $image . '" alt="Product Image" onclick="openModal(\'/img/' . $image . '\')">';
                    echo '</div>';
                }
            } else {
                echo '<p>No images available.</p>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="modal" onclick="closeModal()">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
    <div class="zoom-controls">
        <button onclick="zoomIn()">Zoom In (+)</button>
        <button onclick="zoomOut()">Zoom Out (-)</button>
        <button onclick="resetZoom()">Reset Zoom</button>
    </div>
</div>

<script>
    // Modal functionality
    function openModal(imgSrc) {
        document.getElementById('imageModal').style.display = 'block';
        document.getElementById('modalImage').src = imgSrc;
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    // Zoom functionality
    let scale = 1;
    function zoomIn() {
        scale += 0.2;
        document.getElementById('modalImage').style.transform = 'scale(' + scale + ')';
    }

    function zoomOut() {
        scale -= 0.2;
        if (scale < 0.2) scale = 0.2;
        document.getElementById('modalImage').style.transform = 'scale(' + scale + ')';
    }

    function resetZoom() {
        scale = 1;
        document.getElementById('modalImage').style.transform = 'scale(1)';
    }

    // Close modal when clicking outside the image
    window.onclick = function(event) {
        const modal = document.getElementById('imageModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
















<!-- <?php 
//include 'server/config.php';
//require_once('TCPDF-main/tcpdf.php');
$classexamin = $conn->query("SELECT * FROM suppliercompany sc inner join supplier s on sc.companynameid = s.supplier_id where id = {$_GET['id']}");

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
	.wborder1{
		border-top: 1px solid;
	}
	p{
		margin:unset;
	}

</style>



<div class="container-fluid">
	<p class="text-center"><b><?php echo $_GET['id'] == 0 ?>	
	<h4 class="text-center">Supplier Details</h4>
	<div class="flex">
		<div class="w-20">
		<img src="<?php echo isset($meta['image']) ? '../img/'.$meta['image'] :'' ?>" alt="" id="cimg">
	</div>
		<div class="w-50">
			<p>Supplier ID: <b><?php echo $id ?></b></p>
			<p>Company Name: <b><?php echo ucwords($companyname) ?></b></p>
			 <p>Address: <b><?php echo $address ?></b></p>
		</div>

		<div class="w-50">
			 <p>First Name: <b><?php echo $firstname ?></b></p>
			 <p>Last Name: <b><?php echo $lastname ?></b></p>
			 <p>Contact: <b><?php echo $contact_number ?></b></p>

		</div>



	</div>
	
	
	</p>
	<hr>
	<div class="flex">
				
	<table >
		<tr>
			<td width="100%">
				<p><b>Product Details</b></p>
				<p class="text-right"><?php echo $date_deliver ?></p>
				<hr>
				<table>
					<tr>
						<td width="30%">Product</td>
						<td width="20%" >Quantity</td>
						<td width="20%" >Unit</td>
						<td width="30%" >Description</td>
						<td width="50%" >Price</td>						
						<td width="50%" >Total</td>
					</tr>
					<?php 
				$cfees = $conn->query("SELECT * FROM supplierdeliver where supplierid = $id");
				$ttotal = 0;
				$ptotal = 0;

				while ($row = $cfees->fetch_assoc()) {
					$ptotal += $row['price'];
					$ttotal += $row['multtota'];
				?>
				<tr>
				<td class="text-left" ><?php echo $row['name'] ?></td>
				<td class="text-center"><b><?php echo number_format($row['quantity']) ?></b>
					</td>
					<td class="text-left" ><?php echo $row['unit'] ?></td>
					<td class="text-center"><?php echo $row['description'] ?></td>
				<td class="text-center" ><?php echo number_format($row['price']) ?></td>
				<td class="text-center" ><?php echo number_format($row['multtota']) ?></td>
				</tr>
				<?php	}
				?>
				<tr class="wborder1">					
					<th>Total</th>
					<th  class='text-right text-primary '><b><?php echo number_format($ptotal) ?></b></th>
					<th class='text-right text-primary '><b><?php echo number_format($ttotal) ?></b></th>
				</tr>
				</table>
						
				
						
		</tr>
	</table>
<style>
	img#cimg{
		max-height: 100vh;
		max-width: 10vw;		
		position: relative;
	}
	img {
		padding-right: 30px;
	}
</style> -->