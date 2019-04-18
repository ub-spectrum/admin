<?php
include "adminViewModel.php"; 
session_start();
$stmt=new AdminModel();
if(isset($_POST['updateEmail']) and isset($_POST['updateRole']) and isset($_POST['updateFullname'])){
	$EMAIL=$_POST['updateEmail'];
	$FULL_NAME=$_POST['updateFullname'];
	$ROLE=$_POST['updateRole'];
	$Updated=$stmt->adminUpdate($EMAIL,$FULL_NAME,$ROLE);
    if($Updated==1){
   header('Location: ../userManagement.php');
  }
}


else if(isset($_GET['delete']) and ($_GET['delete']==true)){
$email=$_GET['EMAIL'];
//echo $email;
$deleted=$stmt->admindelete($email);
return $deleted;
}



else if(isset($_GET['approve']) and ($_GET['approve']==true)){
	$email=$_GET['email'];
	//echo $email;
	$approve=$stmt->adminApprove($email);
	if($approve==1){
		return $approve;
	}


}
else if(isset($_GET['reject']) and ($_GET['reject']==true)){
	$email=$_GET['email'];
	//echo $email;
	$reject=$stmt->adminReject($email);
if($reject==1){
	return $reject;
}

	
}





?>