<?php
require_once '../../connection/connection.php';
require_once "../../helper/core_function.php";
$response = array();
if (isset($_REQUEST['order_id']) && isset($_REQUEST['reasone']) && !empty($_REQUEST['reasone'])) {
    $order_id = $_REQUEST['order_id'];
    $reasone = addslashes($_REQUEST['reasone']);
    $order = $db->query("SELECT * FROM product_order WHERE id = '$order_id' AND order_status = '0'");
    if($order->rowCount() > 0){
        $feorder1 = $order->fetch();
        $change = $db->query("UPDATE product_order SET order_status = 3, cancel_status = 1, reason = '$reasone', is_cancel_by_admin = 1 WHERE id = '$order_id'");
        // send push notification
        $from_id = $feorder1['user_id'];
        $user = $db->query("SELECT * FROM user WHERE id = '$from_id'");
        $feuser = $user->fetch();

        $title = "Order Cancelled";
        $data1 = array();
        $data1['message'] = "Your order ".$feorder1['order_number']." has been canceled by admin because of ".$reasone;
        $notification = $db->query("INSERT INTO notification (`receiver_id`, `order_id`, `title`, `message`, `type`) VALUES ('$from_id', '$order_id', '$title',".$data1['message'].", 'cancel_order')");
        sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
        // sendsms($feuser['mobile'],"Cancelled : Your Order has been cancelled.");
        $response['error'] = 0;
    }
} else {
    $response['error'] = 1;
}
echo json_encode($response);
?>