<?php
	include "../connection/connection.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();

	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['user_id'])){
 			$status = 2;
			$message = "Please enter user id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['pincode'])){
 			$status = 2;
			$message = "Please enter pincode";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$pincode = $_REQUEST['pincode'];
 		$date = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
            $check_pincode = $db->query("SELECT * FROM pincode WHERE pincode='$pincode' AND is_active = 1");
            if($check_pincode->rowCount() > 0){
                $update = $db->query("UPDATE user SET pincode = '$pincode' WHERE id = '$user_id'");
                if($update){
                    $status = 1;
                    $message = "Pincode updated successfully";
                    $data = array();
                } else {
                    $status = 0;
                    $message = "Pincode not updated successfully";
                    $data = array();
                }
            } else {
                $status = 0;
                $message = "Delivery not available in this area";
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