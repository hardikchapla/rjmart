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
 		if(empty($_REQUEST['type'])){
 			$status = 2;
			$message = "Please enter type";
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
 		$type = $_REQUEST['type'];
 		$date = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$checkcart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND p_id = '$product_id' AND product_type_id = '$product_type_id'");
 			if($checkcart->rowCount() > 0){
 				$fecart = $checkcart->fetch();
 				$cart_id = $fecart['id'];
 				if($type == 'plus'){
 					$qty = $fecart['qty'] + 1;
 				} else {
 					$qty = $fecart['qty'] - 1;
 				}
 				if($qty == 0){
 					$update = $db->query("DELETE FROM cart WHERE id = '$cart_id'");
 					if($update){
		 				$status = 1;
						$message = "remove product from cart successfully";
						$data = array();
		 			} else {
		 				$status = 0;
						$message = "remove product from cart not successfully";
						$data = array();
		 			}
 				} else {
 					$update = $db->query("UPDATE cart SET qty = '$qty', updated = '$date' WHERE id = '$cart_id'");
 					if($update){
		 				$status = 1;
		 				if($type == 'plus'){
		 					$message = "add to cart successfully";
		 				} else {
							$message = "remove product from cart successfully";
						}
						$data = array();
		 			} else {
		 				$status = 0;
						$message = "add to cart not successfully";
						$data = array();
		 			}
 				}
 			} else {
 				if($type == 'plus'){
 					$update = $db->query("INSERT INTO cart SET user_id = '$user_id', p_id = '$product_id', qty = 1, product_type_id = '$product_type_id', created = '$date'");
 					if($update){
		 				$status = 1;
		 				$message = "add to cart successfully";
						$data = array();
		 			} else {
		 				$status = 0;
						$message = "add to cart not successfully";
						$data = array();
		 			}
 				} else {
 					$status = 0;
					$message = "Your product not available in cart";
					$data = array();
 				}
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