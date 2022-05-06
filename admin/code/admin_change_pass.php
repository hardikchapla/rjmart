<?php
	// session_start();
	include "../../connection/connection.php";
	$admin = $_SESSION['adminId'];
	$oldpass = md5($_REQUEST['old-password']);
	$New_pass = md5($_REQUEST['new-password']);
	$con_pass = md5($_REQUEST['confirm-password']);

	$query = $db->query("SELECT * from admin WHERE id ='$admin' AND password = '$oldpass'");
    $count = $query->rowCount();
    if($count > 0)
    {   
		if($New_pass != $con_pass)
		{
			$success['success'] = "not_match";
			$success['message'] = "Your password and confirmation password does not match";
		}
		else
		{
			$check = $db->query("UPDATE admin set password = '$New_pass' WHERE id = '$admin'");
			if($check)
			{
				$success['success'] = "success";
				$success['message'] = "Password Change Successfully";
			}
			else
			{
				$success['success'] = "error";
				$success['message'] = "Oops! Something went wrong!";
			}
		}
	}
	else
	{
		$success["success"] = "not_valid";
		$success['message'] = "The old password you have entered is incorrect";
	}
echo json_encode($success);
?>
