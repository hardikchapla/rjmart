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
 		if(empty($_REQUEST['address_id'])){
 			$status = 2;
			$message = "Please enter address id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$address_id = $_REQUEST['address_id'];
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$checkaddress = $db->query("SELECT * FROM user_address WHERE id = '$address_id' AND user_id = '$user_id'");
 			if($checkaddress->rowCount() > 0){
 				$delete = $db->query("DELETE FROM user_address WHERE id = '$address_id'");
 				if($delete){
 					$status = 1;
					$message = "Address deleted successfully";
					$data = array();
 				} else {
 					$status = 0;
					$message = "Address not deleted";
					$data = array();
 				}
 			} else {
 				$status = 0;
				$message = "Address not availabile";
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