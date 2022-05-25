<?php
	include "../connection/connection.php";
    require_once("../libraries/paytm/PaytmChecksum.php");
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
 		if(empty($_REQUEST['order_id'])){
 			$status = 2;
			$message = "Please enter order_id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
		if(empty($_REQUEST['reason'])){
			$status = 2;
		   $message = "Please enter reason";
		   $data = array();
		   $response['status'] = $status;
		   $response['message'] = $message;
		   $response['data'] = $data;
		   echo json_encode($response);
		   die;
		}
 		$user_id = $_REQUEST['user_id'];
 		$order_id = $_REQUEST['order_id'];
 		$reason = $_REQUEST['reason'];
 		$created = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
			$admin = $db->query("SELECT * FROM admin WHERE id = 1");
			$feadmin = $admin->fetch();
			$cancel_time = $feadmin['cancel_time'];
 			$checkcart = $db->query("SELECT * FROM product_order WHERE id = '$order_id'");
 			if($checkcart->rowCount() > 0){
 			    $feorder = $checkcart->fetch();
				$order_created = $feorder['created'];
				$time = new DateTime($order_created);
				$diff = $time->diff(new DateTime($created));
				$minutes = ($diff->days * 24 * 60) +
						($diff->h * 60) + $diff->i;
				if($minutes <= $cancel_time){
					$order_status = $feorder['order_status'];
					if($feorder['order_status'] == '2'){
						$status = 0;
						$message = "You can not cancel your order because your order is shipped";
						$data = array();
					} else if($feorder['order_status'] == '3'){
						$status = 0;
						$message = "You can not cancel your order because your order is canceled";
						$data = array();
					} else {
						if($feorder['payment_type'] == 'paytm') {
							$payment = $db->query("SELECT * FROM payment WHERE order_id = '$order_id' AND user_id = '$user_id'");
							if ($payment->rowCount() > 0) {
								$cdate = date('Ymd');
								$REFUNDID = "REFUNDID" . rand(111, 999) . $cdate;
								$fepayment = $payment->fetch();

								$ON = $feorder['order_number'];
								$OFF = $fepayment['payment_identifier'];
								$paytmParams = array();
								$paytmParams["body"] = array(
									"mid" => "tHrtod31123741500604",
									"txnType" => "REFUND",
									"orderId" => $ON,
									"txnId" => $OFF,
									"refId" => $REFUNDID,
									"refundAmount" => number_format((float)$feorder['total_amount'], 2, '.', ''),
								);
								$paytmChecksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "mcwOj_bogaHTbfdu");

								$paytmParams["head"] = array(
									"signature" => $paytmChecksum
								);

								$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
								/* for Staging */
								$url = "https://securegw-stage.paytm.in/refund/apply";

								/* for Production */
								// $url = "https://securegw.paytm.in/refund/apply";

								$ch = curl_init($url);
								curl_setopt($ch, CURLOPT_POST, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
								$response1 = curl_exec($ch);
								$abc = json_decode($response1);
								if ($abc->body->resultInfo->resultCode == '10' || $abc->body->resultInfo->resultCode == '601') {
									$update = $db->query("UPDATE payment SET refId = '$REFUNDID' WHERE id = '" . $fepayment['id'] . "'");
								}
							}
						}
						$delete = $db->query("UPDATE product_order SET order_status = '3',cancel_status = '$order_status', reason = '$reason' WHERE id = '$order_id'");
						$notification = $db->query("INSERT INTO notification SET sender_id = '$user_id',order_id = '$order_id', title = 'Cancel Order', message = 'Order cancelled successfully', `type` = 'order_cancelled', receiver_type = '1', created = '$created'");
						if($delete){
							$status = 1;
							$message = "Your order cancel successfully";
							$data = array();
						} else {
							$status = 0;
							$message = "Your Order is not cancel. please try later";
							$data = array();
						}
					}
				} else {
					$status = 0;
					$message = "You cannot cancel an order. You can cancel the order within ".$cancel_time." minutes after placing your order";
					$data = array();
				}
	 		} else {
	 			$status = 0;
				$message = "Your cart wrong details";
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