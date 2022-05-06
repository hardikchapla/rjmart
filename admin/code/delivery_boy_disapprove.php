<?php
if (isset($_REQUEST['user_id'])) {
    require_once '../../connection/connection.php';
    require_once '../../helper/core_function.php';
    $user_id = $_REQUEST['user_id'];
    $query = "SELECT * FROM `user` WHERE id = '$user_id' ORDER BY id DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $festmt = $stmt->fetch();
    $device_type = $festmt['device_type'];
    $device_token = $festmt['device_token'];
    if($device_type != '' && $device_token != ''){
        $title = "Your Account disapproved";
        $data1 = array();
        $data1['message'] = "Your account is disapproved from admin please re-register it";
        sendPushNotification($device_token, $title, $device_type, $data1);
    }
    $query1 = "DELETE FROM `user` WHERE id = '$user_id'";
    $delete = $db->prepare($query1);
    $delete->execute();
    echo "true";
}
?>