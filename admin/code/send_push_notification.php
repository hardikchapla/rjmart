<?php
	require_once "../../connection/connection.php";
	require_once "../../helper/core_function.php";
	if($_POST["operation"] == "Add")
	{
        $title = $_POST['title'];
        $message = $_POST['message'];
        if($_POST['user_type'] == ''){
            $selected_user = $_POST['selected_user'];
            if(!empty($selected_user)){
                foreach($selected_user as $key => $user_id){
                    $user = $db->query("SELECT * FROM user WHERE id = '$user_id'");
                    $feuser = $user->fetch();
                    $date = date('Y-m-d H:i:s');
                    // $title = "Order Shipped";
                    $data1 = array();
                    $data1['message'] = $message;
                    if($feuser['user_type'] == 1){
                        $check = sendPushNotificationDeliveryBoy($feuser['device_token'], $title, $feuser['device_type'], $data1);
                    } else {
                        $check = sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
                    }
                }
            }
        } else {
            if($_POST['user_type'] == 'all'){
                $user = $db->query("SELECT * FROM user");
                if($user->rowCount() > 0){
                    while($feuser = $user->fetch()){
                        $date = date('Y-m-d H:i:s');
                        // $title = "Order Shipped";
                        $data1 = array();
                        $data1['message'] = $message;
                        if($feuser['user_type'] == 1){
                            $check = sendPushNotificationDeliveryBoy($feuser['device_token'], $title, $feuser['device_type'], $data1);
                        } else {
                            $check = sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
                        }
                        
                    }
                }
            } elseif ($_POST['user_type'] == 'delivery_boy') {
                $user = $db->query("SELECT * FROM user WHERE user_type = 1");
                if($user->rowCount() > 0){
                    while($feuser = $user->fetch()){
                        $date = date('Y-m-d H:i:s');
                        $data1 = array();
                        $data1['message'] = $message;
                        $check = sendPushNotificationDeliveryBoy($feuser['device_token'], $title, $feuser['device_type'], $data1);
                    }
                }
            } elseif ($_POST['user_type'] == 'users') {
                $user = $db->query("SELECT * FROM user WHERE user_type = 0");
                if($user->rowCount() > 0){
                    while($feuser = $user->fetch()){
                        $date = date('Y-m-d H:i:s');
                        $data1 = array();
                        $data1['message'] = $message;
                        $check = sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
                    }
                }
            }
        }
		$reoutput = array();
		$reoutput['error'] = 'success';
	}
	echo json_encode($reoutput);
?>