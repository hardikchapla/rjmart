<?php
	include "../connection/connection.php";
	include "../helper/constant.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();
	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['user_id'])){
 			$status = 2;
			$message = "Please enter user id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$date = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$cat = $db->query("SELECT * FROM pincode");
 			if($cat->rowCount() > 0){
 				$bb = array();
 				$aa = array();
 				$a = 0;
 				while ($fecat = $cat->fetch()) {
 					$aa[$a]['pincode_id'] = $fecat['id'];
 					$aa[$a]['pincode'] = $fecat['pincode'];
 					$a++;
 				}
 				$status = 1;
				$message = "Pincode List";
				$data = $aa;
 			} else {
 				$status = 1;
				$message = "Pincode not available";
				$data = array();
 			}
 		} else {
 			$status = 0;
			$message = "Please enter valid userid";
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