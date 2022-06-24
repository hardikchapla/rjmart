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
			$message = "Please enter user_id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
			$path = BASE_URL.'assets/img/product/';
 			$checkcart = $db->query("SELECT a.id as cart_id,a.*,b.*,c.* FROM cart a, product b,product_type c WHERE a.p_id = b.id AND a.product_type_id = c.product_type_id AND a.user_id = '$user_id'");
 			if($checkcart->rowCount() > 0){
 				$aa = array();
 				$a = 0;
 				while ($fecheckcart = $checkcart->fetch()) {
 					$aa[$a]['cart_id'] = $fecheckcart['cart_id'];
 					$aa[$a]['user_id'] = $fecheckcart['user_id'];
 					$aa[$a]['product_id'] = $fecheckcart['product_id'];
 					$aa[$a]['product_type_id'] = $fecheckcart['product_type_id'];
 					$aa[$a]['name'] = $fecheckcart['name'];
 					$aa[$a]['description'] = $fecheckcart['description'];
 					$aa[$a]['offer'] = $fecheckcart['offer'];
 					$aa[$a]['qty'] = $fecheckcart['qty'];
 					$aa[$a]['product_type'] = $fecheckcart['Product_qty'].' '.$fecheckcart['product_type'];
 					$aa[$a]['Product_qty'] = $fecheckcart['Product_qty'];
 					$aa[$a]['product_type_price'] = $fecheckcart['product_type_price'];
 					$images = $db->query("SELECT * FROM product_image WHERE p_id = '".$fecheckcart['p_id']."'");
 					$bb = array();
 					$b = 0;
 					if($images->rowCount() > 0){
 						while($feimage = $images->fetch()){
 							$bb[$b]['image_id'] = $feimage['id'];
 							$bb[$b]['image'] = $path.$feimage['image'];
 							$b++;
 						}
 						$aa[$a]['images'] = $bb;
 					} else {
 						$aa[$a]['images'] = $bb;
 					}
 					$a++;
 				}
 				$status = 1;
				$message = "Cart list";
				$data = $aa;
 			} else {
 				$status = 0;
				$message = "Cart is empty";
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