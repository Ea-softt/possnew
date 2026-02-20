<?php
session_start();
@ob_start();
include('server/config.php');

$username = "";
$password = "";
$row = "";

$meg = "";

if(isset($_POST["submit"]))
{

 $username = $_POST['username'];
 $password = $_POST['password'];
 $uid = $_POST['uid'];
 $std = "Student";
 $adm = "Admin";
 $tea = "Staff";







 $query_std = " select * from login where uid = '$uid' And username = '$username' And password = '".md5($password)."' And type ='$std'";

$run_std = mysqli_query($conn,$query_std);
$row = mysqli_fetch_assoc($run_std);




$query_adm = " select * from login where uid = '$uid' And username = '$username' And password = '".md5($password)."' And type ='$adm'";
$run_adm =mysqli_query($conn,$query_adm);
$row = mysqli_fetch_assoc($run_adm);




$query_tea = "select * from login where uid = '$uid' And username = '$username' And password = '".md5($password)."' And type ='$tea'";
$run_tea = mysqli_query($conn,$query_tea);
$row = mysqli_fetch_assoc($run_tea);



 $std = mysqli_num_rows($run_std);
 $adm = mysqli_num_rows($run_adm);
 $tea = mysqli_num_rows($run_tea);
 		

		if($std==1)
		{
			
			$_SESSION['password'] = $password;
			$_SESSION['username'] = $username;
			$_SESSION['uid'] = $uid;
			$_SESSION['LAST_ACTIVE_TIME'] = time();


		header('location:homepagestudent.php?error=correct username,password and type');

  
		}else if($adm==1)
		{	
			$_SESSION['password'] = $password;
			$_SESSION['username'] = $username;
			$_SESSION['uid'] = $uid;
			
			header('location:mainpage.php?error=correct username,password and type');

			
 
			}else if($tea==1)
			{
				

			$_SESSION['password'] = $password;
			$_SESSION['username'] = $username;
			$_SESSION['uid'] = $uid;
			$_SESSION['LAST_ACTIVE_TIME'] = time();
		header('location:homepageem.php?error=correct username,password and type'); 

 
		  }else{

		  	$_SESSION['meg'] = "Username Or password";
		  	header('location:login.php');

		  	
		  }

}else{
	
	

	
	
}
/*

 $result = mysqli_query($conn,$query);

 $num = mysqli_num_rows($result);
 if ($num == 1){
 	$_SESSION['username'] = $username;
 	
  header('location:../Pages/homepage.php?error=correct username,password and role');
 
 }else{
 	
  header('location:../Pages/Login.php?error=wrong username,password and role');
  
 }
*/
?>
