<?php
	require_once "../../connection/connection.php";
	require_once "../../helper/core_function.php";
	if($_POST["operation"] == "Add")
	{
        $selected_user = $_POST['selected_user'];
        $title = $_POST['title'];
        $message = $_POST['message'];
        if(!empty($selected_user)){
            foreach($selected_user as $key => $user_id){
                $user = $db->query("SELECT * FROM user WHERE id = '$user_id'");
                $feuser = $user->fetch();
                $date = date('Y-m-d H:i:s');
                $title = "Order Shipped";
                $data1 = array();
                $data1['message'] = $message;
                $check = sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
            }
        }
		$reoutput = array();
		$reoutput['error'] = 'success';
	}
	echo json_encode($reoutput);
?>