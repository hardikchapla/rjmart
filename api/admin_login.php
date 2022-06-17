<?php
	include "../connection/connection.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();

	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['device_token'])){
 			$status = 2;
			$message = "Please enter device token";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
        if(empty($_REQUEST['device_type'])){
		   $status = 2;
		   $message = "Please enter device type";
		   $data = array();
		   $response['status'] = $status;
		   $response['message'] = $message;
		   $response['data'] = $data;
		   echo json_encode($response);
		   die;
		}
 		$device_type = $_REQUEST['device_type'];
 		$device_token = $_REQUEST['device_token'];
        
 		$adminUpdate = $db->query("UPDATE `admin` SET device_type = '$device_type', device_token ='$device_token' WHERE id='1'");
 		if($adminUpdate){
            $status = 0;
            $message = "device updated succussfully";
            $data = (object)  array();
 		} else {
            $status = 0;
            $message = "Oops! Something went wrong";
            $data = (object)  array();
        }
	} else {
		$status = 0;
		$message = "Please enter field values";
		$data = (object)  array();
	}
	$response['status'] = $status;
	$response['message'] = $message;
	$response['data'] = $data;
	echo json_encode($response);
	die;
?>