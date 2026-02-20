<?php
ob_start();
$action = $_GET['action'];
include 'easoftsql.php';
$crud = new Action();


if($action == "save_course"){
	$save = $crud->save_course();
	if($save)
		echo $save;
}
if($action == "delete_supplier"){
	$delete = $crud->delete_supplier();
	if($delete)
		echo $delete;
}

if($action == "supplier_company"){
	$delete = $crud->supplier_company();
	if($delete)
		echo $delete;
}

if($action == "save_supplierdeliver"){
	$save = $crud->save_supplierdeliver();
	if($save)
		echo $save;
}

if($action == "save_supplierdeliverin"){
	$save = $crud->save_supplierdeliverin();
	if($save)
		echo $save;
}




if($action == "save_emma"){
	$save = $crud->save_emma();
	if($save)
		echo $save;
}

if($action == "delete_emma"){
	$delete = $crud->delete_emma();
	if($delete)
		echo $delete;
}

if($action == "save_paymentsupplier"){
	$save = $crud->save_paymentsupplier();
	if($save)
		echo $save;
}
if($action == "delete_paymentsupplier"){
	$delete = $crud->delete_paymentsupplier();
	if($delete)
		echo $delete;
}

if($action == "save_overallpaymen"){
	$save = $crud->save_overallpaymen();
	if($save)
		echo $save;

}

if($action == "save_overallpaymen"){
	$delete = $crud->save_overallpaymen();
	if($delete)
		echo $delete;
}

if($action == "delete_student"){
	$delete = $crud->delete_student();
	if($delete)
		echo $delete;
}
if($action == "save_fees"){
	$save = $crud->save_fees();
	if($save)
		echo $save;
}
if($action == "delete_fees"){
	$delete = $crud->delete_fees();
	if($delete)
		echo $delete;
}
if($action == "save_paypayment"){
	$save = $crud->save_paypayment();
	if($save)
		echo $save;
}
if($action == "delete_paypayment"){
	$delete = $crud->delete_payment();
	if($delete)
		echo $delete;

}

if($action == "new_class"){
	$save = $crud->new_class();
	if($save)
		echo $save;
}

if($action == "eml_Payment"){
	$save = $crud->eml_Payment();
	if($save)
		echo $save;
}

if($action == "new_customer"){
	$save = $crud->new_customer();
	if($save)
		echo $save;
}

if($action == "new_supplier"){
	$save = $crud->new_supplier();
	if($save)
		echo $save;
}

if($action == "delete_newemployee"){
	$delete = $crud->delete_newemployee();
	if($delete)
		echo $delete;
}

if($action == "delete_erdeliver"){
	$delete = $crud->delete_erdeliver();
	if($delete)
		echo $delete;
}

if($action == "new_section"){
	$save = $crud->new_section();
	if($save)
		echo $save;
}
if($action == "delete_section"){
	$delete = $crud->delete_section();
	if($delete)
		echo $delete;
}


if($action == "new_academic"){
	$save = $crud->new_academic();
	if($save)
		echo $save;
}

if($action == "delete_newstudent"){
	$delete = $crud->delete_newstudent();
	if($delete)
		echo $delete;
}

if($action == "delete_class"){
	$delete = $crud->delete_class();
	if($delete)
		echo $delete; 
}

if($action == "save_examination"){
	$save = $crud->save_examination();
	if($save)
		echo $save; 
}

if($action == "delete_exam"){
	$delete = $crud->delete_exam();
	if($delete)
		echo $delete; 
}

if($action == "save_moneyin"){
	$save = $crud->save_moneyin();
	if($save)
		echo $save; 
}

if($action == "delete_moneyin"){
	$delete = $crud->delete_moneyin();
	if($delete)
		echo $delete; 
}

if($action == "save_moneyout"){
	$save = $crud->save_moneyout();
	if($save)
		echo $save; 
}

if($action == "new_employee"){
	$save = $crud->new_employee();
	if($save)
		echo $save;
}



if($action == "delete_moneyout"){
	$delete = $crud->delete_moneyout();
	if($delete)
		echo $delete; 
}

if($action == "delete_academic"){
	$delete = $crud->delete_academic();
	if($delete)
		echo $delete; 
}

	if($action == "login_user"){
	$save = $crud->login_user();
	if($save)
		echo $save; 
}

if($action == "delete_login"){
	$delete = $crud->delete_login();
	if($delete)
		echo $delete;
}

if($action == "delete_emlPayment"){
	$delete = $crud->delete_emlPayment();
	if($delete)
		echo $delete;
}


if($action == "save_comments"){
	$save = $crud->save_comments();
	if($save)
		echo $save; 
}

if($action == "save_gnotestudent"){
	$save = $crud->save_gnotestudent();
	if($save)
		echo $save; 
}

if($action == "save_gnoteteacher"){
	$save = $crud->save_gnoteteacher();
	if($save)
		echo $save; 
}

if($action == "delete_comments"){
	$delete = $crud->delete_comments();
	if($delete)
		echo $delete;
}

if($action == "delete_customer"){
	$delete = $crud->delete_customer();
	if($delete)
		echo $delete;
}

if($action == "productedit"){
	$save = $crud->productedit();
	if($save)
		echo $save; 
}


if($action == "productinsert"){
	$save = $crud->productinsert();
	if($save)
		echo $save; 
}


if($action == "new_warehouse"){
	$save = $crud->new_warehouse();
	if($save)
		echo $save;
}




if($action == "save_sale"){
	$save = $crud->save_sale();
	if($save)
		echo $save; 
}

if($action == "delete_warehouse"){
	$delete = $crud->delete_warehouse();
	if($delete)
		echo $delete;
}

if($action == "new_note"){
	$save = $crud->new_note();
	if($save)
		echo $save;
}
if($action == "delete_note"){
	$delete = $crud->delete_note();
	if($delete)
		echo $delete;
}


ob_end_flush();
?>