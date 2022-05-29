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
 		$path = BASE_URL.'assets/img/category/';
 		$sliderpath = BASE_URL.'assets/img/slider/';
		$product_path = BASE_URL.'assets/img/product/';
 		$checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
 			$cat = $db->query("SELECT * FROM category WHERE is_active = 1");
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
 					$slider = $db->query("SELECT * FROM slider WHERE is_active=1");
 					$s = 0;
 					$ss = array();
 					while($feSlider = $slider->fetch()){
 					    $ss[$s]['slider_id'] = $feSlider['slider_id'];
 					    $ss[$s]['category_id'] = $feSlider['category_id'];
 					    $ss[$s]['slider_type'] = $feSlider['slider_type'];
 					    $ss[$s]['slider_image'] = $sliderpath.$feSlider['slider_image'];
 					    $s++;
 					}
 					$a++;
 				}
				$dd = array();
				$d = 0;
				$cat = $db->query("SELECT * FROM product WHERE cat_id = '1' ORDER BY RAND() LIMIT 0, 4");
				if($cat->rowCount() > 0){
					while ($fecat = $cat->fetch()) {
						$dd[$d]['product_id'] = $fecat['id'];
						$dd[$d]['name'] = $fecat['name'];
						$dd[$d]['description'] = $fecat['description'];
						$dd[$d]['offer'] = $fecat['offer'];
						$dd[$d]['is_active'] = $fecat['is_active'];
						$images = $db->query("SELECT * FROM product_image WHERE p_id = '".$fecat['id']."'");
						$bb = array();
						$b = 0;
						if($images->rowCount() > 0){
							while ($feimages = $images->fetch()) {
								$bb[$b]['image_id'] = $feimages['id'];
								$bb[$b]['product_image'] = $product_path.$feimages['image'];
								$b++;
							}
						}
						$dd[$d]['images'] = $bb;
						$cc = array();
						$c = 0;
						$ptype = $db->query("SELECT * FROM product_type WHERE product_id = '".$fecat['id']."'");
						if($ptype->rowCount() > 0){
							while ($feptype = $ptype->fetch()) {
								$cc[$c]['product_type_id'] = $feptype['product_type_id'];
								$cc[$c]['product_type'] = $feptype['product_type'];
								$cc[$c]['Product_qty'] = $feptype['Product_qty'];
								$cc[$c]['product_type_price'] = $feptype['product_type_price'];
								$cc[$c]['Product_type_qty'] = $feptype['Product_qty'].' '.$feptype['product_type'];
								$check_cart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND p_id = '".$fecat['id']."' AND product_type_id = '".$feptype['product_type_id']."'");
								if($check_cart->rowCount() > 0){
									$fecart = $check_cart->fetch();
									$cc[$c]['is_cart'] = intval($fecart['qty']);
								} else {
									$cc[$c]['is_cart'] = 0;
								}
								
								$c++;
							}
						}
						$dd[$d]['product_type'] = $cc;
						$d++;
					}
				}

				$kk = array();
				$k = 0;
				$cat1 = $db->query("SELECT * FROM product WHERE cat_id = '2' ORDER BY RAND() LIMIT 0, 4");
				if($cat1->rowCount() > 0){
					while ($fecat1 = $cat1->fetch()) {
						$kk[$k]['product_id'] = $fecat1['id'];
						$kk[$k]['name'] = $fecat1['name'];
						$kk[$k]['description'] = $fecat1['description'];
						$kk[$k]['offer'] = $fecat1['offer'];
						$kk[$k]['is_active'] = $fecat1['is_active'];
						$images = $db->query("SELECT * FROM product_image WHERE p_id = '".$fecat1['id']."'");
						$bb = array();
						$b = 0;
						if($images->rowCount() > 0){
							while ($feimages = $images->fetch()) {
								$bb[$b]['image_id'] = $feimages['id'];
								$bb[$b]['product_image'] = $product_path.$feimages['image'];
								$b++;
							}
						}
						$kk[$k]['images'] = $bb;
						$cc = array();
						$c = 0;
						$ptype = $db->query("SELECT * FROM product_type WHERE product_id = '".$fecat1['id']."'");
						if($ptype->rowCount() > 0){
							while ($feptype = $ptype->fetch()) {
								$cc[$c]['product_type_id'] = $feptype['product_type_id'];
								$cc[$c]['product_type'] = $feptype['product_type'];
								$cc[$c]['Product_qty'] = $feptype['Product_qty'];
								$cc[$c]['product_type_price'] = $feptype['product_type_price'];
								$cc[$c]['Product_type_qty'] = $feptype['Product_qty'].' '.$feptype['product_type'];
								$check_cart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND p_id = '".$fecat1['id']."' AND product_type_id = '".$feptype['product_type_id']."'");
								if($check_cart->rowCount() > 0){
									$fecart = $check_cart->fetch();
									$cc[$c]['is_cart'] = intval($fecart['qty']);
								} else {
									$cc[$c]['is_cart'] = 0;
								}
								
								$c++;
							}
						}
						$kk[$k]['product_type'] = $cc;
						$k++;
					}
				}
 				
 				$status = 1;
				$message = "Category List";
				$data['slider'] = $ss;
				$data['category'] = $aa;
				$data['vegetables'] = $dd;
				$data['fruits'] = $kk;
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