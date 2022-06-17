<?php
require_once '../../connection/connection.php';
require_once "../../helper/core_function.php";
if (isset($_REQUEST['order_id'])) {
    $order_id = $_REQUEST['order_id'];
    $otp = rand(100000,999999);
    $order = $db->query("SELECT * FROM product_order WHERE id = '$order_id' AND order_status = '4'");
    if($order->rowCount() > 0){
        $feorder1 = $order->fetch();
        $change = $db->query("UPDATE product_order SET order_status = 2 WHERE id = '$order_id'");
        $request = $db->query("SELECT * FROM near_by_request WHERE order_id = '$order_id'");
        $ferequest = $request->fetch();
        $toid = $ferequest['to_id'];
        $user_update = $db->query("UPDATE user SET active = 1 WHERE id = '$toid'");
        // send push notification
        $from_id = $feorder1['user_id'];
        $user = $db->query("SELECT * FROM user WHERE id = '$from_id'");
        $feuser = $user->fetch();
        $user1 = $db->query("SELECT * FROM user WHERE id = '$toid'");
        $feuser1 = $user1->fetch();
        $admin = $db->query("SELECT * FROM `admin` WHERE id = 1");
        $feadmin = $admin->fetch();
        $date = date('Y-m-d H:i:s');
        $title = "Order Completed";
        $data1 = array();
        $data1['message'] = "Order completed successfully";
        sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
        sendPushNotificationDeliveryBoy($feuser1['device_token'], $title, $feuser1['device_type'], $data1);
        sendPushNotificationAdmin($feadmin['device_token'],$title,$feadmin['device_type'],$data1);
        $notification2 = $db->query("INSERT INTO notification SET receiver_id = '$from_id',order_id = '$order_id', title = 'Order Shipped', message = 'Order shipped successfully', `type` = 'order_shipped', receiver_type = '0', created = '$date'");
        $notification3 = $db->query("INSERT INTO notification SET receiver_id = '$toid',order_id = '$order_id', title = 'Order Shipped', message = 'Order shipped successfully', `type` = 'order_shipped', receiver_type = '0', created = '$date'");
        $notification4 = $db->query("INSERT INTO notification SET sender_id = '$toid',order_id = '$order_id', title = 'Order Shipped', message = 'Order shipped successfully', `type` = 'order_shipped', receiver_type = '1', created = '$date'");
        // sendsms($feuser['mobile'],"Shipped : Your Order has been shipped.it will be delivered by in 24 hours. and your one time password is :".$otp);
        echo "true";
    }
}
?>