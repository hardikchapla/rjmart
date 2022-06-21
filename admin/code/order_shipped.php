<?php
require_once '../../connection/connection.php';
require_once "../../helper/core_function.php";
if (isset($_REQUEST['order_id'])) {
    $order_id = $_REQUEST['order_id'];
    $otp = rand(100000,999999);
    $order = $db->query("SELECT * FROM product_order WHERE id = '$order_id' AND order_status = '1'");
    if($order->rowCount() > 0){
        $feorder1 = $order->fetch();
        $change = $db->query("UPDATE product_order SET order_status = 4,receive_otp = '$otp' WHERE id = '$order_id'");
        // send push notification
        $from_id = $feorder1['user_id'];
        
        $request = $db->query("SELECT * FROM near_by_request WHERE order_id = '$order_id'");
        $ferequest = $request->fetch(PDO::FETCH_ASSOC);
        $to_id = $ferequest['to_id'];
        $user = $db->query("SELECT * FROM user WHERE id = '$from_id'");
        $feuser = $user->fetch();
        $user1 = $db->query("SELECT * FROM user WHERE id = '$to_id'");
        $feuser1 = $user1->fetch();
        $date = date('Y-m-d H:i:s');
        $title = "Order Shipped";
        $data1 = array();
        $data1['message'] = "Your order ".$feorder1['order_number']." has been shipped.";
        $data2 = array();
        $data2['message'] = "The order ".$feorder1['order_number']." has been shipped by admin, please collect the order from the store.";
        sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
        sendPushNotificationDeliveryBoy($feuser1['device_token'], $title, $feuser1['device_type'], $data2);
        $notification2 = $db->query("INSERT INTO notification SET receiver_id = '$from_id',order_id = '$order_id', title = 'Order Shipped', message = 'Your order ".$feorder1['order_number']." has been shipped.', `type` = 'order_shipped', receiver_type = '0', created = '$date'");
        $notification2 = $db->query("INSERT INTO notification SET receiver_id = '$to_id',order_id = '$order_id', title = 'Order Shipped', message = 'The order ".$feorder1['order_number']." has been shipped by admin, please collect the order from the store.', `type` = 'order_shipped', receiver_type = '0', created = '$date'");
        // sendsms($feuser['mobile'],"Shipped : Your Order has been shipped.it will be delivered by in 24 hours. and your one time password is :".$otp);
        echo "true";
    }
}
?>