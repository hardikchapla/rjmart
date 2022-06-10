<?php
	include "../connection/connection.php";
	include "../helper/constant.php";
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
            $message = "You can cancel your order";
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