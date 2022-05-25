<?php
require_once '../../connection/connection.php';
require_once "../../helper/core_function.php";
if (isset($_REQUEST['order_id'])) {
    $order_id = $_REQUEST['order_id'];
    $otp = rand(100000,999999);
    $order = $db->query("SELECT * FROM product_order WHERE id = '$order_id' AND order_status = '0'");
    if($order->rowCount() > 0){
        $feorder1 = $order->fetch();
        $change = $db->query("UPDATE product_order SET order_status = 3 WHERE id = '$order_id'");
        // send push notification
        $from_id = $feorder1['user_id'];
        $user = $db->query("SELECT * FROM user WHERE id = '$from_id'");
        $feuser = $user->fetch();

        $title = "Order Cancelled";
        $data1 = array();
        $data1['message'] = "Order cancelled successfully";
        $notification = $db->query("INSERT INTO notification (`receiver_id`, `order_id`, `title`, `message`, `type`) VALUES ('$from_id', '$order_id', '$title', 'Order cancelled successfully', 'cancel_order')");
        sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
        sendsms($feuser['mobile'],"Shipped : Your Order has been shipped.it will be delivered by in 24 hours. and your one time password is :".$otp);
        echo "true";
    }
}
?>