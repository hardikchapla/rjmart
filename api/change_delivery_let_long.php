<?php
	include "../connection/connection.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();

	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['user_id'])){
 			$status = 2;
			$message = "Please enter user_id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['latitude'])){
 			$status = 2;
			$message = "Please enter latitude";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['longitude'])){
 			$status = 2;
			$message = "Please enter longitude";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$latitude = $_REQUEST['latitude'];
 		$longitude = $_REQUEST['longitude'];
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id' AND user_type = 1");
 		if($checkmobile->rowCount() > 0){
 			$update = $db->query("UPDATE user SET latitude = '$latitude', longitude = '$longitude' WHERE id = '$user_id'");
 			if($update){
 				$status = 1;
				$message = "Lat long change successfully";
				$data = array();
 			} else {
 				$status = 0;
				$message = "Lat long not change";
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