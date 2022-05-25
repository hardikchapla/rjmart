<?php
include('../../connection/connection.php');
$user_id = (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') ? $_REQUEST['user_id']:0;
$reoutput = array();
$user = $db->query("SELECT * FROM user WHERE user_type = 1 AND active = 1");
$feuser = $user->fetchAll();
$kbc = '';
foreach($feuser as $ab){
    $kbc .= '<option value="'.$ab['id'].'">'.$ab["fullname"].'</option>';
}

$query = "SELECT a.*,b.full_name,count(c.order_items_id) as order_item FROM product_order a, user_address b, order_items c WHERE a.user_address_id = b.id AND a.id = c.order_id AND a.order_status = '0' GROUP BY c.order_id ORDER BY a.id DESC";
$statement = $db->query($query);
$result = $statement->fetchAll();
$data = array();
$i = 1;
foreach($result as $row)
{
    $sub_array = array();
    $sub_array[] = $i;
    $sub_array[] = $row['order_number'];
    $sub_array[] = $row["full_name"];
    $sub_array[] = $row["order_item"];
    $sub_array[] = $row['total_amount'];
    $sub_array[] = $row['payment_type'];
    $sub_array[] = '<button class="btn btn-outline-danger cancelOrder"  id="'.$row["id"].'" type="button" >Cancel Order</button>';
    $sub_array[] =  '<select class="form-control assigndeliveryboy" id="'.$row["id"].'"><option>Select Delivery Boy</option>'.$kbc.'</select>';
    $sub_array[] = '<a href="user-orders.php?id='.$row["id"].'"><button class="btn btn-outline-info userProfileDetails" type="button" >View</button></a>';
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>