<?php
include '../../connection/connection.php';
 	$Email = $_REQUEST['Email'];
 	$Password = $_REQUEST['Password'];
 	$New_Password = md5($_REQUEST['New_Password']);
 	$confirm_password = md5($_REQUEST['confirm_password']);

 	if($New_Password != $confirm_password)
 	{
 		$output['success'] = "fail";
		$output['message'] = "New Password And confirm_password are Not Same";
 	}
 	else
 	{
		$seladmin = $db->query("SELECT * FROM admin WHERE email = '$Email' AND password = '$Password'");
		if($seladmin->rowCount() > 0)
		{
			$update = $db->query("UPDATE admin SET password = '$New_Password' WHERE email = '$Email'");
			if($update)
			{
				$output['success'] = "success";
				$output['message'] = "Your Password Change successfully";
			}
			else
			{
				$output['success'] = "fail";
				$output['message'] = "Something wonts to wrong with Ajax";
			}
		}
		else
		{
		  $output['success'] = "fail";
		  $output['message'] = "Your Link has been expired";
		}
	}
echo json_encode($output);
 ?>