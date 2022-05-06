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
 		if(empty($_REQUEST['full_name'])){
 			$status = 2;
			$message = "Please enter full name";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['mobile_number'])){
 			$status = 2;
			$message = "Please enter mobile number";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['house_no'])){
 			$status = 2;
			$message = "Please enter house no";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['building_name'])){
 			$status = 2;
			$message = "Please enter building name";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['road_area_colony'])){
 			$status = 2;
			$message = "Please enter road,area or colony";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['main_area'])){
 			$status = 2;
			$message = "Please enter main area";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['city'])){
 			$status = 2;
			$message = "Please enter city";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		if(empty($_REQUEST['state'])){
 			$status = 2;
			$message = "Please enter state";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
 		$user_id = $_REQUEST['user_id'];
 		$address_id = $_REQUEST['address_id'];
 		$full_name = $_REQUEST['full_name'];
 		$mobile_number = $_REQUEST['mobile_number'];
 		$alt_mobile_number = $_REQUEST['alt_mobile_number'];
 		$house_no = $_REQUEST['house_no'];
 		$building_name = $_REQUEST['building_name'];
 		$road_area_colony = $_REQUEST['road_area_colony'];
 		$main_area = $_REQUEST['main_area'];
 		$landmark = $_REQUEST['landmark'];
 		$city = $_REQUEST['city'];
 		$state = $_REQUEST['state'];
 		$date = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			if($address_id == ''){
 				$query = $db->query("INSERT INTO user_address SET user_id = '$user_id', full_name = '$full_name', mobile_number = '$mobile_number', alt_mobile_number = '$alt_mobile_number', house_no = '$house_no', building_name = '$building_name', road_area_colony = '$road_area_colony', main_area = '$main_area', landmark = '$landmark', city = '$city', state = '$state', created = '$date'");
 				if($query){
 					$status = 1;
					$message = "User address add successfully";
					$data = array();
	 			} else {
	 				$status = 0;
					$message = "User address add not successfully";
					$data = array();
	 			}
 			} else {
 				$checkaddress = $db->query("SELECT * FROM user_address WHERE id = '$address_id'");
 				if($checkaddress->rowCount() > 0){
	 				$query = $db->query("UPDATE user_address SET full_name = '$full_name', mobile_number = '$mobile_number', alt_mobile_number = '$alt_mobile_number', house_no = '$house_no', building_name = '$building_name', road_area_colony = '$road_area_colony', main_area = '$main_area', landmark = '$landmark', city = '$city', state = '$state' WHERE id = '$address_id'");
	 				if($query){
	 					$status = 1;
						$message = "User address update successfully";
						$data = array();
		 			} else {
		 				$status = 0;
						$message = "User address update not successfully";
						$data = array();
		 			}
		 		} else {
		 			$status = 0;
					$message = "Please enter valid address id";
					$data = array();
		 		}
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