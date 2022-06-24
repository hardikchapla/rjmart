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
 		$created = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id' AND user_type = 1");
 		if($checkmobile->rowCount() > 0){
			$avtar_path = BASE_URL.'assets/img/user/';
			$order_details = $db->query("SELECT c.id as request_id,c.*, a.id as order_id,a.created as orderdt,a.*,b.* FROM near_by_request c, product_order a,user_address b WHERE c.order_id = a.id AND a.user_address_id = b.id AND c.to_id = '$user_id' AND c.status = 1 AND a.order_status = 2 ORDER BY c.created DESC");
			if($order_details->rowCount() > 0){
				$path = BASE_URL.'assets/img/product/';
				$aa = array();
				$a = 0;
				$feUser = $checkmobile->fetch();
				while($feorder = $order_details->fetch()){
					$order_id = $feorder['order_id'];
					$aa[$a]['request_id'] = $feorder['request_id'];
					$aa[$a]['order_id'] = $feorder['order_id'];
					$aa[$a]['order_number'] = $feorder['order_number'];
					$aa[$a]['user_id'] = $feorder['user_id'];
					$aa[$a]['user_address_id'] = $feorder['user_address_id'];
					$aa[$a]['total_amount'] = $feorder['total_amount'];
					$aa[$a]['payment_type'] = $feorder['payment_type'];
					$aa[$a]['order_status'] = $feorder['order_status'];
					$aa[$a]['cancel_status'] = $feorder['cancel_status'];
					$aa[$a]['full_name'] = $feorder['full_name'];
					$aa[$a]['mobile_number'] = $feorder['mobile_number'];
					$aa[$a]['alt_mobile_number'] = $feorder['alt_mobile_number'];
					$aa[$a]['house_no'] = $feorder['house_no'];
					$aa[$a]['floor_no'] = $feorder['floor_no'];
					$aa[$a]['tower_no'] = $feorder['tower_no'];
					$aa[$a]['building_name'] = $feorder['building_name'];
					$aa[$a]['main_area'] = $feorder['main_area'];
					$aa[$a]['landmark'] = $feorder['landmark'];
					$aa[$a]['city'] = $feorder['city'];
					$aa[$a]['google_auto_address'] = $feorder['google_auto_address'];
					$aa[$a]['pincode'] = $feorder['pincode'];
					$aa[$a]['latitude'] = $feorder['latitude'];
					$aa[$a]['longitude'] = $feorder['longitude'];
					$aa[$a]['delivery_type'] = $feorder['delivery_type'];
					if($feorder['delivery_type'] == 2){
						$aa[$a]['delivery_date'] = $feorder['delivery_date'];
						$aa[$a]['delivery_time'] = $feorder['delivery_time'];
					} else {
						$aa[$a]['delivery_date'] = ($feorder['order_date']) ? $feorder['order_date']:'';
						$aa[$a]['delivery_time'] = '';
					}
                    $aa[$a]['order_date'] = ($feorder['orderdt']) ? $feorder['orderdt']:'';
					if($feUser['avatar'] == ''){
						$aa[$a]['avatar'] = '';
					}else{
						$aa[$a]['avatar'] = $avtar_path.$feUser['avatar'];
					}
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
					$aa[$a]['order_items'] = $bb;
					$a++;
				}
				$status = 1;
				$message = "Complete order List";
				$data = $aa;
			} else {
				$status = 0;
				$message = "You have no order available";
				$data = $aa;
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