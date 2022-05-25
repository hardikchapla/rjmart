<?php
	include "../connection/connection.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();

	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['mobile'])){
 			$status = 2;
			$message = "Please enter mobile number";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if($_REQUEST['user_type'] == ''){
 			$status = 2;
			$message = "Please enter user type";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
        if(empty($_REQUEST['password'])){
			$status = 2;
		   $message = "Please enter password";
		   $data = array();
		   $response['status'] = $status;
		   $response['message'] = $message;
		   $response['data'] = $data;
		   echo json_encode($response);
		   die;
		}
 		$mobile = $_REQUEST['mobile'];
 		$user_type = $_REQUEST['user_type'];
 		$password = md5($_REQUEST['password']);
 		$checkmobile = $db->query("SELECT * FROM user WHERE mobile = '$mobile' AND password = '$password' AND user_type = '$user_type'");
 		if($checkmobile->rowCount() > 0){
            if($user_type == 'user'){
                $status = 1;
                $message = "Registration successfully";
            } else {
                $status = 1;
                $message = "Login successfully";
            }
            $aa = array();
            $avtar_path = 'http://'.$_SERVER['SERVER_NAME'].'/food_app/assets/img/user/';
            $feget = $checkmobile->fetch();
            $aa['id'] = $feget['id'];
            $aa['fullname'] = $feget['fullname'];
            $aa['email'] = $feget['email'];
            $aa['mobile'] = $feget['mobile'];
            $aa['dob'] = $feget['dob'];
            $aa['document'] = $avtar_path.$feget['document'];
            $aa['avatar'] = $avtar_path.$feget['avatar'];
            $aa['user_type'] = $feget['user_type'];
            $aa['login_type'] = $feget['login_type'];
            $aa['login_identifier'] = $feget['login_identifier'];
            $aa['device_type'] = $feget['device_type'];
            $aa['device_token'] = $feget['device_token'];
            $aa['latitude'] = $feget['latitude'];
            $aa['longitude'] = $feget['longitude'];
            $aa['status'] = $feget['status'];
            $aa['referral'] = $feget['referral'];
            $aa['pincode'] = $feget['pincode'];
            $data = $aa;
 		} else {
            $status = 0;
            $message = "Please enter valid mobile or password";
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