<?php
	include "../connection/connection.php";
	require_once("encdec_paytm.php");
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
 		$user_id = $_REQUEST['user_id'];
 		$total_amount = $_REQUEST['total_amount'];
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$uniq = rand(11,99);
	 		$order_number = 'ORDER'.date('Ymdhis').$uniq;
 			$paytmParams = array(
				"MID" => "tHrtod31123741500604",
				"WEBSITE" => "WEBSTAGING",
				"INDUSTRY_TYPE_ID" => "Retail",
				"CHANNEL_ID" => "WAP",
				"ORDER_ID" => $order_number,
				"CUST_ID" => $user_id,
				"MOBILE_NO" => "",
				"EMAIL" => "",
				"TXN_AMOUNT" => $total_amount,
				"CALLBACK_URL" => "https://securegw-stage.paytm.in/theia/paytmCallback?ORDER_ID=".$order_number,
			);
			$checksum = getChecksumFromArray($paytmParams, "mcwOj_bogaHTbfdu");
			$status = 1;
			$message = "checksum generate successfully";
			$paytmParams['CHECKSUMHASH'] = $checksum;
			$data = $paytmParams;
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
