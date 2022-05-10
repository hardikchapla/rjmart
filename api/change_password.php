<?php
	include "../connection/connection.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();

	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['mobile'])){
 			$status = 2;
			$message = "Please enter mobile number";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
        if(empty($_REQUEST['new_password'])){
			$status = 2;
		   $message = "Please enter password";
		   $data = array();
		   $response['status'] = $status;
		   $response['message'] = $message;
		   $response['data'] = $data;
		   echo json_encode($response);
		   die;
		}
 		$mobile = $_REQUEST['mobile'];
 		$password = md5($_REQUEST['new_password']);
 		$checkmobile = $db->query("SELECT * FROM user WHERE mobile = '$mobile'");
 		if($checkmobile->rowCount() > 0){
             $update = $db->query("UPDATE user SET password = '$password' WHERE mobile = '$mobile'");
             if($update){
                $status = 1;
                $message = "Password updated successfully";
                $data = array();
             } else {
                $status = 0;
                $message = "Something want wrong. Please try again";
                $data = array();
             }
 		} else {
            $status = 0;
            $message = "Please enter valid mobile or password";
            $data = array();
        }
	} else {
		$status = 0;
		$message = "Please enter field values";
		$data = array();
	}
	$response['status'] = $status;
	$response['message'] = $message;
	$response['data'] = $data;
	echo json_encode($response);
	die;
?>