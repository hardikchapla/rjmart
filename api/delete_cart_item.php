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
 		if(empty($_REQUEST['cart_id'])){
 			$status = 2;
			$message = "Please enter cart_id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$cart_id = $_REQUEST['cart_id'];
 		$created = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$checkcart = $db->query("SELECT * FROM cart WHERE id = '$cart_id'");
 			if($checkcart->rowCount() > 0){
	 			$delete = $db->query("DELETE FROM cart WHERE id = '$cart_id'");
	 			if($delete){
	 				$status = 1;
					$message = "Your cart item removed";
					$data = array();
	 			} else {
	 				$status = 0;
					$message = "Cart item not removed";
					$data = array();
	 			}
	 		} else {
	 			$status = 0;
				$message = "Your cart wrong details";
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