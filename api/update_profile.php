<?php
	include "../connection/connection.php";
	include "../helper/constant.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();

	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['user_id'])){
 			$status = 2;
			$message = "Please enter user_id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$user_type = $_REQUEST['user_type'];
 		$fullname = $_REQUEST['fullname'];
 		$email = $_REQUEST['email'];
 		$dob = (isset($_REQUEST['dob']) && !empty($_REQUEST['dob'])) ? date('Y-m-d', strtotime($_REQUEST['dob'])):'0000-00-00';
 		$date = date('Y-m-d H:i:s');
 		$avatar = '';
 		$document = '';
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$fecheck = $checkmobile->fetch();
	 		if($user_type == 'user'){
	 			if(!empty($_FILES['avatar']['name']))
				{
					$file = $_FILES['avatar']['name'];
					$tmp = $_FILES['avatar']['tmp_name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$avatar = rand(1000,1000000).$file; 
					$path = '../assets/img/user/'.$avatar;
					move_uploaded_file($tmp,$path);
					unlink('../assets/img/user/'.$fecheck['avatar']);
					$query = $db->query("UPDATE user SET fullname = '$fullname',avatar = '$avatar', email = '$email', dob = '$dob', updated = '$date' WHERE id = '$user_id'");
				}
				else
				{
					$query = $db->query("UPDATE user SET fullname = '$fullname', email = '$email', dob = '$dob', updated = '$date' WHERE id = '$user_id'");
				}
				
	 		} else {
	 			if(!empty($_FILES['avatar']['name']) && !empty($_FILES['document']['name']))
				{
					$file = $_FILES['avatar']['name'];
					$tmp = $_FILES['avatar']['tmp_name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$avatar = rand(1000,1000000).$file; 
					$path = '../assets/img/user/'.$avatar;
					move_uploaded_file($tmp,$path);
					unlink('../assets/img/user/'.$fecheck['avatar']);

					$file1 = $_FILES['document']['name'];
					$tmp1 = $_FILES['document']['tmp_name'];
					$ext1 = pathinfo($file1, PATHINFO_EXTENSION);
					$document = rand(1000,1000000).$file1; 
					$path1 = '../assets/img/user/'.$document;
					move_uploaded_file($tmp1,$path1);
					unlink('../assets/img/user/'.$fecheck['document']);
					$query = $db->query("UPDATE user SET fullname = '$fullname',avatar = '$avatar',document = '$document', email = '$email', dob = '$dob', updated = '$date' WHERE id = '$user_id'");
				}
				else if(!empty($_FILES['avatar']['name']))
				{
					$file = $_FILES['avatar']['name'];
					$tmp = $_FILES['avatar']['tmp_name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$avatar = rand(1000,1000000).$file; 
					$path = '../assets/img/user/'.$avatar;
					move_uploaded_file($tmp,$path);
					unlink('../assets/img/user/'.$fecheck['avatar']);
					$query = $db->query("UPDATE user SET fullname = '$fullname',avatar = '$avatar', email = '$email', dob = '$dob', updated = '$date' WHERE id = '$user_id'");
				} 
				else if(!empty($_FILES['document']['name']))
				{
					$file = $_FILES['document']['name'];
					$tmp = $_FILES['document']['tmp_name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$document = rand(1000,1000000).$file; 
					$path = '../assets/img/user/'.$document;
					move_uploaded_file($tmp,$path);
					unlink('../assets/img/user/'.$fecheck['document']);
					$query = $db->query("UPDATE user SET fullname = '$fullname',document = '$document', email = '$email', dob = '$dob', updated = '$date' WHERE id = '$user_id'");
				}
				else
				{
					$query = $db->query("UPDATE user SET fullname = '$fullname', email = '$email', dob = '$dob', updated = '$date' WHERE id = '$user_id'");
				}
	 		}
 			
 			if($query){
				$avtar_path = BASE_URL.'assets/img/user/';
	 			$get = $db->query("SELECT * FROM user WHERE id = '$user_id'");
	 			$status = 1;
	 			$message = "User Updated Successfully";
	 			$aa = array();
	 			$feget = $get->fetch();
 				$aa['id'] = $feget['id'];
 				$aa['fullname'] = $feget['fullname'];
 				$aa['email'] = $feget['email'];
 				$aa['mobile'] = $feget['mobile'];
 				$aa['otp'] = $feget['otp'];
 				$aa['dob'] = $feget['dob'];
 				$aa['document'] = !empty($feget['document']) ? $avtar_path.$feget['document']:'';
 				$aa['avatar'] = !empty($feget['avatar']) ? $avtar_path.$feget['avatar']:'';
 				$aa['user_type'] = $feget['user_type'];
 				$aa['login_type'] = $feget['login_type'];
 				$aa['login_identifier'] = $feget['login_identifier'];
 				$aa['device_type'] = $feget['device_type'];
 				$aa['device_token'] = $feget['device_token'];
 				$aa['latitude'] = $feget['latitude'];
 				$aa['longitude'] = $feget['longitude'];
 				$aa['status'] = $feget['status'];
	 			$data = $aa;
	 			
	 		} else {
	 			$status = 0;
	 			$message = "something is wrong";
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