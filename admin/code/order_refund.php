<?php
require_once '../../connection/connection.php';
require_once "../../helper/core_function.php";
if (isset($_REQUEST['order_id'])) {
    $order_id = $_REQUEST['order_id'];
    $order = $db->query("SELECT * FROM product_order WHERE id = '$order_id' AND order_status = '3'");
    if($order->rowCount() > 0){
        $feorder1 = $order->fetch();
        $change = $db->query("UPDATE product_order SET is_refund = 1 WHERE id = '$order_id'");
        $from_id = $feorder1['user_id'];
        $user = $db->query("SELECT * FROM user WHERE id = '$from_id'");
        $feuser = $user->fetch();
        $date = date('Y-m-d H:i:s');
        $title = "Amount Refund";
        $data1 = array();
        $data1['message'] = "You will get your refund within 48 hours";
        sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
        $notification2 = $db->query("INSERT INTO notification SET receiver_id = '$from_id',order_id = '$order_id', title = 'Amount Refund', message = 'You will get your refund within 48 hours', `type` = 'order_refund', receiver_type = '0', created = '$date'");
        // sendsms($feuser['mobile'],"Shipped : Your Order has been shipped.it will be delivered by in 24 hours. and your one time password is :".$otp);
        echo "true";
    }
}
?>