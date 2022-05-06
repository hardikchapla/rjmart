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
 		if(!isset($_REQUEST['user_type'])){
 			$status = 2;
			$message = "Please enter user type";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$mobile = $_REQUEST['mobile'];
 		$user_type = $_REQUEST['user_type'];
 		$checkmobile = $db->query("SELECT * FROM user WHERE mobile = '$mobile'");
 		if($checkmobile->rowCount() > 0){
 			$userdata = $checkmobile->fetch();
 			$delevery_status = $userdata['status'];
 			$check_user_type = $userdata['user_type'];
 			if($user_type == $check_user_type){
 				if($delevery_status == 0){
 					$status = 0;
					$message = "Your profile is not approved";
					$data = array(
						"login_status" => 1,
						"delevery_status" => $delevery_status
					);
 				} else {
 					$status = 1;
					$message = "Check Status";
					$data = array(
						"login_status" => 1,
						"delevery_status" => $delevery_status
					);
 				}
 			} else {
 				$status = 0;
				$message = "Mobile already register";
				$data = array();
 			}
 		} else {
 			$status = 1;
			$message = "Check Status";
			$data = array(
				"login_status" => 0,
				"delevery_status" => 0
			);
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