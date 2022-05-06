<?php
	include('../../connection/connection.php');
	if(isset($_POST["id"]))
	{
		$order_id = $_POST['id'];
		$order = $db->query("SELECT * FROM product_order WHERE id = '$order_id'");
		$feorder = $order->fetch();
		if($feorder['order_status'] == 0){
		    $order_status = 'Pending';
		} elseif ($feorder['order_status'] == 1){
		    $order_status = 'Confirmed';
		} elseif ($feorder['order_status'] == 2){
		    $order_status = 'Shipped';
		} else {
		    $order_status = 'Cancel';
		}
        if($feorder['payment_type'] == 'cash'){
            $paymentType = 'COD';
        }else{
            $paymentType = 'Paytm';
        }
		$user_address_id = $feorder['user_address_id'];
		$user_address = $db->query("SELECT * FROM user_address WHERE id = '$user_address_id'");
		$feaddress = $user_address->fetch();
		$order_date = date('d M Y',strtotime($feorder['created']));
		// $response = '';
		// $response .= '<table class="sheet padding-10mm" style="border:1px solid #333;border-collapse:collapse;margin:0 auto;width:740px;"><thead><tr style="padding:12px; border:1px solid #333; width:185px;"><th colspan="3" style="padding:12px; border:1px solid #333; width:185px;color: #000;">'.$feorder['order_number'].'</th><th colspan="2" style="padding:12px; border:1px solid #333; width:185px;color: #000;text-align: center;">'.$order_date.'</th></tr><tr style="padding:12px; border:1px solid #333; width:185px; padding-top: 0; padding-bottom: 0;"><th colspan="2" style="padding:12px; border:1px solid #333; width:185px;color: #000;padding-top: 0; padding-bottom: 0;"><img src="assets/img/Logo_jpg.png" width="400" height="200"></th><th colspan="3" style="padding:12px; border:1px solid #333; width:185px;color: #000;"><h4 style="color: #000;">From:</h4><p style="color: #000; font-weight: 500;"> <b>Customer Care:</b> +91 90817 01091<br> Gujarat Fruits & Vegetables APP, <br> 97, Nana Varachha, Co. Housing Soc, <br> Nr. Moti Nagar Soc. Nana Varachha, <br> Surat - 395013</p></th></tr><tr style="padding:12px; border:1px solid #333; width:185px;"><td colspan="2" style="padding:12px;border:1px solid #333;width:185px;"><p style="text-align:center;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$feorder['order_number'].'&choe=UTF-8" title="Order Number" width="150px" height="150px"/></p></td><td colspan="3" style="padding:12px; border:1px solid #333; width:185px;"><h4 style="color: #000;">Customer:</h4><p style="color: #000;"> Name : '.$feaddress['full_name'].'<br> Address : '.$feaddress['house_no'].', '.$feaddress['building_name'].', '.$feaddress['road_area_colony'].'<br>'.$feaddress['main_area'].', '.$feaddress['landmark'].', '.$feaddress['city'].', '.$feaddress['state'].'<br>Mobile No : '.$feaddress['mobile_number'].'</p></td></tr></thead><tbody><tr><th style="padding:12px; border:1px solid #333; width:185px;color: #000;">Product</th><th style="padding:12px; border:1px solid #333; width:185px;color: #000;">Qty.</th><th style="padding:12px; border:1px solid #333; width:185px;color: #000;">@</th><th style="padding:12px; border:1px solid #333; width:185px;color: #000;">Cost</th><th style="padding:12px; border:1px solid #333; width:185px;color: #000;">Total Cost</th></tr>';
		// $items = $db->query("SELECT a.*,b.*,c.* FROM order_items a, product b, product_type c WHERE a.product_id = b.id AND a.product_type_id = c.product_type_id AND a.order_id = '$order_id'");
		// while($feitems = $items->fetch()){
		//     $total_amt = $feitems['product_type_price'] * $feitems['qty'];
		// 	$response .= '<tr style="padding:12px; border:1px solid #333; width:185px;color: #000;font-weight: 500;"> <th style="padding:12px; border:1px solid #333; width:185px;color: #000;font-weight: 500;">'.$feitems['name'].'</th> <th style="padding:12px; border:1px solid #333; width:185px;color: #000;font-weight: 500;">'.$feitems['qty'].'</th> <th style="padding:12px; border:1px solid #333; width:185px;color: #000;font-weight: 500;">'.$feitems['Product_qty'].' - '.$feitems['product_type'].'</th> <th style="padding:12px; border:1px solid #333; width:185px;color: #000;font-weight: 500;">'.$feitems['product_type_price'].'</th><th style="padding:12px; border:1px solid #333; width:185px;color: #000;font-weight: 500;">'.$total_amt.'</th> </tr>';
		// }
		// $response .= '</tbody><tfoot><tr><th style="color: #000;text-align: right;">Payment Type:</th><td style="color: #000;font-weight: 700;text-align: left; padding-left:20px;">'.$paymentType.'</td><th colspan="2" style="color: #000;text-align: right;">Grand Total:</th><td style="color: #000;font-weight: 700;text-align: left; padding-left:20px;">₹'.$feorder['total_amount'].'</td></tr></tfoot></table>';

		$response = '';
		$response .= '<div style="width: 80%; border:1px solid;margin: auto;"> <div style="width: 100%; display: inline-flex;"> <div style="width: 70%;border-right: 1px solid;border-bottom: 1px solid;height: 30px;"> <p style="padding-left: 20px;margin-top: 5px;">'.$feorder['order_number'].'</p></div><div style="width: 30%;border-bottom: 1px solid;height: 30px;"> <p style="padding-right: 20px; text-align: right;margin-top: 5px;">'.$order_date.'</p></div></div><div style="width: 100%; display: inline-flex; border-bottom: 1px solid;"> <div style="width: 30%;border-right: 1px solid;text-align: center;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$feorder['order_number'].'&choe=UTF-8" title="Order Number" width="120px" height="120px"></div><div style="width: 40%;border-right: 1px solid;"> <h4 style="padding-left: 20px;">Customer</h4> <p style="padding-left: 20px;">Name : '.$feaddress['full_name'].'<br>Address : '.$feaddress['house_no'].', '.$feaddress['building_name'].', '.$feaddress['road_area_colony'].','.$feaddress['main_area'].', '.$feaddress['landmark'].', '.$feaddress['city'].', '.$feaddress['state'].'<br>Mobile No : '.$feaddress['mobile_number'].'</p></div><div style="width: 30%;text-align: center;"><img src="assets/img/Logo_jpg.png" title="Order Number" width="150px" height="100px"></div></div><table style="width:100%;border-collapse: collapse;"> <tr style="border-bottom: 1px solid;"> <th style="border-right: 1px solid;">Product</th> <th style="width: 10%;border-right: 1px solid;">Qty</th> <th style="width: 10%;border-right: 1px solid;">@</th> <th style="width: 10%;border-right: 1px solid;">Cost</th> <th style="width: 20%;">Total Cost</th> </tr>';
		$items = $db->query("SELECT a.*,b.*,c.* FROM order_items a, product b, product_type c WHERE a.product_id = b.id AND a.product_type_id = c.product_type_id AND a.order_id = '$order_id'");
		while($feitems = $items->fetch()){
		    $total_amt = $feitems['product_type_price'] * $feitems['qty'];
			$response .= '<tr style="border-bottom: 1px solid;"> <td style="border-right: 1px solid;padding: 5px;">'.$feitems['name'].'</td><td style="border-right: 1px solid;padding: 5px;">'.$feitems['qty'].'</td><td style="border-right: 1px solid;padding: 5px;">'.$feitems['Product_qty'].' - '.$feitems['product_type'].'</td><td style="border-right: 1px solid;padding: 5px;">₹'.$feitems['product_type_price'].'</td><td style="padding: 5px;">₹'.$total_amt.'</td></tr>';
		}

		$response .= '</table><div style="width: 100%; display: inline-flex;height: 40px;"><div style="width: 30%;border-right: 1px solid;"><p style="padding-left: 20px;margin-top: 3px;">Customer Care: +91 90817 01091</p></div><div style="width: 30%;border-right: 1px solid;"><p style="padding-left: 20px; text-align: left;margin-top: 3px;">Payment Type: '.$paymentType.'</p></div><div style="width: 40%;"><p style="padding-right: 20px; text-align: right;margin-top: 3px;">Grand Total:₹'.$feorder['total_amount'].'</p></div></div></div>';
		$abc = array();
		$abc['display'] = $response;
		echo json_encode($abc);
		die;
	}
?>