<?php
	include "../connection/connection.php";
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
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$checkaddress = $db->query("SELECT * FROM user_address WHERE user_id = '$user_id'");
 			if($checkaddress->rowCount() > 0){
 				$aa = array();
 				$a = 0;
 				while ($feaddress = $checkaddress->fetch()) {
 					$aa[$a]['address_id'] = $feaddress['id'];
 					$aa[$a]['user_id'] = $feaddress['user_id'];
 					$aa[$a]['full_name'] = $feaddress['full_name'];
 					$aa[$a]['mobile_number'] = $feaddress['mobile_number'];
 					// $aa[$a]['alt_mobile_number'] = $feaddress['alt_mobile_number'];
 					$aa[$a]['house_no'] = $feaddress['house_no'];
 					$aa[$a]['floor_no'] = $feaddress['floor_no'];
 					$aa[$a]['tower_no'] = $feaddress['tower_no'];
 					$aa[$a]['building_name'] = $feaddress['building_name'];
 					// $aa[$a]['road_area_colony'] = $feaddress['road_area_colony'];
 					// $aa[$a]['main_area'] = $feaddress['main_area'];
 					$aa[$a]['landmark'] = $feaddress['landmark'];
 					// $aa[$a]['city'] = $feaddress['city'];
 					$aa[$a]['address'] = $feaddress['address'];
 					$aa[$a]['google_auto_address'] = $feaddress['google_auto_address'];
 					$aa[$a]['pincode'] = $feaddress['pincode'];
 					$aa[$a]['state'] = $feaddress['state'];
 					$aa[$a]['latitude'] = $feaddress['latitude'];
 					$aa[$a]['longitude'] = $feaddress['longitude'];
 					$aa[$a]['is_default'] = $feaddress['is_default'];
 					$a++;
 				}
 				$status = 1;
				$message = "Address list";
				$data = $aa;
 			} else {
 				$status = 0;
				$message = "Address not availabile";
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