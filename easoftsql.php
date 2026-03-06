<?php
//session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'server/config.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db = null;
	    ob_end_flush();
	}

	function login_user(){
		extract($_POST);
		
		$data = " username = '".str_replace("'","&#x2019;",$username)."' ";
		$data .= ", uid = '$uid' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";		
		
		
		$check = $this->db->query("SELECT count(*) FROM login where uid ='$uid' and username ='$username' and password ='".md5($password)."' ".(!empty($id) ? " and id != {$id} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			//$save = $this->db->query("INSERT INTO login set $data");
			// SQLite INSERT
			$save = $this->db->query("INSERT INTO login (username, uid, password, type) VALUES ('".str_replace("'","&#x2019;",$username)."', '$uid', '".md5($password)."', '$type')");
			
			}else{

				$save = $this->db->query("UPDATE login set $data where id = $id");
		}

			if($save)			
			return 1;
}

function delete_login(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM login where id = ".$id);
		if($delete)
			return 1;
	}

	
	function save_course(){
		extract($_POST);
		$data = "";
		$cols = array();
		$vals = array();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','fid','type','amount')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
					
				}else{
					$data .= ", $k='$v' ";
				}
				$cols[] = $k;
				$vals[] = "'$v'";
			}
		}
		
		if(empty($id)){


			//$save = $this->db->query("INSERT INTO courses set $data");
			$save = $this->db->query("INSERT INTO courses (".implode(',', $cols).") VALUES (".implode(',', $vals).")");
			if($save){
				$id = $this->db->lastInsertId();
				foreach($fid as $k =>$v){
					//$data = " course_id = '$id' ";
					//$data .= ", description = '{$type[$k]}' ";
					//$data .= ", amount = '{$amount[$k]}' ";
					//$save2[] = $this->db->query("INSERT INTO fees set $data");
					$save2[] = $this->db->query("INSERT INTO fees (course_id, description, amount) VALUES ('$id', '{$type[$k]}', '{$amount[$k]}')");
				}
				if(isset($save2))
						return 1;
			}
		}else{
			$save = $this->db->query("UPDATE courses set $data where id = $id");
			if($save){
				$this->db->query("DELETE FROM fees where course_id = $id and id not in (".implode(',',$fid).") ");
				foreach($fid as $k =>$v){
					$data = " course_id = '$id', description = '{$type[$k]}', amount = '{$amount[$k]}' ";
					if(empty($v)){
						//$save2[] = $this->db->query("INSERT INTO fees set $data");
						$save2[] = $this->db->query("INSERT INTO fees (course_id, description, amount) VALUES ('$id', '{$type[$k]}', '{$amount[$k]}')");
					}else{
						$save2[] = $this->db->query("UPDATE fees set $data where id = $v");
					}
				}
				if(isset($save2))
						return 1;
			}
		}

	}
	/*function delete_course(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM courses where id = ".$id);
		$delete2 = $this->db->query("DELETE FROM fees where course_id = ".$id);
		if($delete && $delete2){
			return 1;
		}
	}
*/

	

	function save_paymentsupplier(){
		extract($_POST);

		$data = " companyname = '".str_replace("'","&#x2019;",$companyname)."' ";
		$data .= ", batchno = '$batchno' ";
		$data .= ", typeofpayment = '$type' ";
		$data .= ", amount = '$amount' ";
		

		$check = $this->db->query("SELECT count(*) FROM paymen_supplier where batchno ='$batchno' AND companyname ='$companyname' AND typeofpayment = '$type' AND amount = '$amount' ".(!empty($id) ? " and id != {$id} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			//$save = $this->db->query("INSERT INTO paymen_supplier set $data");
			$save = $this->db->query("INSERT INTO paymen_supplier (companyname, batchno, typeofpayment, amount) VALUES ('".str_replace("'","&#x2019;",$companyname)."', '$batchno', '$type', '$amount')");
		}else{
			$save = $this->db->query("UPDATE paymen_supplier set $data where id = $id");
		}
		if($save)
			return 1;
	}

	
	function delete_paymentsupplier(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM paymen_supplier where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_paypayment(){
		extract($_POST);
		
		$data = " paymen_supplierID = '$paymen_supplierID' ";
		$data .= ", amountt = '$amountt' ";
		$data .= ", remark = '$remark' ";
		
		if(empty($id)){
			//$save = $this->db->query("INSERT INTO paypay_supplier set $data");
			$save = $this->db->query("INSERT INTO paypay_supplier (paymen_supplierID, amountt, remark) VALUES ('$paymen_supplierID', '$amountt', '$remark')");
			if($save)
				$id= $this->db->lastInsertId();
		}else{
			$save = $this->db->query("UPDATE paypay_supplier set $data where id = $id");
		}
		if($save)
			return 1;
	}


	function delete_paypayment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM paypay_supplier where id = ".$id);
		if($delete){
			return 1;
		}
	}
	

	function save_overallpaymen(){
		extract($_POST);
		
		$data = " supppliername = '".str_replace("'","&#x2019;",$supppliername)."' ";
		//$data .= ", batchno = '$batchno' ";
		/*$data .= ", currentpayment = '$currentpayment' ";
		$data .= ", suppliercurrentbilling = '$suppliercurrentbilling' ";
		$data .= ", amountpaid = '$amountpaid' ";
		$data .= ", amountpayable = '$amountpayable' ";
		$data .= ", remark = '$remark' ";*/

		if(empty($id)){
			//$save = $this->db->query("INSERT INTO cashtypee set $data");
			$save = $this->db->query("INSERT INTO cashtypee (supppliername) VALUES ('".str_replace("'","&#x2019;",$supppliername)."')");
			if($save)
				$id= $this->db->lastInsertId();
		}else{
			$save = $this->db->query("UPDATE cashtypee set $data where id = $id");
		}
		if($save)
			return 1;
	}



	function delete_overallpayment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM overalltotal where id = ".$id);
		if($delete){
			return 1;
		}
	}
	
	
function save_emma(){
		extract($_POST);
		$data = " supppliername = '".str_replace("'","&#x2019;",$supppliername)."' ";
		$data .= ", batchno = '$batchno' ";
		$data .= ", currentpayment = '$currentpayment' ";
		$data .= ", suppliercurrentbilling = '$suppliercurrentbilling' ";
		$data .= ", amountpaid = '$amountpaid' ";
		$data .= ", amountpayable = '$amountpayable' ";
		$data .= ", remark = '$remark' ";



		if(empty($id)){
			//$save = $this->db->query("INSERT INTO cashtypee set $data");
			$save = $this->db->query("INSERT INTO cashtypee (supppliername, batchno, currentpayment, suppliercurrentbilling, amountpaid, amountpayable, remark) VALUES ('".str_replace("'","&#x2019;",$supppliername)."', '$batchno', '$currentpayment', '$suppliercurrentbilling', '$amountpaid', '$amountpayable', '$remark')");
						
		}else{
			$save = $this->db->query("UPDATE cashtypee set $data where id = $id");
		}
		


		if($save)
			return 1;
			}




			function delete_emma(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM cashtypee where id = ".$id);
		if($delete){
			return 1;
		}
	}


function eml_Payment(){
		extract($_POST);
		$data = "";
		$cols = array();
		$vals = array();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','pid','altype','amount')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
				$cols[] = $k;
				$vals[] = "'$v'";
			}
		}
		
		$check = $this->db->query("SELECT count(*) FROM lfepayment where id ='$id' ".(!empty($id) ? " and id != {$id} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			//$save = $this->db->query("INSERT INTO lfepayment set $data");
			$save = $this->db->query("INSERT INTO lfepayment (".implode(',', $cols).") VALUES (".implode(',', $vals).")");

			if($save){
				$id = $this->db->lastInsertId();
				foreach($pid as $k =>$v){
					//$data = " lfepayment_ID = '$id' ";
					//$data .= ", description = '{$altype[$k]}' ";
					//$data .= ", amount = '{$amount[$k]}' ";
					//$save2[] = $this->db->query("INSERT INTO allowance set $data");}
					$save2[] = $this->db->query("INSERT INTO allowance (lfepayment_ID, description, amount) VALUES ('$id', '{$altype[$k]}', '{$amount[$k]}')");}
					if(isset($save2))
						return 1;			
					}
			}else{
			$save = $this->db->query("UPDATE lfepayment set $data where id = $id");
			if($save){
				$this->db->query("DELETE FROM allowance where lfepayment_ID = $id and id not in (".implode(',',$pid).") ");
				foreach($pid as $k =>$v){
					$data = " lfepayment_ID = '$id', description = '{$altype[$k]}', amount = '{$amount[$k]}' ";
					if(empty($v)){
						//$save2[] = $this->db->query("INSERT INTO allowance set $data");
						$save2[] = $this->db->query("INSERT INTO allowance (lfepayment_ID, description, amount) VALUES ('$id', '{$altype[$k]}', '{$amount[$k]}')");
					}else{
						$save2[] = $this->db->query("UPDATE allowance set $data where id = $v");
					}
				}
				if(isset($save2))
						return 1;
			}
		}

	}

	function delete_emlPayment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM lfepayment where id = ".$id);
		$delete2 = $this->db->query("DELETE FROM allowance where lfepayment_ID = ".$id);
		if($delete && $delete2){
			return 1;
		}
	}



function new_customer(){
		extract($_POST);
		
		$data = " firstnamec = '".str_replace("'","&#x2019;",$fname)."' ";
		$data .= ", lastnamec = '$lname' ";
		$data .= ", address = '$address' ";
		$data .= ", contact_number = '$number' ";
		$cols = "firstnamec, lastnamec, address, contact_number";
		$vals = "'".str_replace("'","&#x2019;",$fname)."', '$lname', '$address', '$number'";
		
		
	
		if(($_FILES['img']['tmp_name'] != '')){
						$picture -> strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../posnew/img/'. $picture);
					$data .= ", image = '$picture' ";
					$cols .= ", image";
					$vals .= ", '$picture'";
					//$finfo->file($_FILES['upfile']['tmp_name']

		}

		
		$check1 = $this->db->query("SELECT count(*) FROM customer where firstnamec ='$fname' and lastnamec = '$lname' or contact_number = $number ".(!empty($id) ? " and customer_id != {$id} " : ''))->fetchColumn();
		if($check1 > 0){
			return 2;
			exit;
		}

		

		if(empty($id)){
			//$save = $this->db->query("INSERT INTO customer set $data");
			$save = $this->db->query("INSERT INTO customer ($cols) VALUES ($vals)");
						
		}else{
			$save = $this->db->query("UPDATE customer set $data where customer_id = $id");
		}
		if($save)			
			return 1;
			/*return son_encode(array('status'=>1));	*/
}

function delete_customer(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM customer  where customer_id = ".$id);
		if($delete){
			return 1;
		}
	}



function new_supplier(){
		extract($_POST);
		
		$data = " companyname = '".str_replace("'","&#x2019;",$cname)."' ";
		$data .= ", firstname = '$fname' ";
		$data .= ", lastname = '$lname' ";
		$data .= ", address = '$address' ";
		$data .= ", contact_number = '$number' ";
		$cols = "companyname, firstname, lastname, address, contact_number";
		$vals = "'".str_replace("'","&#x2019;",$cname)."', '$fname', '$lname', '$address', '$number'";
		
		
	
		if($_FILES['img']['tmp_name'] != ''){
						$picture = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../posnew/img/'. $picture);
					$data .= ", image = '$picture' ";
					$cols .= ", image";
					$vals .= ", '$picture'";

		}

		
	$check1 = $this->db->query("SELECT count(*) FROM supplier where companyname ='$cname' and contact_number ='$number' ".(!empty($id) ? " and supplier_id != {$id} " : ''))->fetchColumn();
		if($check1 > 0){
			return 2;
			exit;
		}



		if(empty($id)){
			//$save = $this->db->query("INSERT INTO supplier set $data");
			$save = $this->db->query("INSERT INTO supplier ($cols) VALUES ($vals)");
						
		}else{
			$save = $this->db->query("UPDATE supplier set $data where supplier_id = $id");
		}
		if($save)			
			return 1;	
}

function delete_supplier(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM supplier where supplier_id = ".$id);
		if($delete){
			return 1;
		}
	}




function new_employee(){
		extract($_POST);
		
		$data = " FullName = '".str_replace("'","&#x2019;",$FullName)."' ";
		$data .= ", Gender = '$Gender' ";
		$data .= ", DOB = '$DOB' ";
		$data .= ", Age = '$Age' ";
		$data .= ", Hometown= '$Hometown' ";		
		$data .= ", Nationality= '$Nationality' ";
		$data .= ", Phonenum= '$Phonenum' ";
		$data .= ", Mail= '$Mail' ";
		$data .= ", Address= '$Address' ";
		$data .= ", Address2= '$Address2' ";
		$data .= ", Status= '$Status' ";
		$data .= ", Department= '$Department' ";
		$data .= ", Lastschool= '$Lastschool' ";
		$data .= ", Qualification= '$Qualification' ";
		$data .= ", StartingDate= '$StartingDate' ";
		$data .= ", Employer= '$Employer' ";
		$data .= ", Language= '$Language' ";
		$data .= ", Religion= '$Religion' ";
		$cols = "FullName, Gender, DOB, Age, Hometown, Nationality, Phonenum, Mail, Address, Address2, Status, Department, Lastschool, Qualification, StartingDate, Employer, Language, Religion";
		$vals = "'".str_replace("'","&#x2019;",$FullName)."', '$Gender', '$DOB', '$Age', '$Hometown', '$Nationality', '$Phonenum', '$Mail', '$Address', '$Address2', '$Status', '$Department', '$Lastschool', '$Qualification', '$StartingDate', '$Employer', '$Language', '$Religion'";
		
		
		$emname = '';
		if($_FILES['img']['tmp_name'] != ''){
						$emname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../posnew/img/'. $emname);
		}
		
		$data .= ", picture = '$emname' ";
		$cols .= ", picture";
		$vals .= ", '$emname'";

		$check = $this->db->query("SELECT count(*) FROM newemployee where EmpID ='$EmpID' ".(!empty($EmpID) ? " and EmpID != {$EmpID} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}









		if(empty($EmpID)){
			//$save = $this->db->query("INSERT INTO newemployee set $data");
			$save = $this->db->query("INSERT INTO newemployee ($cols) VALUES ($vals)");

			}
			else{
			$save = $this->db->query("UPDATE newemployee set $data where EmpID = $EmpID");
		}


			if($save)			

			return 1;	
}

function delete_newemployee(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM newemployee where EmpID = ".$EmpID);
		if($delete){
			return 1;
		}
	}

function new_section(){
		extract($_POST);
		$data = "";
		$cols = array();
		$vals = array();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('sectinID')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
				$cols[] = $k;
				$vals[] = "'$v'";
			}
		}
		$check = $this->db->query("SELECT count(*) FROM section where sectionID ='$sectionID' ".(!empty($sectionID) ? " and sectionID != {$sectionID} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($sectionID)){
			//$save = $this->db->query("INSERT INTO section set $data");
			$save = $this->db->query("INSERT INTO section (".implode(',', $cols).") VALUES (".implode(',', $vals).")");
			}
			else{
			$save = $this->db->query("UPDATE section set $data where sectionID = $sectionID");
		}
			if($save)
			
			return 1;	
}

function delete_section(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM section where sectionID = ".$sectionID);
		if($delete){
			return 1;
		}
	}



function new_academic(){
		extract($_POST);
		$data = "";
		$cols = array();
		$vals = array();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('AcaID')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
				$cols[] = $k;
				$vals[] = "'$v'";
			}
		}
		$check = $this->db->query("SELECT count(*) FROM academiccalendar where AcaID ='$AcaID' ".(!empty($AcaID) ? " and AcaID != {$AcaID} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($AcaID)){
			//$save = $this->db->query("INSERT INTO academiccalendar set $data");
			$save = $this->db->query("INSERT INTO academiccalendar (".implode(',', $cols).") VALUES (".implode(',', $vals).")");
			}
			else{
			$save = $this->db->query("UPDATE academiccalendar set $data where AcaID = $AcaID");
		}
			if($save)
			
			return 1;	
}

function delete_academic(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM academiccalendar where AcaID = ".$AcaID);
		if($delete){
			return 1;
		}
	}









function save_supplierdeliver(){
		$id = "";
		extract($_POST);
		$data = "";
		$cols = array();
		$vals = array();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','sid','multtota','name','quantity','price','unit','expire_date','description','submit','button')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
					
				}else{
					$data .= ", $k='$v' ";
				}
				$cols[] = $k;
				$vals[] = "'$v'";
			}
		}
			
	$check = $this->db->query("SELECT count(*) FROM suppliercompany where id ='$id' ".(!empty($id) ? " and id != {$id} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			//$save = $this->db->query("INSERT INTO suppliercompany set $data");
			$save = $this->db->query("INSERT INTO suppliercompany (".implode(',', $cols).") VALUES (".implode(',', $vals).")");		
						
				if($save){
				$id = $this->db->lastInsertId();
				foreach($sid as $k =>$v){

					//$data = " supplierid = '$id' ";
					//$data .= ", name = '{$name[$k]}' ";
					//$data .= ", quantity = '{$quantity[$k]}' ";
					//$data .= ", price = '{$price[$k]}' ";
					//$data .= ", multtota = '{$multtota[$k]}' ";
					//$data .= ", unit = '{$unit[$k]}' ";
					//$data .= ", expire_date = '{$expire_date[$k]}' ";
					//$data .= ", description = '{$description[$k]}' ";
			//$save2[] = $this->db->query("INSERT INTO supplierdeliver set $data");
			$save2[] = $this->db->query("INSERT INTO supplierdeliver (supplierid, name, quantity, price, multtota, unit, expire_date, description) VALUES ('$id', '{$name[$k]}', '{$quantity[$k]}', '{$price[$k]}', '{$multtota[$k]}', '{$unit[$k]}', '{$expire_date[$k]}', '{$description[$k]}')");		}				
				
			//echo $save2;

				
			/*if($save){
				//$id = $this->db->insert_id;
				foreach($sid as $k =>$v){	
					$data = " supplierid = '$id' ";
					$data  .= ", name = '{$name[$k]}' ";
					$data .= ", quantity = '{$quantity[$k]}' ";
					$data .= ", price = '{$price[$k]}' ";
					$data .= ", multtota = '{$multtota[$k]}' ";
					$data .= ", unit = '{$unit[$k]}' ";
					$data .= ", expire_date = '{$expire_date[$k]}' ";
					$data .= ", description = '{$description[$k]}' ";
			$save3[] = $this->db->query("INSERT INTO warehouse set $data");				
				 
				
				}	
			
		}*/
/*				
$check1 = $this->db->query("SELECT * FROM  products where  product_name='$name' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check1 > 0){
			return 2;
			exit;
		}*/

			
			/*if(isset($save3[0])){
				$ids = $this->db->insert_id;				
				foreach($sid as $k =>$v){	
				    $data = " productID  = '$ids' ";
					$data .= ", product_name = '{$name[$k]}' ";
				//	$data .= ", quantity = '{$zero[$k]}' ";
					//$data .= ", price = '{$zero[$k]}' ";
					//$data .= ", multtota = '{$zero[$k]}' ";
					//$data .= ", unit = '{$zero[$k]}' ";
				//	$data .= ", expire_date = '{$zero[$k]}' ";
				//$data .= ", description = '{$zero[$k]}' ";
			$save4[] = $this->db->query("INSERT INTO products set $data");	}
*/
			
			if($save)					
				return 1;
		}
		}else{
		
			$save = $this->db->query("UPDATE suppliercompany set $data where id = $id");
			if($save){			
		$this->db->query("DELETE FROM supplierdeliver where supplierid = $id and id not in (".implode(',',$sid).") ");
				foreach($sid as $k =>$v){
					$data = " supplierid = '$id', name = '{$name[$k]}', quantity = '{$quantity[$k]}', price = '{$price[$k]}', multtota = '{$multtota[$k]}', unit = '{$unit[$k]}', description = '{$description[$k]}' ";
					if(empty($v)){
						//$save2[] = $this->db->query("INSERT INTO supplierdeliver set $data");
						$save2[] = $this->db->query("INSERT INTO supplierdeliver (supplierid, name, quantity, price, multtota, unit, description) VALUES ('$id', '{$name[$k]}', '{$quantity[$k]}', '{$price[$k]}', '{$multtota[$k]}', '{$unit[$k]}', '{$description[$k]}')");
					}else{
						$save2[] = $this->db->query("UPDATE supplierdeliver set $data where sid = $v"

					);						
					}
				}
				if(isset($save2))
						return 1;
			}
		}

	}



function save_supplierdeliverin() {
    extract($_POST);

    $data = " name = '" . str_replace("'", "&#x2019;", $companyName) . "' ";
    $data .= ", `description` = '$description' ";
    $cols = "name, description";
    $vals = "'" . str_replace("'", "&#x2019;", $companyName) . "', '$description'";

    // Handle existing images
    $existingImages = isset($existing_images) ? $existing_images : [];
    $imagePaths = $existingImages;

    // Handle new image uploads
    if (isset($_FILES['images'])) {
        $uploadDir = '../img/';
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $fileName = uniqid() . '_' . basename($_FILES['images']['name'][$key]);
                $targetFile = $uploadDir . $fileName;
                if (move_uploaded_file($tmpName, $targetFile)) {
                    $imagePaths[] = $fileName; // Store only the file name
                }
            }
        }
    }

    $imagePathString = implode(',', $imagePaths);
    // error_log("Image Path String: " . $imagePathString);
   //  var_dump("Image Path String: " . $imagePathString);
    $data .= ", `image` = '$imagePathString' ";
    $cols .= ", image";
    $vals .= ", '$imagePathString'";

    // Check if the record already exists
    $check = $this->db->query("SELECT count(*) FROM supplierdeliver WHERE sid = '$id' " . (!empty($id) ? " AND sid != {$id} " : ""))->fetchColumn();
    if ($check > 0) {
        return 2;
    }

    if (empty($id)) {
        //$save = $this->db->query("INSERT INTO supplierdeliver SET $data");
        $save = $this->db->query("INSERT INTO supplierdeliver ($cols) VALUES ($vals)");
    } else {
        $save = $this->db->query("UPDATE supplierdeliver SET $data WHERE sid = $id");
    }

    if ($save) {
        return 1;
    }
}












	function supplier_company(){
		extract($_POST);
		//$delete = $this->db->query("DELETE FROM suppliercompany where id=".$id);
		$delete2 = $this->db->query("DELETE FROM supplierdeliver where sid=".$id);
		if($delete2){
			return 1;
		}
	}

	function save_moneyin(){
		extract($_POST);
		$data = "";
		$cols = array();
		$vals = array();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','did','description','amount')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
					
				}else{
					$data .= ", $k='$v' ";
				}
				$cols[] = $k;
				$vals[] = "'$v'";
			}
		}
	$check = $this->db->query("SELECT count(*) FROM moneyin where name ='$name' and day='$day' and month='$month' and year='$year' ".(!empty($id) ? " and id != {$id} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}		
		if(empty($id)){
			//$save = $this->db->query("INSERT INTO moneyin set $data");
			$save = $this->db->query("INSERT INTO moneyin (".implode(',', $cols).") VALUES (".implode(',', $vals).")");
			if($save){
				$id = $this->db->lastInsertId();
				foreach($did as $k =>$v){
					//$data = " money_id = '$id' ";
					//$data .= ", description = '{$description[$k]}' ";
					//$data .= ", amount = '{$amount[$k]}' ";
					
					//$save2[] = $this->db->query("INSERT INTO moneyin_des set $data");
					$save2[] = $this->db->query("INSERT INTO moneyin_des (money_id, description, amount) VALUES ('$id', '{$description[$k]}', '{$amount[$k]}')");
				}
				if(isset($save2))
						return 1;
			}
		}

		else{
			$save = $this->db->query("UPDATE moneyin set $data where id = $id");
			if($save){
				$ids = array_filter($did);
				if(empty($ids)){
					$this->db->query("DELETE FROM moneyin_des where money_id = $id ");
				}else{
					$this->db->query("DELETE FROM moneyin_des where money_id = $id and did not in (".implode(',',$ids).") ");
				}
				foreach($did as $k =>$v){
					$data = " money_id = '$id', description = '{$description[$k]}', amount = '{$amount[$k]}' ";
					
					if(empty($v)){
						//$save2[] = $this->db->query("INSERT INTO moneyin_des set $data");
						$save2[] = $this->db->query("INSERT INTO moneyin_des (money_id, description, amount) VALUES ('$id', '{$description[$k]}', '{$amount[$k]}')");
					}else{
						$save2[] = $this->db->query("UPDATE moneyin_des set $data where did = $v");
					}
				}
				if(isset($save2))
						return 1;
			}
		}

	}
function delete_moneyin(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM moneyin where id=".$id);
		$delete2 = $this->db->query("DELETE FROM moneyin_des where money_id=".$id);
		if($delete && $delete2){
			return 1;
		}
	}




function save_moneyout(){
		extract($_POST);
		$data = "";
		$cols = array();
		$vals = array();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','did','description','amount')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
					
				}else{
					$data .= ", $k='$v' ";
				}
				$cols[] = $k;
				$vals[] = "'$v'";
			}
		}
	$check = $this->db->query("SELECT count(*) FROM moneyout where name ='$name' and day='$day' and month='$month' and year='$year' ".(!empty($id) ? " and id != {$id} " : ''))->fetchColumn();
		if($check > 0){
			return 2;
			exit;
		}		
		if(empty($id)){
			//$save = $this->db->query("INSERT INTO moneyout set $data");
			$save = $this->db->query("INSERT INTO moneyout (".implode(',', $cols).") VALUES (".implode(',', $vals).")");
			if($save){
				$id = $this->db->lastInsertId();
				foreach($did as $k =>$v){
					//$data = " money_id = '$id' ";
					//$data .= ", description = '{$description[$k]}' ";
					//$data .= ", amount = '{$amount[$k]}' ";
					
				//$save2[] = $this->db->query("INSERT INTO moneyout_des set $data");
				$save2[] = $this->db->query("INSERT INTO moneyout_des (money_id, description, amount) VALUES ('$id', '{$description[$k]}', '{$amount[$k]}')");
				
				}
				if(isset($save2))
						return 1;
			}
		}

		else{
			$save = $this->db->query("UPDATE moneyout set $data where id = $id");
			if($save){
				$ids = array_filter($did);
				if(empty($ids)){
					$this->db->query("DELETE FROM moneyout_des where money_id = $id ");
				}else{
					$this->db->query("DELETE FROM moneyout_des where money_id = $id and did not in (".implode(',',$ids).") ");
				}
				foreach($did as $k =>$v){
					$data = " money_id = '$id', description = '{$description[$k]}', amount = '{$amount[$k]}' ";
					
					if(empty($v)){
						//$save2[] = $this->db->query("INSERT INTO moneyout_des set $data");
						$save2[] = $this->db->query("INSERT INTO moneyout_des (money_id, description, amount) VALUES ('$id', '{$description[$k]}', '{$amount[$k]}')");
					}else{
						$save2[] = $this->db->query("UPDATE moneyout_des set $data where did = $v");
					}
				}
				if(isset($save2))
						return 1;
			}
		}

	}
function delete_moneyout(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM moneyout where id=".$id);
		$delete2 = $this->db->query("DELETE FROM moneyout_des where money_id=".$id);
		if($delete && $delete2){
			return 1;
		}
	}



function save_comments(){
		extract($_POST);
		
		$data = " uid = '$uid' ";
		$data .= ", mgs = '$mgs' ";
		$data .= ", rpl = '$rpl' ";
		$data .= ", day = '$day' ";
		$data .= ", month = '$month' ";
		$data .= ", year = '$year' ";
		$cols = "uid, mgs, rpl, day, month, year";
		$vals = "'$uid', '$mgs', '$rpl', '$day', '$month', '$year'";

		$check1 = $this->db->query("SELECT count(*) FROM comments where uid ='$uid' and day ='$day' and month ='$month' and year ='$year'    ".(!empty($id) ? " and id != {$id} " : ''))->fetchColumn();
		if($check1 > 0){
			return 2;
			exit;
		}

		if(empty($id)){
			//$save = $this->db->query("INSERT INTO comments set $data");
			$save = $this->db->query("INSERT INTO comments ($cols) VALUES ($vals)");
						
		}else{
			$save = $this->db->query("UPDATE comments set $data where id = $id");
		}
		if($save)			
			return 1;	
}




	function delete_comments(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM comments where id = ".$id);
		if($delete){
			return 1;
		}
	}










function save_gnotestudent(){
		extract($_POST);
		$data = " aboutcontent = '".str_replace("'","&#x2019;",$aboutcontent)."' ";

		if(empty($id)){
			//$save = $this->db->query("INSERT INTO gnotestudent set $data");
			$save = $this->db->query("INSERT INTO gnotestudent (aboutcontent) VALUES ('".str_replace("'","&#x2019;",$aboutcontent)."')");
						
		}else{
			$save = $this->db->query("UPDATE gnotestudent set $data where id = $id");
		}
		


		if($save)
			return 1;
			}
	

function productedit(){

$product_no = $_POST["product_no"];
$text = $_POST["text"];
$column_name = $_POST["column_name"];

  
 $sql = $this->db->query("UPDATE products SET ".$column_name."='".$text."' WHERE product_no='".$product_no."'");  
 if($sql)  
 {  
      echo 'Data Updated';  
 } 
}


function productinsert(){ 

$proinsert = $this->db->query("INSERT INTO products (product_no, product_name, sell_price, quantity, unit, min_stocks, remarks, location, images) VALUES('".$_POST["product_no"]."',  '".$_POST["product_name"]."', '".$_POST['sell_price']."', '".$_POST['quantity']."', '".$_POST['unit']."', '".$_POST['min_stocks']."', '".$_POST['remarks']."', '".$_POST['location']."', '".$_POST['images']."')");
if($proinsert)
{
    echo 'Data Inserted';
}


}











function save_gnoteteacher(){
		extract($_POST);
		$data = " abouttcontent = '".str_replace("'","&#x2019;",$abouttcontent)."' ";

		if(empty($id)){
			//$save = $this->db->query("INSERT INTO gnoteteacher set $data");
			$save = $this->db->query("INSERT INTO gnoteteacher (abouttcontent) VALUES ('".str_replace("'","&#x2019;",$abouttcontent)."')");
						
		}else{
			$save = $this->db->query("UPDATE gnoteteacher set $data where id = $id");
		}
		


		if($save)
			return 1;
			}


function save_sale(){
		extract($_POST);
		$reciept = array();
		//$products = $_POST['barcode'];
		$data = "";
		$cols = array();
		$vals = array();
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','sid','barcode','product','price','unit','qty','subtotal')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
					
				}else{
					$data .= ", $k='$v' ";
				}
				$cols[] = $k;
				$vals[] = "'$v'";
			}
		}
	
		if(empty($id)){
			//$save = $this->db->query("INSERT INTO customersale set $data");
			$save = $this->db->query("INSERT INTO customersale (".implode(',', $cols).") VALUES (".implode(',', $vals).")");
			if($save){
				$id = $this->db->lastInsertId();
				
				//$id = $this->db->insert_id;
				foreach($sid as $k =>$v){
					//$data = " salecustomerid = '$id' ";
					//$data .= ",  barcode= '{$barcode[$k]}' ";
					//$data .= ", product = '{$product[$k]}' ";
					//$data .= ", price = '{$price[$k]}' ";
					//$data .= ", unit = '{$unit[$k]}' ";
					//$data .= ", qty = '{$qty[$k]}' ";
					//$data .= ", subtotal = '{$subtotal[$k]}' ";
			//$save2[] = $this->db->query("INSERT INTO salecustomeriterm set $data");
			$save2[] = $this->db->query("INSERT INTO salecustomeriterm (salecustomerid, barcode, product, price, unit, qty, subtotal) VALUES ('$id', '{$barcode[$k]}', '{$product[$k]}', '{$price[$k]}', '{$unit[$k]}', '{$qty[$k]}', '{$subtotal[$k]}')");
				
			}

				
				
			if($save2 == TRUE){

				$select = $this->db->query("SELECT salecustomerid FROM salecustomeriterm ORDER BY salecustomerid DESC LIMIT 1");
				//$res = mysqli_query($this->db,$select);
				$ssid = $select->fetch(PDO::FETCH_NUM);
				
				for($i = 0;  $i < count($barcode); $i++){
				$reciept[] = isset($ssid[0]);
			     }
				
					}

				
				
				echo $ssid[0];
			   for($num=0; $num<count($barcode); $num++){
				$product_id = $barcode[$num];
				$qtyold = $qty[$num];

				$sql1 = $this->db->query("SELECT quantity FROM products WHERE product_no='$product_id'");
				//$result1 = $this->db->query($sql1);
				$qty = $sql1->fetch(PDO::FETCH_ASSOC);

				$newqty = $qty['quantity'] - $qtyold;

				$sql2 = $this->db->query("UPDATE products SET quantity=$newqty WHERE product_no='$product_id'");
				//$result2 = mysqli_query($conn, $sql2);

			}


			if ($save2)
				echo $product_id;



				/*if(isset($reciept))
					return $reciept;*/
				}








			}
		}

function delete_erdeliver(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM supplierdeliver where sid = ".$sid);
		if($delete){
			return 1;
		}
	}



function new_warehouse(){
		extract($_POST);
		
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", supplierid = '$companynameid ' ";
		$data .= ", quantity = '$quantity' ";
		$data .= ", price = '$price' ";
		$data .= ", multtota = '$multtota' ";
		$data .= ", unit = '$unit' ";
		$data .= ", description = '$description' ";
		$data .= ", expire_date = '$expire_date' ";
		$cols = "name, supplierid, quantity, price, multtota, unit, description, expire_date";
		$vals = "'".str_replace("'","&#x2019;",$name)."', '$companynameid', '$quantity', '$price', '$multtota', '$unit', '$description', '$expire_date'";
		
		
	
		if($_FILES['img']['tmp_name'] != ''){
						$picture = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../posnew/img/'. $picture);
					$data .= ", picture = '$picture' ";
					$cols .= ", picture";
					$vals .= ", '$picture'";

					

		}

		

	$check = $this->db->query("SELECT * FROM warehouse where name ='$name' and unit ='$unit' and quantity ='$quantity' and expire_date ='$expire_date' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}		



		if(empty($sid)){
			//$save = $this->db->query("INSERT INTO warehouse set $data");
			$save = $this->db->query("INSERT INTO warehouse ($cols) VALUES ($vals)");
			$idd = $this->db->lastInsertId();

			extract($_POST);
		$dataa  = " product_no = '$idd' ";
		$dataa .= ", product_name = '".str_replace("'","&#x2019;",$name)."' ";
		//$dataa .= ", product_no = '0' ";
		$colsa = "product_no, product_name";
		$valsa = "'$idd', '".str_replace("'","&#x2019;",$name)."'";
		
		
		

			//$save = $this->db->query("INSERT INTO products set $dataa");
			$save = $this->db->query("INSERT INTO products ($colsa) VALUES ($valsa)");

		}else{
			$save = $this->db->query("UPDATE warehouse set $data where sid = $sid");

			//extract($_POST);
		$check1 = $this->db->query("SELECT count(*) FROM products where product_name ='$name' and productID ='$idd' ".(!empty($sid) ? " " : ''))->fetchColumn();
		if($check1 > 0){
			return 1;
			exit;
		}

			extract($_POST);
		$dataa  = " productID = '$sid' ";
		$dataa .= ", product_name = '".str_replace("'","&#x2019;",$name)."' ";
		$dataa .= ", product_no = '0' ";	
		$colsa = "productID, product_name, product_no";
		$valsa = "'$sid', '".str_replace("'","&#x2019;",$name)."', '0'";
		

			//$save = $this->db->query("INSERT INTO products set $dataa");
			$save = $this->db->query("INSERT INTO products ($colsa) VALUES ($valsa)");





		}
		if($save)			
			return 1;	
}

function delete_warehouse(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM warehouse where sid = ".$sid);
		if($delete){
			return 1;
		}
	}



function new_note(){
		extract($_POST);
		
		$data = " title  = '".str_replace("'","&#x2019;",$title)."' ";
		$data .= ", notee = '$notee' ";
		$cols = "title, notee";
		$vals = "'".str_replace("'","&#x2019;",$title)."', '$notee'";
		
		
		
		

		if(empty($id)){
			//$save = $this->db->query("INSERT INTO note set $data");
			$save = $this->db->query("INSERT INTO note ($cols) VALUES ($vals)");
						
		}else{
			$save = $this->db->query("UPDATE note set $data where id = $id");
		}
		if($save)			
			return 1;	
}

function delete_note(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM note  where id = ".$id);
		if($delete){
			return 1;
		}
	}









		
		
	}


	
//}


/*
if($save)
				return json_encode(array('id'=>$id, 'status'=>1));


		foreach($_POST as $k => $v){
			if(!in_array($k, array('studentID')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";					
					
			}
			}
		}*/
		/*$check = $this->db->query("SELECT * FROM class where classID ='$classID' ".(!empty($classID) ? " and classID != {$classID} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}*/