<?php
	include "../connection/connection.php";
	include "../helper/constant.php";
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
 		$device_type = $_REQUEST['device_type'];
 		$device_token = $_REQUEST['device_token'];
 		$checkmobile = $db->query("SELECT * FROM user WHERE mobile = '$mobile' AND password = '$password' AND user_type = '$user_type'");
 		if($checkmobile->rowCount() > 0){
            if($user_type == 'user'){
                $status = 1;
                $message = "Login successfully";
            } else {
                $status = 1;
                $message = "Login successfully";
            }
			$feget1 = $checkmobile->fetch();
            $aa = array();
			if (!empty($device_type) || !empty($device_token)) {
				$update = $db->query("UPDATE user SET device_type = '$device_type', device_token = '$device_token' WHERE id = '".$feget1['id']."'");
			}
			$checkuser = $db->query("SELECT * FROM user WHERE id = '".$feget1['id']."'");
			$feget = $checkuser->fetch();
            $avtar_path = BASE_URL.'assets/img/user/';
            $aa['id'] = $feget['id'];
            $aa['fullname'] = $feget['fullname'];
            $aa['email'] = $feget['email'];
            $aa['mobile'] = $feget['mobile'];
            $aa['dob'] = $feget['dob'];
			if($feget['document'] == ''){
				$aa['document'] = '';
			}else{
				$aa['document'] = $avtar_path.$feget['document'];
			}
			if($feget['avatar'] == ''){
				$aa['avatar'] = '';
			}else{
				$aa['avatar'] = $avtar_path.$feget['avatar'];
			}
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
			$address = $db->query("SELECT * FROM user_address WHERE user_id = '".$feget['id']."' AND is_default = 1");
			if($address->rowCount() > 0){
				$feaddress = $address->fetch();
				$bb = array();
				$bb['address_id'] = $feaddress['id'];
				$bb['user_id'] = $feaddress['user_id'];
				$bb['full_name'] = $feaddress['full_name'];
				$bb['mobile_number'] = $feaddress['mobile_number'];
				$bb['house_no'] = $feaddress['house_no'];
				$bb['floor_no'] = $feaddress['floor_no'];
				$bb['tower_no'] = $feaddress['tower_no'];
				$bb['building_name'] = $feaddress['building_name'];
				$bb['landmark'] = $feaddress['landmark'];
				$bb['address'] = $feaddress['address'];
				$bb['google_auto_address'] = $feaddress['google_auto_address'];
				$bb['pincode'] = $feaddress['pincode'];
				$bb['state'] = $feaddress['state'];
				$bb['latitude'] = $feaddress['latitude'];
				$bb['longitude'] = $feaddress['longitude'];
				$bb['is_default'] = $feaddress['is_default'];
				$aa['address'] = $bb;
			} else {
				$aa['address'] = (object) array();
			}
            $data = $aa;
 		} else {
            $status = 0;
            $message = "Your password is wrong, please enter correct password";
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