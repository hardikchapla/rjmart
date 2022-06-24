<?php
	include "../connection/connection.php";
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
 		if(empty($_REQUEST['product_id'])){
 			$status = 2;
			$message = "Please enter product id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['product_type_id'])){
 			$status = 2;
			$message = "Please enter product type id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
		 if(empty($_REQUEST['quentity'])){
			$status = 2;
		   $message = "Please enter quentity";
		   $data = array();
		   $response['status'] = $status;
		   $response['message'] = $message;
		   $response['data'] = $data;
		   echo json_encode($response);
		   die;
		}
 		$user_id = $_REQUEST['user_id'];
 		$product_id = $_REQUEST['product_id'];
 		$product_type_id = $_REQUEST['product_type_id'];
 		$quentity = $_REQUEST['quentity'];
 		$date = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$checkcart = $db->query("SELECT * FROM cart WHERE `user_id` = '$user_id' AND p_id = '$product_id' AND product_type_id = '$product_type_id'");
 			if($checkcart->rowCount() > 0){
 				$fecart = $checkcart->fetch();
 				$cart_id = $fecart['id'];
				$newQTY = $fecart['qty'] + $quentity;
 				$update = $db->query("UPDATE cart SET qty = '$newQTY', updated = '$date' WHERE id = '$cart_id'");
 			} else {
 				$update = $db->query("INSERT INTO cart SET `user_id` = '$user_id', p_id = '$product_id', qty = '$quentity', product_type_id = '$product_type_id', created = '$date'");
 			}
 			if($update){
 				$status = 1;
				$message = "Add to cart successfully";
				$data = array();
 			} else {
 				$status = 0;
				$message = "Add to cart not successfully";
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