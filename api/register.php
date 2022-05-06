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
 		if(empty($_REQUEST['login_type'])){
 			$status = 2;
			$message = "Please enter login type";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$mobile = $_REQUEST['mobile'];
 		$user_type = $_REQUEST['user_type'];
 		$login_type = $_REQUEST['login_type'];
 		$fullname = $_REQUEST['fullname'];
 		$email = $_REQUEST['email'];
 		$dob = (isset($_REQUEST['dob']) && !empty($_REQUEST['dob'])) ? date('Y-m-d', strtotime($_REQUEST['dob'])):'0000-00-00';
 		$login_identifier = $_REQUEST['login_identifier'];
 		$device_type = $_REQUEST['device_type'];
 		$device_token = $_REQUEST['device_token'];
 		$latitude = $_REQUEST['latitude'];
 		$longitude = $_REQUEST['longitude'];
 		$logintype = 0;
 		if($login_type == 'facebook'){
 			$logintype = 1;
 		} elseif($login_type == 'google'){
 			$logintype = 2;
 		} elseif ($login_type == 'apple') {
 			$logintype = 3;
 		}
 		if($user_type == 'user'){
 			$usertype = 0;
 			$status = 1;
 		} else {
 			$usertype = 1;
 			$status = 0;
 		}
 		$date = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE mobile = '$mobile'");
 		if($checkmobile->rowCount() > 0){
 			$userdata = $checkmobile->fetch();
 			$user_id = $userdata['id'];
 			$delevery_status = $userdata['status'];
 			if($usertype == 1 && $delevery_status == 0){
 				if(empty($_FILES['avatar']['name'])){
		 			$status = 2;
					$message = "Please select profile picture";
					$data = array();
					$response['status'] = $status;
					$response['message'] = $message;
					$response['data'] = $data;
					echo json_encode($response);
					die;
		 		}
		 		if(empty($_FILES['document']['name'])){
		 			$status = 2;
					$message = "Please select your document";
					$data = array();
					$response['status'] = $status;
					$response['message'] = $message;
					$response['data'] = $data;
					echo json_encode($response);
					die;
		 		}
		 		$file = $_FILES['avatar']['name'];
				$tmp = $_FILES['avatar']['tmp_name'];
				$ext = pathinfo($file, PATHINFO_EXTENSION);
				$avatar = rand(1000,1000000).$file; 
				$path = '../assets/img/user/'.$avatar;
				move_uploaded_file($tmp,$path);
				unlink('../assets/img/user/'.$userdata['avatar']);

				$file1 = $_FILES['document']['name'];
				$tmp1 = $_FILES['document']['tmp_name'];
				$ext1 = pathinfo($file1, PATHINFO_EXTENSION);
				$document = rand(1000,1000000).$file1; 
				$path1 = '../assets/img/user/'.$document;
				move_uploaded_file($tmp1,$path1);
				unlink('../assets/img/user/'.$userdata['document']);

				$query = $db->query("UPDATE user SET login_identifier = '$login_identifier', device_type = '$device_type', device_token = '$device_token', latitude = '$latitude', longitude = '$longitude',avatar = '$avatar',document = '$document', updated = '$date' WHERE mobile = '$mobile'");
 			} else {
 				$query = $db->query("UPDATE user SET login_identifier = '$login_identifier', device_type = '$device_type', device_token = '$device_token', latitude = '$latitude', longitude = '$longitude', updated = '$date' WHERE mobile = '$mobile'");
 			}
 			if($query){
 				$avtar_path = 'http://'.$_SERVER['SERVER_NAME'].'/assets/img/user/';
	 			$get = $db->query("SELECT * FROM user WHERE id = '$user_id'");
	 			$status = 1;
	 			$message = "Login successfully";
	 			$aa = array();
	 			$feget = $get->fetch();
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
	 			$data = $aa;
	 			
	 		} else {
	 			$status = 0;
	 			$message = "something is wrong";
	 			$data = array();
	 		}
 		} else {
 			if($usertype == 1){
 				if(empty($_FILES['avatar']['name'])){
		 			$status = 2;
					$message = "Please select profile picture";
					$data = array();
					$response['status'] = $status;
					$response['message'] = $message;
					$response['data'] = $data;
					echo json_encode($response);
					die;
		 		}
		 		if(empty($_FILES['document']['name'])){
		 			$status = 2;
					$message = "Please select your document";
					$data = array();
					$response['status'] = $status;
					$response['message'] = $message;
					$response['data'] = $data;
					echo json_encode($response);
					die;
		 		}
		 		$file = $_FILES['avatar']['name'];
				$tmp = $_FILES['avatar']['tmp_name'];
				$ext = pathinfo($file, PATHINFO_EXTENSION);
				$avatar = rand(1000,1000000).$file; 
				$path = '../assets/img/user/'.$avatar;
				move_uploaded_file($tmp,$path);

				$file1 = $_FILES['document']['name'];
				$tmp1 = $_FILES['document']['tmp_name'];
				$ext1 = pathinfo($file1, PATHINFO_EXTENSION);
				$document = rand(1000,1000000).$file1; 
				$path1 = '../assets/img/user/'.$document;
				move_uploaded_file($tmp1,$path1);

				$query = $db->query("INSERT INTO user SET mobile = '$mobile',user_type = '$usertype',login_type = '$logintype',fullname = '$fullname', email = '$email', dob = '$dob', login_identifier = '$login_identifier', device_type = '$device_type', device_token = '$device_token', latitude = '$latitude', longitude = '$longitude',avatar = '$avatar',document = '$document', created = '$date', status = '$status'");
	 			$user_id = $db->lastInsertId();

	 			$notification = $db->query("INSERT INTO notification SET sender_id = '$user_id', title = 'Delivery boy register', message = 'New delivery boy register successfully', `type` = 'new_register', receiver_type = '1', created = '$date'");
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
                        $query = $db->query("INSERT INTO user SET mobile = '$mobile',user_type = '$usertype',login_type = '$logintype',fullname = '$fullname', email = '$email', dob = '$dob', login_identifier = '$login_identifier', device_type = '$device_type', device_token = '$device_token', latitude = '$latitude', longitude = '$longitude', created = '$date', status = '$status',referral = '$referral',friend_referral = '$friend_referral'");
                        $user_id = $db->lastInsertId();
                        $notification = $db->query("INSERT INTO notification SET sender_id = '$user_id', title = 'User register', message = 'New user register successfully', `type` = 'new_register', receiver_type = '1', created = '$date'");
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
                    $query = $db->query("INSERT INTO user SET mobile = '$mobile',user_type = '$usertype',login_type = '$logintype',fullname = '$fullname', email = '$email', dob = '$dob', login_identifier = '$login_identifier', device_type = '$device_type', device_token = '$device_token', latitude = '$latitude', longitude = '$longitude', created = '$date', status = '$status',referral = '$referral'");
                    $user_id = $db->lastInsertId();
                    $notification = $db->query("INSERT INTO notification SET sender_id = '$user_id', title = 'User register', message = 'New user register successfully', `type` = 'new_regiter', receiver_type = '1', created = '$date'");
                }
	 		}
 			if($query){
 				$avtar_path = 'http://'.$_SERVER['SERVER_NAME'].'/food_app/assets/img/user/';
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
	 			$data = $aa;
	 		} else {
	 			$status = 0;
	 			$message = "something is wrong";
	 			$data = array();
	 		}
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