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
 		$user_id = $_REQUEST['user_id'];
 		$date = date('Y-m-d H:i:s');
 		$path = 'http://'.$_SERVER['SERVER_NAME'].'/assets/img/category/';
 		$sliderpath = 'http://'.$_SERVER['SERVER_NAME'].'/assets/img/slider/';
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$cat = $db->query("SELECT * FROM category");
 			if($cat->rowCount() > 0){
 				$bb = array();
 				$aa = array();
 				$a = 0;
 				while ($fecat = $cat->fetch()) {
 					$aa[$a]['category_id'] = $fecat['id'];
 					$aa[$a]['image'] = !empty($fecat['image']) ? $path.$fecat['image']:'';
 					$aa[$a]['name'] = $fecat['name'];
 					/*$slider = $db->query("SELECT * FROM slider WHERE category_id = '".$fecat['id']."'");
 					if($slider->rowCount() > 0){
 						$feslider = $slider->fetch();
 						$aa[$a]['slider_id'] = $feslider['slider_id'];
 						$aa[$a]['slider_image'] = $sliderpath.$feslider['slider_image'];
 					} else {
 						$aa[$a]['slider_id'] = '';
 						$aa[$a]['slider_image'] = '';
 					}*/
 					$slider = $db->query("SELECT * FROM slider");
 					$s = 0;
 					$ss = array();
 					while($feSlider = $slider->fetch()){
 					    $ss[$s]['slider_id'] = $feSlider['slider_id'];
 					    $ss[$s]['category_id'] = $feSlider['category_id'];
 					    $ss[$s]['slider_image'] = $sliderpath.$feSlider['slider_image'];
 					    $s++;
 					}
 					$a++;
 				}
 				
 				$status = 1;
				$message = "Category List";
				$data['slider'] = $ss;
				$data['category'] = $aa;
				$data['user'] = $checkmobile->fetch(PDO::FETCH_ASSOC);
 			} else {
 				$status = 1;
				$message = "Category not available";
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