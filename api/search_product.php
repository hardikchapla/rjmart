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
 		if(empty($_REQUEST['search'])){
 			$status = 2;
			$message = "Please enter search";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['limit'])){
 			$status = 2;
			$message = "Please enter limit";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$search = $_REQUEST['search'];
 		$limit = $_REQUEST['limit'];
 		$start_count = $_REQUEST['start_count'];
 		$date = date('Y-m-d H:i:s');
 		$path = BASE_URL.'assets/img/product/';
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$cat = $db->query("SELECT * FROM product WHERE name LIKE '%$search%' AND is_active = 1 LIMIT $start_count, $limit");
 			if($cat->rowCount() > 0){
 				$aa = array();
 				$a = 0;
 				while ($fecat = $cat->fetch()) {
 					$aa[$a]['product_id'] = $fecat['id'];
 					$aa[$a]['name'] = $fecat['name'];
 					$aa[$a]['description'] = $fecat['description'];
 					$aa[$a]['offer'] = $fecat['offer'];
 					$aa[$a]['is_active'] = $fecat['is_active'];
 					$images = $db->query("SELECT * FROM product_image WHERE p_id = '".$fecat['id']."'");
 					$bb = array();
 					$b = 0;
 					if($images->rowCount() > 0){
 						while ($feimages = $images->fetch()) {
 							$bb[$b]['image_id'] = $feimages['id'];
 							$bb[$b]['product_image'] = $path.$feimages['image'];
 							$b++;
 						}
 					}
 					$aa[$a]['images'] = $bb;
 					$cc = array();
 					$c = 0;
 					$ptype = $db->query("SELECT * FROM product_type WHERE product_id = '".$fecat['id']."'");
 					if($ptype->rowCount() > 0){
 						while ($feptype = $ptype->fetch()) {
 							$cc[$c]['product_type_id'] = $feptype['product_type_id'];
 							$cc[$c]['product_type'] = $feptype['product_type'];
 							$cc[$c]['Product_qty'] = $feptype['Product_qty'];
							$cc[$c]['Product_type_qty'] = $feptype['Product_qty'].' '.$feptype['product_type'];
 							$cc[$c]['product_type_price'] = $feptype['product_type_price'];
 							$check_cart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND p_id = '".$fecat['id']."' AND product_type_id = '".$feptype['product_type_id']."'");
 							if($check_cart->rowCount() > 0){
 							    $fecart = $check_cart->fetch();
 							    $cc[$c]['is_cart'] = intval($fecart['qty']);
 							} else {
 							    $cc[$c]['is_cart'] = 0;
 							}
 							
 							$c++;
 						}
 					}
 					$aa[$a]['product_type'] = $cc;
 					$a++;
 				}
 				$status = 1;
				$message = "Product List";
				$data = $aa;
 			} else {
 				$status = 1;
				$message = "Product not available";
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