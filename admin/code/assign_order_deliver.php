<?php

require_once '../../connection/connection.php';
require_once "../../helper/core_function.php";
include "../../helper/constant.php";

if (isset($_REQUEST['order_id']) && isset($_REQUEST['user_id'])) {

    $order_id = $_REQUEST['order_id'];

    $user_id = $_REQUEST['user_id'];



    $order = $db->query("SELECT * FROM product_order WHERE id = '$order_id'");

    $feorder1 = $order->fetch();

    $from_id = $feorder1['user_id'];

    $date = date('Y-m-d H:i:s');

    $request = $db->query("INSERT INTO near_by_request SET from_id = '$from_id', to_id = '$user_id', status = 1, order_id = '$order_id',created = '$date',updated = '$date'");
    $update_user = $db->query("UPDATE user SET active = 0 WHERE id = '$user_id'");
    $update_order = $db->query("UPDATE product_order SET order_status = 1 WHERE id = '$order_id'");
    $order_details = $db->query("SELECT a.created as orderdt,a.id as order_id,a.*,b.* FROM product_order a,user_address b WHERE a.user_address_id = b.id AND a.id = '$order_id'");
    $feorder = $order_details->fetch();
    $path = BASE_URL.'assets/img/product/';
    $aa = array();
    $aa['order_id'] = $feorder['order_id'];
    $aa['order_number'] = $feorder['order_number'];
    $aa['user_id'] = $feorder['user_id'];
    $aa['user_address_id'] = $feorder['user_address_id'];
    $aa['total_amount'] = $feorder['total_amount'];
    $aa['payment_type'] = $feorder['payment_type'];
    $aa['order_status'] = $feorder['order_status'];
    $aa['full_name'] = $feorder['full_name'];
    $aa['mobile_number'] = $feorder['mobile_number'];
    $aa['alt_mobile_number'] = $feorder['alt_mobile_number'];
    $aa['house_no'] = $feorder['house_no'];
    $aa['building_name'] = $feorder['building_name'];
    $aa['main_area'] = $feorder['main_area'];
    $aa['landmark'] = $feorder['landmark'];
    $aa['city'] = $feorder['city'];
    $aa['state'] = $feorder['state'];

    $aa['delivery_date'] = ($feorder['order_date']) ? $feorder['order_date']:'';

    $aa['order_date'] = ($feorder['orderdt']) ? $feorder['orderdt']:'';

    $order_items = $db->query("SELECT a.*,b.*,c.* FROM order_items a, product b,product_type c WHERE a.product_id = b.id AND a.product_type_id = c.product_type_id AND a.order_id = '$order_id'");

    $bb = array();

    $b = 0;

    if($order_items->rowCount() > 0){

        while ($feitems = $order_items->fetch()) {

            $bb[$b]['order_items_id'] = $feitems['order_items_id'];

            $bb[$b]['order_id'] = $feitems['order_id'];

            $bb[$b]['product_id'] = $feitems['product_id'];

            $bb[$b]['product_type_id'] = $feitems['product_type_id'];

            $bb[$b]['qty'] = $feitems['qty'];

            $bb[$b]['name'] = $feitems['name'];

            $bb[$b]['description'] = $feitems['description'];

            $bb[$b]['offer'] = $feitems['offer'];

            $bb[$b]['product_type'] = $feitems['product_type'];

            $bb[$b]['Product_qty'] = $feitems['Product_qty'];

            $bb[$b]['product_type_price'] = $feitems['product_type_price'];

            $images = $db->query("SELECT * FROM product_image WHERE p_id = '".$feitems['product_id']."' LIMIT 0,1");

            if($images->rowCount() > 0){

                $feimages = $images->fetch();

                $bb[$b]['images'] = $path.$feimages['image'];

            } else {

                $bb[$b]['images'] = '';

            }

            $b++;

        }

    }

    $aa['order_items'] = $bb;



    // send push notification

    $user = $db->query("SELECT * FROM user WHERE id = '$from_id'");
    $feuser = $user->fetch();

    $deliver = $db->query("SELECT * FROM user WHERE id = '$user_id'");
    $fedeliver = $deliver->fetch();

    $title = "Request Accepted";

    $data1 = array();

    $data1['message'] = "Your order has been assigned to ".$fedeliver['fullname'].", you will get the order soon.";
    sendPushNotification($feuser['device_token'], $title, $feuser['device_type'], $data1);
    $notification = $db->query("INSERT INTO notification SET receiver_id = '$from_id',order_id = '$order_id', title = 'Request Accepted', message = 'Your order has been assigned to ".$fedeliver['fullname'].", you will get the order soon.', `type` = 'order_accepted', receiver_type = '0', created = '$date'");

    $title1 = "Order assign";
    $data2 = array();
    $data2['message'] = "Admin has assigned to you on this order id ".$feorder['order_number'].". please, click here for more details.";
    $data2['data'] = $aa;
    sendPushNotificationDeliveryBoy($fedeliver['device_token'], $title1, $fedeliver['device_type'], $data2);
    $notification2 = $db->query("INSERT INTO notification SET receiver_id = '$user_id',order_id = '$order_id', title = 'Order assign', message = 'Admin has assigned to you on this order id ".$feorder['order_number'].". please, click here for more details.', `type` = 'order_assigned', receiver_type = '0', created = '$date'");
    echo "true";

}

?>