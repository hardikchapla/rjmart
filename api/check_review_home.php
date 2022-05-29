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
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$order_details = $db->query("SELECT a.id as order_id,a.created as orderdt,a.*,b.* FROM product_order a,user_address b WHERE a.user_address_id = b.id AND a.user_id = '$user_id' AND order_status = 2 ORDER BY order_id DESC LIMIT 0,1");
			if($order_details->rowCount() > 0){
				$feorder = $order_details->fetch();
				$path = 'http://'.$_SERVER['SERVER_NAME'].'/assets/img/product/';
				$aa = array();
				$order_id = $feorder['order_id'];
				$aa['order_id'] = $feorder['order_id'];
				$aa['order_number'] = $feorder['order_number'];
				$aa['user_id'] = $feorder['user_id'];
				$aa['user_address_id'] = $feorder['user_address_id'];
				$aa['total_amount'] = $feorder['total_amount'];
				$aa['payment_type'] = $feorder['payment_type'];
				$aa['order_status'] = $feorder['order_status'];
				$aa['full_name'] = $feorder['full_name'];
				$aa['mobile_number'] = $feorder['mobile_number'];
				$aa['alt_mobile_number'] = $feorder['alt_mobile_number'];
				$aa['house_no'] = $feorder['house_no'];
				$aa['building_name'] = $feorder['building_name'];
				$aa['main_area'] = $feorder['main_area'];
				$aa['landmark'] = $feorder['landmark'];
				$aa['city'] = $feorder['city'];
				$aa['state'] = $feorder['state'];
				$aa['address'] = $feorder['address'];
				$aa['pincode'] = $feorder['pincode'];
				$aa['is_review'] = $feorder['is_review'];
                $aa['delivery_date'] = ($feorder['order_date']) ? $feorder['order_date']:'';
                $aa['order_date'] = ($feorder['orderdt']) ? $feorder['orderdt']:'';
				$order_items = $db->query("SELECT a.*,b.*,c.* FROM order_items a, product b,product_type c WHERE a.product_id = b.id AND a.product_type_id = c.product_type_id AND a.order_id = '$order_id'");
				$bb = array();
				$b = 0;
				if($order_items->rowCount() > 0){
					while ($feitems = $order_items->fetch()) {
						$bb[$b]['order_items_id'] = $feitems['order_items_id'];
						$bb[$b]['order_id'] = $feitems['order_id'];
						$bb[$b]['product_id'] = $feitems['product_id'];
						$bb[$b]['product_type_id'] = $feitems['product_type_id'];
						$bb[$b]['qty'] = $feitems['qty'];
						$bb[$b]['name'] = $feitems['name'];
						$bb[$b]['description'] = $feitems['description'];
						$bb[$b]['offer'] = $feitems['offer'];
						$bb[$b]['product_type'] = $feitems['product_type'];
						$bb[$b]['Product_qty'] = $feitems['Product_qty'];
						$bb[$b]['product_type_price'] = $feitems['product_type_price'];
						$images = $db->query("SELECT * FROM product_image WHERE p_id = '".$feitems['product_id']."' LIMIT 0,1");
						if($images->rowCount() > 0){
							$feimages = $images->fetch();
							$bb[$b]['images'] = $path.$feimages['image'];
						} else {
							$bb[$b]['images'] = '';
						}
						$b++;
					}
				}
				$aa['order_items'] = $bb;

				$status = 1;
				$message = "Check order review";
				$data = $aa;
			} else {
				$status = 0;
				$message = "You have no orders";
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