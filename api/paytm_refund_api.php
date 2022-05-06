<?php
	include "../connection/connection.php";
/*	require_once("encdec_paytm.php");*/
	require_once("../libraries/paytm_new/PaytmChecksum.php");
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
 		$user_id = $_REQUEST['user_id'];
 		$order_id = $_REQUEST['order_id'];
 		$created = date('Y-m-d H:i:s');
        $order_date = date("Y-m-d H:i:s", strtotime("+1 hours"));
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$order = $db->query("SELECT * FROM product_order WHERE id = '$order_id'");
 			if($order->rowCount() > 0){
 				$feorder = $order->fetch();
 				$payment = $db->query("SELECT * FROM payment WHERE order_id = '$order_id' AND user_id = '$user_id'");
 				if($payment->rowCount() > 0){

 					$cdate = date('Ymd');
 					$REFUNDID = "REFUNDID".rand(111,999).$cdate;
                    $fepayment = $payment->fetch();

 					$ON = $feorder['order_number'];
 					$OFF = $fepayment['payment_identifier'];
 					$paytmParams = array();
					$paytmParams["body"] = array(
					    "mid"          => "tHrtod31123741500604",
					    "txnType"      => "REFUND",
					    "orderId"      => $ON,
					    "txnId"        => $OFF,
					    "refId"        => $REFUNDID,
					    "refundAmount" => number_format((float)$feorder['total_amount'], 2, '.', ''),
					);
					/*$paytmParams = array();*/

					/*$paytmParams["MID"] = "fFHFlo49041275153521";
					$paytmParams["ORDERID"] = "ORDER2020070305142092";
					$paytmParams["txnId"] = "20200703111212800110168579601698429";
					$paytmParams["refId"] = $REFUNDID;
					$paytmParams["txnType"] = "REFUND";
					$paytmParams["refundAmount"] = number_format((float)$feorder['total_amount'], 2, '.', '');*/
					/*$paytmChecksum = PaytmChecksum::generateSignature($paytmParams, '1TtjE5NHKm0wi90C');*/
					$paytmChecksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "mcwOj_bogaHTbfdu");

					$paytmParams["head"] = array(
					    "signature"	  => $paytmChecksum
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
					$response = curl_exec($ch);
					print_r($response);
					die;
				// 	$abc = json_decode($response);
    //                 if($abc->body->resultInfo->resultCode == '10' || $abc->body->resultInfo->resultCode == '601') {
    //                     $update = $db->query("UPDATE payment SET refId = '$REFUNDID' WHERE id = '".$fepayment['id']."'");
    //                 }
                    echo $response;
                    die;
 				} else {
 					$status = 0;
					$message = "You can not cancel this order";
					$data = array();
 				}
 			} else {
 				$status = 0;
				$message = "Please enter valid order id";
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