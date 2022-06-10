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
 		$getCount = $db->query("SELECT COUNT(id) as cartCount FROM cart WHERE user_id = '$user_id'");
        $feCount = $getCount->fetch();
        if($feCount['cartCount'] == 0){
            $data['cart_count'] = 0;
        }else{
            $data['cart_count'] = $feCount['cartCount'];
        }
        $message = "total cart item";
	}
	$response['message'] = $message;
	$response['data'] = $data;
	echo json_encode($response);
	die;
?>