<?php
	include "../connection/connection.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();

	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['login_identifier'])){
 			$status = 2;
			$message = "Please enter login_identifier";
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
 		$login_identifier = $_REQUEST['login_identifier'];
 		$user_type = $_REQUEST['user_type'];
 		$checkmobile = $db->query("SELECT * FROM user WHERE login_identifier = '$login_identifier'");
 		if($checkmobile->rowCount() > 0){
 			$userdata = $checkmobile->fetch();
 			$check_user_type = $userdata['user_type'];
 			if($user_type == $check_user_type){
 				$status = 1;
				$message = "Check Status";
				$aa['id'] = $userdata['id'];
 				$aa['fullname'] = $userdata['fullname'];
 				$aa['email'] = $userdata['email'];
 				$aa['mobile'] = $userdata['mobile'];
 				$aa['dob'] = $userdata['dob'];
 				$aa['document'] = $avtar_path.$userdata['document'];
 				$aa['avatar'] = $avtar_path.$userdata['avatar'];
 				$aa['user_type'] = $userdata['user_type'];
 				$aa['login_type'] = $userdata['login_type'];
 				$aa['login_identifier'] = $userdata['login_identifier'];
 				$aa['device_type'] = $userdata['device_type'];
 				$aa['device_token'] = $userdata['device_token'];
 				$aa['latitude'] = $userdata['latitude'];
 				$aa['longitude'] = $userdata['longitude'];
 				$aa['delevery_status'] = $userdata['status'];
 				$aa['login_status'] = 1;
	 			$data = $aa;
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