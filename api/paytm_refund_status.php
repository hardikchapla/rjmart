<?php
include "../connection/connection.php";
/*	require_once("encdec_paytm.php");*/
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
                $fepayment = $payment->fetch();

                $ON = $feorder['order_number'];
                $OFF = $fepayment['payment_identifier'];
                $paytmParams = array();
                $paytmParams["body"] = array(
                    "mid"          => "tHrtod31123741500604",
                    "orderId"      => $ON,
                    "refId"        => $fepayment['refId']
                );
                $paytmChecksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "mcwOj_bogaHTbfdu");

                $paytmParams["head"] = array(
                    "signature"	  => $paytmChecksum
                );

                $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
                $url = "https://securegw-stage.paytm.in/v2/refund/status";

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                $response = curl_exec($ch);
                echo $response;
                die;
            } else {
                $status = 0;
                $message = "This order not available";
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