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
 		if(empty($_REQUEST['request_id'])){
 			$status = 2;
			$message = "Please enter request_id";
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
 		if(empty($_REQUEST['request_status'])){
 			$status = 2;
			$message = "Please enter request_status";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$request_id = $_REQUEST['request_id'];
 		$order_id = $_REQUEST['order_id'];
 		$request_status = $_REQUEST['request_status'];
 		$created = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id' AND user_type = 1");
 		if($checkmobile->rowCount() > 0){
			$check = $db->query("SELECT * FROM near_by_request WHERE id = '$request_id' AND to_id = '$user_id' AND status = 0");
			if($check->rowCount() > 0){
				if($request_status == 1){
				    $fecheck = $check->fetch();
				    $from_id = $fecheck['from_id'];
				    $from = $db->query("SELECT * FROM user WHERE id = '$from_id'");
				    $fefrom = $from->fetch();

					$update = $db->query("UPDATE near_by_request SET status = 1 WHERE id = '$request_id'");
					$delete = $db->query("DELETE FROM near_by_request WHERE order_id = '$order_id' AND status = 0");
					$update_order = $db->query("UPDATE product_order SET order_status = 1 WHERE id = '$order_id'");
					$user_update = $db->query("UPDATE user SET active = 0 WHERE id = '$user_id'");
					if($update && $delete && $update_order){
					    $feget = $checkmobile->fetch();
                        $avtar_path = BASE_URL.'/assets/img/user/';
                        $aa['id'] = $feget['id'];
                        $aa['fullname'] = $feget['fullname'];
                        $aa['email'] = $feget['email'];
                        $aa['mobile'] = $feget['mobile'];
                        $aa['dob'] = $feget['dob'];
                        $aa['document'] = $avtar_path.$feget['document'];
                        $aa['avatar'] = $avtar_path.$feget['avatar'];
                        $aa['user_type'] = $feget['user_type'];
                        $aa['login_type'] = $feget['login_type'];
                        $aa['login_identifier'] = $feget['login_identifier'];
                        $aa['device_type'] = $feget['device_type'];
                        $aa['device_token'] = $feget['device_token'];
                        $aa['latitude'] = $feget['latitude'];
                        $aa['longitude'] = $feget['longitude'];
                        $aa['status'] = $feget['status'];
                        $aa['referral'] = $feget['referral'];
                        $title = "Request Accepted";
                        $data2 = array();
                        $data2['message'] = "Order request accepted successfully";
                        $data2['data'] = $aa;
						$notification1 = $db->query("INSERT INTO notification SET sender_id = '$user_id', receiver_id = '$from_id',order_id = '$order_id', title = 'Request Accepted', message = 'Your order request accepted successfully', `type` = 'order_accepted', receiver_type = '0', created = '$created'");
                        sendPushNotification($fefrom['device_token'],$title,$fefrom['device_type'],$data2);
                        $order = $db->query("SELECT * FROM product_order WHERE id = '$order_id'");
                        $feorder = $order->fetch();
                        // sendsms($fefrom['mobile'],"On the Way : Your order for Gujarat Fruits & Vegetables order ID ".$feorder['order_number']." has been on the way. You will receive another SMS when the product out to deliver it.");
						$status = 1;
						$message = "Request accepted successfully";
						$data = array();
					} else {
						$status = 0;
						$message = "Request not accepted";
						$data = array();
					}
				} elseif ($request_status == 2) {
					$delete = $db->query("DELETE FROM near_by_request WHERE id = '$request_id'");
					if($delete){
						$status = 1;
						$message = "Request rejected successfully";
						$data = array();
					} else {
						$status = 0;
						$message = "Request not rejected";
						$data = array();
					}
				} else {
					$status = 0;
					$message = "Please select valid request status";
					$data = array();
				}
			} else {
				$status = 0;
				$message = "Thare is no request available";
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