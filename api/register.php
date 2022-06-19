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
 		if(empty($_REQUEST['user_type'])){
 			$status = 2;
			$message = "Please enter user type";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
		if(empty($_REQUEST['fullname'])){
			$status = 2;
		   $message = "Please enter full name";
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
 		$fullname = $_REQUEST['fullname'];
 		$password = md5($_REQUEST['password']);
        $email = $_REQUEST['email'];
 		$dob = (isset($_REQUEST['dob']) && !empty($_REQUEST['dob'])) ? date('Y-m-d', strtotime($_REQUEST['dob'])):'0000-00-00';
 		$login_identifier = $_REQUEST['login_identifier'];
 		$device_type = $_REQUEST['device_type'];
 		$device_token = $_REQUEST['device_token'];
 		$latitude = $_REQUEST['latitude'];
 		$longitude = $_REQUEST['longitude'];
 		$logintype = 0;
 		if($user_type == 'user'){
 			$usertype = 0;
 			$status = 1;
 		} else {
 			$usertype = 1;
 			$status = 1;
 		}
 		$date = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE mobile = '$mobile'");
 		if($checkmobile->rowCount() > 0){
            $status = 0;
            $message = "Mobile number already exist";
            $data = (object) array();
 		} else {
			$admin = $db->query("SELECT * FROM `admin` WHERE id = 1");
        	$feadmin = $admin->fetch();
 			if($usertype == 1){
				$query = $db->query("INSERT INTO user SET mobile = '$mobile', password = '$password',user_type = '$usertype',login_type = '$logintype',fullname = '$fullname', email = '$email', dob = '$dob', login_identifier = '$login_identifier', device_type = '$device_type', device_token = '$device_token', latitude = '$latitude', longitude = '$longitude', created = '$date', status = '$status'");
	 			$user_id = $db->lastInsertId();

	 			$notification = $db->query("INSERT INTO notification SET sender_id = '$user_id', title = 'Delivery boy register', message = 'New delivery boy register successfully', `type` = 'new_register', receiver_type = '1', created = '$date'");
				 $title = "Delivery boy register";
				 $data2 = array();
				 $data2['message'] = "New delivery boy register successfully";
				 sendPushNotificationAdmin($feadmin['device_token'],$title,$feadmin['device_type'],$data2);
 			} else {
                $friend_referral = $_REQUEST['friend_referral'];
                $referral = rand(100000,999999);
                $check_ref = $db->query("SELECT * FROM user WHERE referral = '$referral'");
                if($check_ref->rowCount() > 0){
                    $referral = rand(100000,999999);
                    $check_ref = $db->query("SELECT * FROM user WHERE referral = '$referral'");
                    if($check_ref->rowCount() > 0){
                        $referral = rand(100000,999999);
                    }
                }
                if($friend_referral != ''){
                    $check_ref = $db->query("SELECT * FROM user WHERE referral = '$friend_referral'");
                    if($check_ref->rowCount() > 0){
                        $fereferral = $check_ref->fetch();
                        $ref_user_id = $fereferral['id'];
                        $referral_count = $fereferral['referral_count'] + 1;
                        if($referral_count == 10 && $fereferral['referral_used'] == 0){
                            $ref_update = $db->query("UPDATE user SET referral_count = 0, referral_amount = 50 WHERE id = '$ref_user_id'");
                        }
                        if($referral_count != 10 && $fereferral['referral_used'] == 0){
                            $ref_update = $db->query("UPDATE user SET referral_count = '$referral_count' WHERE id = '$ref_user_id'");
                        }
                        $query = $db->query("INSERT INTO user SET mobile = '$mobile', password = '$password',user_type = '$usertype',login_type = '$logintype',fullname = '$fullname', email = '$email', dob = '$dob', login_identifier = '$login_identifier', device_type = '$device_type', device_token = '$device_token', latitude = '$latitude', longitude = '$longitude', created = '$date', status = '$status',referral = '$referral',friend_referral = '$friend_referral'");
                        $user_id = $db->lastInsertId();
                        $notification = $db->query("INSERT INTO notification SET sender_id = '$user_id', title = 'User register', message = 'New user register successfully', `type` = 'new_register', receiver_type = '1', created = '$date'");
						$title = "User register";
						$data2 = array();
						$data2['message'] = "New user register successfully";
						sendPushNotificationAdmin($feadmin['device_token'],$title,$feadmin['device_type'],$data2);
                    } else {
                        $status = 0;
                        $message = "Please enter valid referral";
                        $data = array();
                        $response['status'] = $status;
                        $response['message'] = $message;
                        $response['data'] = $data;
                        echo json_encode($response);
                        die;
                    }
                } else {
                    $query = $db->query("INSERT INTO user SET mobile = '$mobile', password = '$password',user_type = '$usertype',login_type = '$logintype',fullname = '$fullname', email = '$email', dob = '$dob', login_identifier = '$login_identifier', device_type = '$device_type', device_token = '$device_token', latitude = '$latitude', longitude = '$longitude', created = '$date', status = '$status',referral = '$referral'");
                    $user_id = $db->lastInsertId();
                    $notification = $db->query("INSERT INTO notification SET sender_id = '$user_id', title = 'User register', message = 'New user register successfully', `type` = 'new_register', receiver_type = '1', created = '$date'");
					$title = "User register";
					$data2 = array();
					$data2['message'] = "New user register successfully";
					sendPushNotificationAdmin($feadmin['device_token'],$title,$feadmin['device_type'],$data2);
                }
	 		}
 			if($query){
				$avtar_path = BASE_URL.'assets/img/user/';
	 			$get = $db->query("SELECT * FROM user WHERE id = '$user_id'");
	 			if($user_type == 'user'){
             		$status = 1;
    	 			$message = "Registration successfully";
         		} else {
         			$status = 1;
	 			    $message = "Your account has been created, you can login after our team verify your documents.";
         		}
	 			$aa = array();
	 			$feget = $get->fetch();
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
	 			$message = "something is wrong";
	 			$data = (object) array();
	 		}
 		}
	} else {
		$status = 0;
		$message = "Please enter field values";
		$data = (object) array();
	}
	$response['status'] = $status;
	$response['message'] = $message;
	$response['data'] = $data;
	echo json_encode($response);
	die;
?>