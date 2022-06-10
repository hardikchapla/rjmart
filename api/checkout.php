<?php
	include "../connection/connection.php";
    include "../helper/constant.php";
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
 		if(empty($_REQUEST['user_address_id'])){
 			$status = 2;
			$message = "Please enter user_address_id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['total_amount'])){
 			$status = 2;
			$message = "Please enter total_amount";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['payment_type'])){
 			$status = 2;
			$message = "Please enter payment_type";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}/*
 		if(empty($_REQUEST['latitude'])){
 			$status = 2;
			$message = "Please enter latitude";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['longitude'])){
 			$status = 2;
			$message = "Please enter longitude";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}*/
 		$user_id = $_REQUEST['user_id'];
 		$user_address_id = $_REQUEST['user_address_id'];
 		$total_amount = $_REQUEST['total_amount'];
 		$payment_type = $_REQUEST['payment_type'];
 		$latitude = $_REQUEST['latitude'];
 		$longitude = $_REQUEST['longitude'];
 		$payment_identifier = (isset($_REQUEST['payment_identifier']) && $_REQUEST['payment_identifier'] != '') ? $_REQUEST['payment_identifier']:'';
 		$TXNDATE = (isset($_REQUEST['TXNDATE']) && $_REQUEST['TXNDATE'] != '') ? $_REQUEST['TXNDATE']:'';
 		$referral_amount = (isset($_REQUEST['referral_amount']) && $_REQUEST['referral_amount'] != '') ? $_REQUEST['referral_amount']:0;
 		$created = date('Y-m-d H:i:s');
        $order_date = date("Y-m-d H:i:s");
        $admin = $db->query("SELECT * FROM `admin` WHERE id = 1");
        $feadmin = $admin->fetch();
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$checkcart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id'");
 			if($checkcart->rowCount() > 0){
 				if(isset($_REQUEST['ORDER_ID']) && $_REQUEST['ORDER_ID'] != ''){
 					$order_number = $_REQUEST['ORDER_ID'];
 				} else {
 					$uniq = rand(11,99);
	 				$order_number = 'ORDER'.date('Ymdhis').$uniq;
 				}
                $feuser = $checkmobile->fetch();
                if($referral_amount > 0){
                    if($feuser['referral_amount'] >= $referral_amount){
                        $user_referral_amount = $feuser['referral_amount'] - $referral_amount;
                        $update_user = $db->query("UPDATE user SET referral_amount = '$user_referral_amount', referral_used = 1 WHERE id = '$user_id'");
                    } else {
                        $status = 0;
                        $message = "Please enter valid referral amount";
                        $data = array();
                        $response['status'] = $status;
                        $response['message'] = $message;
                        $response['data'] = $data;
                        echo json_encode($response);
                        die;
                    }
                }
                $order = $db->query("INSERT INTO product_order SET order_number = '$order_number', user_id = '$user_id', user_address_id = '$user_address_id', total_amount	 = '$total_amount', payment_type = '$payment_type', order_status = 0, created = '$created', order_date = '$order_date', referral_amount = '$referral_amount'");
                $order_id = $db->lastInsertId();

                $notification = $db->query("INSERT INTO notification SET sender_id = '$user_id',order_id = '$order_id', title = 'New Order', message = 'New order created successfully', `type` = 'new_order', receiver_type = '1', created = '$created'");
                $notification1 = $db->query("INSERT INTO notification SET receiver_id = '$user_id',order_id = '$order_id', title = 'New Order', message = 'New order created successfully', `type` = 'new_order', receiver_type = '0', created = '$created'");
                while ($fecheckcart = $checkcart->fetch()) {
                    $product_id = $fecheckcart['p_id'];
                    $qty = $fecheckcart['qty'];
                    $product_type_id = $fecheckcart['product_type_id'];
                    if($payment_type == 'cash'){
                        $payment_type_p = 0;
                    } else {
                        $payment_type_p = 1;
                    }
                    $order_items = $db->query("INSERT INTO order_items SET order_id = '$order_id', product_id = '$product_id', product_type_id = '$product_type_id', qty = '$qty', created = '$created'");
                    $delete_cart = $db->query("DELETE FROM cart WHERE user_id = '$user_id'");
                }

                $payment = $db->query("INSERT INTO payment SET user_id = '$user_id',order_id = '$order_id',status = 1, payment_identifier = '$payment_identifier',TXNDATE = '$TXNDATE',payment_type = '$payment_type_p', created = '$created'");


                $order_details = $db->query("SELECT a.created as orderdt,a.id as order_id,a.*,b.* FROM product_order a,user_address b WHERE a.user_address_id = b.id AND a.id = '$order_id'");
                $feorder = $order_details->fetch();
                $path = BASE_URL.'assets/img/product/';
                $aa = array();
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
                $aa['latitude'] = $feorder['latitude'];
                $aa['longitude'] = $feorder['longitude'];
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
                $aa['cancel_message'] = "You can cancel the order with in ".$feadmin['cancel_time']." Minutes";
                // $check_delivery = $db->query("select *, ( 3959 * acos ( cos ( radians(".$latitude.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$longitude.") ) + sin ( radians(".$latitude.") ) * sin( radians(latitude) ) ) ) AS `distance` from `user` WHERE user_type = 1 AND status = 1 AND active = 1 HAVING distance < 15 ORDER BY distance");
                // if($check_delivery->rowCount() > 0) {
                //     while ($fedelivery = $check_delivery->fetch()) {
                //         $delivery_boy = $fedelivery['id'];
                //         $del_latitude = $fedelivery['latitude'];
                //         $del_longitude = $fedelivery['longitude'];
                //         $title = "New Order Request";
                //         $data1 = array();
                //         $data1['message'] = "New order request by " . $feuser['fullname'];
                //         $data1['data'] = $aa;
                //         sendPushNotification($fedelivery['device_token'], $title, $fedelivery['device_type'], $data1);
                //         $insert = $db->query("INSERT INTO near_by_request SET from_id = '$user_id', to_id = '$delivery_boy', status = 0, order_id = '$order_id', created = '$order_date'");
                //     }
                // }
                if($order){
                    $title = "New Order";
                    $data2 = array();
                    $data2['message'] = "Order request sent successfully";
                    sendPushNotification($feuser['device_token'],$title,$feuser['device_type'],$data2);
                    // sendsms($feuser['mobile'],"Packed : Your order for Gujarat Fruits & Vegetables order ID ".$feorder['order_number']." has been packed by the seller and will be shipped soon.");

                    $status = 1;
                    $message = "Order Placed successfully";
                    $data = $aa;
                } else {
                    $status = 0;
                    $message = "Order Not placed please try again";
                    $data = array();
                }
	 		} else {
	 			$status = 0;
				$message = "Your Cart is empty";
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