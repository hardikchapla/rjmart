<?php
	include "../connection/connection.php";
    include "../helper/core_function.php";
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
 		if(empty($_REQUEST['order_number'])){
 			$status = 2;
			$message = "Please enter order_number";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['otp'])){
 			$status = 2;
			$message = "Please enter otp";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$order_number = $_REQUEST['order_number'];
 		$otp = $_REQUEST['otp'];
 		$created = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id' AND user_type = 1");
 		if($checkmobile->rowCount() > 0){
			$check = $db->query("SELECT * FROM product_order WHERE order_number = '$order_number' AND receive_otp = '$otp'");
			if($check->rowCount() > 0){
				$fecheck = $check->fetch();
				if($fecheck['order_status'] == 2){
					$status = 0;
					$message = "This order already completed";
					$data = array();
				} elseif ($fecheck['receive_otp'] == '') {
					$status = 0;
					$message = "This order is not shipped";
					$data = array();
				} else {
					if($fecheck['order_status'] == 4){
					    $order_id = $fecheck['id'];
						$update = $db->query("UPDATE product_order SET order_status = 2 WHERE order_number = '$order_number'");
						$user_update = $db->query("UPDATE user SET active = 1 WHERE id = '$user_id'");
	                    $notification = $db->query("INSERT INTO notification SET sender_id = '$user_id',order_id = '$order_id', title = 'Order completed', message = 'Order completed successfully', `type` = 'order_shipped', receiver_type = '1', created = '$created'");
						if($update && $user_update){
						    $order_user = $fecheck['user_id'];
						    $user = $db->query("SELECT * FROM user WHERE id = '$order_user'");
						    $feuser = $user->fetch();
	                        $title = "Order completed";
	                        $data2 = array();
	                        $data2['message'] = "Order completed successfully";
	                        sendPushNotification($feuser['device_token'],$title,$feuser['device_type'],$data2);
	                        sendsms($feuser['mobile'],"Delivered : Your order for Gujarat Fruits & Vegetables order ID ".$order_number." has been delivered.");
							$status = 1;
							$message = "Order completed successfully";
							$data = array();
						} else {
							$status = 0;
							$message = "Order is not completed";
							$data = array();
						}
					} else {
						$status = 0;
						$message = "This order is not shipped";
						$data = array();
					}	
				}
			} else {
				$status = 0;
				$message = "Please enter valid OTP";
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