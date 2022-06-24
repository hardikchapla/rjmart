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
 		if(empty($_REQUEST['landmark'])){
 			$status = 2;
			$message = "Please enter landmark";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
		if(empty($_REQUEST['google_auto_address'])){
			$status = 2;
		   	$message = "Please enter google auto address";
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
		if(empty($_REQUEST['latitude'])){
			$status = 2;
		   	$message = "Please enter latitude";
		   	$data = array();
		   	$response['status'] = $status;
		   	$response['message'] = $message;
		   	$response['data'] = $data;
		   	echo json_encode($response);
		   	die;
		}
		if(empty($_REQUEST['longitude'])){
			$status = 2;
		   	$message = "Please enter longitude";
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
 		// $alt_mobile_number = $_REQUEST['alt_mobile_number'];
 		$house_no = $_REQUEST['house_no'];
 		$floor_no = $_REQUEST['floor_no'];
 		$tower_no = $_REQUEST['tower_no'];
 		$building_name = $_REQUEST['building_name'];
 		// $road_area_colony = $_REQUEST['road_area_colony'];
 		// $main_area = $_REQUEST['main_area'];
 		$landmark = $_REQUEST['landmark'];
 		// $city = $_REQUEST['city'];
 		$google_auto_address = addslashes($_REQUEST['google_auto_address']);
 		$pincode = $_REQUEST['pincode'];
 		$latitude = $_REQUEST['latitude'];
 		$longitude = $_REQUEST['longitude'];
 		$date = date('Y-m-d H:i:s');
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			if($address_id == ''){
 				// $query = $db->query("INSERT INTO user_address SET user_id = '$user_id', full_name = '$full_name', mobile_number = '$mobile_number', alt_mobile_number = '$alt_mobile_number', house_no = '$house_no', building_name = '$building_name', road_area_colony = '$road_area_colony', main_area = '$main_area', landmark = '$landmark', city = '$city', state = '$state', created = '$date'");
 				$query = $db->query("INSERT INTO user_address SET user_id = '$user_id', full_name = '$full_name', mobile_number = '$mobile_number', house_no = '$house_no', floor_no = '$floor_no',tower_no = '$tower_no', building_name = '$building_name',landmark = '$landmark', google_auto_address = '$google_auto_address', pincode = '$pincode', latitude = '$latitude',longitude='$longitude',  created = '$date'");
 				if($query){
					$address_id = $db->lastInsertId();
					$address = $db->query("SELECT *, id as address_id FROM user_address WHERE id = '$address_id'");
					$feaddress = $address->fetch(PDO::FETCH_ASSOC);
 					$status = 1;
					$message = "User address add successfully";
					$data = $feaddress;
	 			} else {
	 				$status = 0;
					$message = "User address add not successfully";
					$data = array();
	 			}
 			} else {
 				$checkaddress = $db->query("SELECT * FROM user_address WHERE id = '$address_id'");
 				if($checkaddress->rowCount() > 0){
	 				// $query = $db->query("UPDATE user_address SET full_name = '$full_name', mobile_number = '$mobile_number', alt_mobile_number = '$alt_mobile_number', house_no = '$house_no', building_name = '$building_name', road_area_colony = '$road_area_colony', main_area = '$main_area', landmark = '$landmark', city = '$city', state = '$state' WHERE id = '$address_id'");
	 				$query = $db->query("UPDATE user_address SET full_name = '$full_name', mobile_number = '$mobile_number', house_no = '$house_no', floor_no = '$floor_no',tower_no = '$tower_no', building_name = '$building_name',landmark = '$landmark', google_auto_address = '$google_auto_address', pincode = '$pincode', latitude = '$latitude',longitude='$longitude' WHERE id = '$address_id'");
	 				if($query){
						$address = $db->query("SELECT *, id as address_id FROM user_address WHERE id = '$address_id'");
						$feaddress = $address->fetch(PDO::FETCH_ASSOC);
	 					$status = 1;
						$message = "User address update successfully";
						$data = $feaddress;
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