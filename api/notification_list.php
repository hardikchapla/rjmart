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
 		$user_id = $_REQUEST['user_id'];
 		$created = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
			$order_details = $db->query("SELECT * FROM notification WHERE receiver_id = '$user_id' AND receiver_type = 0 ORDER BY created DESC");
			if($order_details->rowCount() > 0){
				$aa = array();
				$a = 0;
				while($feorder = $order_details->fetch()){
					$aa[$a]['id'] = $feorder['id'];
					$aa[$a]['order_id'] = $feorder['order_id'];
					$aa[$a]['title'] = $feorder['title'];
					$aa[$a]['message'] = $feorder['message'];
					$aa[$a]['type'] = $feorder['type'];
					$aa[$a]['created'] = $feorder['created'];
					$a++;
				}
				$status = 1;
				$message = "Request List";
				$data = $aa;
			} else {
				$status = 0;
				$message = "You have no request available";
				$data = $aa;
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