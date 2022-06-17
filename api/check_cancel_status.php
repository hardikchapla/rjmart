<?php
	include "../connection/connection.php";
	include "../helper/constant.php";
	include "../helper/core_function.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();
	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['order_id'])){
 			$status = 2;
			$message = "Please enter order id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$order_id = $_REQUEST['order_id'];
 		$getOrderId = $db->query("SELECT * FROM product_order WHERE id = '$order_id'");
        $feOrder = $getOrderId->fetch();
        $orderTime =  $feOrder['order_date'];
        $user_id =  $feOrder['user_id'];
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = date("Y-m-d H:i:s");

        $t1 = strtotime($orderTime);
        $t2 = strtotime($currentDateTime);
        $interval  = abs($t2 - $t1);
        $minutes   = round($interval / 60);
        
        $getAdminCancelTime = $db->query("SELECT * FROM `admin` WHERE id = '1'");
        $feCancelTime = $getAdminCancelTime->fetch();
        $cancelMinutes = $feCancelTime['cancel_time'];

        if($minutes <= $cancelMinutes ){
            $status = 1;
            $message = "Your order has been cancelled, you will get your refund within 48 hours";
            $updateStatus = $db->query("UPDATE product_order SET order_status = '3' WHERE id = '$order_id'");
			$notification = $db->query("INSERT INTO notification SET sender_id = '$user_id',order_id = '$order_id', title = 'Cancel Order', message = 'Your order has been cancelled, you will get your refund within 48 hours', `type` = 'order_cancelled', receiver_type = '1', created = '$created'");
			$admin = $db->query("SELECT * FROM `admin` WHERE id = 1");
        	$feadmin = $admin->fetch();
			$title1 = "Cancel Order";
			$data2 = array();
			$data2['message'] = "Your order has been cancelled, you will get your refund within 48 hours";
			$data2['data'] = array();
			sendPushNotificationAdmin($feadmin['device_token'], $title1, $feadmin['device_type'], $data2);
        }else{
            $status = 0;
            $message = "You cannot cancel an order. You can cancel the order within ".$cancelMinutes." minutes after placing your order";
        }
        
	}
    $response['status'] = $status;
	$response['message'] = $message;
	$response['data'] = $data;
	echo json_encode($response);
	die;
?>