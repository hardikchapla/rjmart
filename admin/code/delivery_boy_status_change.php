<?php
if (isset($_REQUEST['user_id']) && isset($_REQUEST['status'])) {
    require_once '../../connection/connection.php';
    require_once '../../helper/core_function.php';
    $user_id = $_REQUEST['user_id'];
    $status = $_REQUEST['status'];
    $query = "SELECT * FROM `user` WHERE id = '$user_id' ORDER BY id DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $festmt = $stmt->fetch();
    $device_type = $festmt['device_type'];
    $device_token = $festmt['device_token'];
    if($device_type != '' && $device_token != ''){
        if($status == 1){
            $title = "Your Account Activate";
            $data1 = array();
            $data1['message'] = "Your account is activate successfully from admin";
            sendPushNotificationDeliveryBoy($device_token, $title, $device_type, $data1);
        } else {
            $title = "Your Account Deactivate";
            $data1 = array();
            $data1['message'] = "Your account is de-activate successfully from admin";
            sendPushNotificationDeliveryBoy($device_token, $title, $device_type, $data1);
        }
    }
    $query1 = "Update `user` SET status = '$status' WHERE id = '$user_id'";
    $update = $db->prepare($query1);
    $update->execute();
    echo "true";
}
?>