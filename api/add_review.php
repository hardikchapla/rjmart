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
 		if(empty($_REQUEST['order_id'])){
 			$status = 2;
			$message = "Please enter order_id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['review'])){
 			$status = 2;
			$message = "Please enter review";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['description'])){
 			$status = 2;
			$message = "Please enter description";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		
 		$user_id = $_REQUEST['user_id'];
 		$order_id = $_REQUEST['order_id'];
 		$review = $_REQUEST['review'];
 		$description = addslashes($_REQUEST['description']);
 		$created = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$check_order = $db->query("SELECT * FROM near_by_request WHERE from_id = '$user_id' AND order_id = '$order_id' AND status = 1");
 			if($check_order->rowCount() > 0){
 				$ferequest = $check_order->fetch();
 				$deliver_id = $ferequest['to_id'];

 				$insert = $db->query("INSERT INTO review SET order_id = '$order_id', user_id = '$user_id', deliver_id = '$deliver_id', review = '$review', description = '$description', created = '$created'");
 				$update = $db->query("UPDATE product_order SET is_review = 1 WHERE id = '$order_id'");
 				if($insert && $update){
 					$status = 1;
					$message = "Review inserted successfully";
					$data = array();
 				} else {
 					$status = 0;
					$message = "Review not inserted";
					$data = array();
 				}
 			} else {
 				$status = 0;
				$message = "Your order is not completed";
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