<?php
	// session_start();	
	include '../../connection/connection.php';
 	$username = $_REQUEST['username'];
 	$password = md5($_REQUEST['password']);
	$seladmin = $db->prepare("SELECT * FROM admin WHERE username ='$username' AND password ='$password'");
	$seladmin->execute();
	if($seladmin->rowCount() > 0)
	{
		$fetadmin = $seladmin->fetch(PDO::FETCH_ASSOC);
		$_SESSION['adminId']= $fetadmin['id'];
		$output['success'] = "success";
		$output['message'] = "Login Successfully";
	}
	else
	{
	  $output['success'] = "fail";
	  $output['message'] = "username or password is wrong!";
	}
	echo json_encode($output);
 ?>