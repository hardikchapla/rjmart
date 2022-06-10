<?php
include('../../connection/connection.php');
$reoutput = array();

$query = "SELECT a.*,b.full_name,count(c.order_items_id) as order_item FROM product_order a, user_address b, order_items c WHERE a.user_address_id = b.id AND a.id = c.order_id AND a.order_status = '3' GROUP BY c.order_id ORDER BY a.id DESC";
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
    if($row['is_cancel_by_admin'] == 1){
        $sub_array[] = "Admin";
    } else {
        $sub_array[] = "User";
    }
    $sub_array[] = '<a href="user-orders.php?id='.$row["id"].'"><button class="btn btn-outline-info userProfileDetails" type="button" >View</button></a>';
    if($row["is_refund"] == '1'){
        $sub_array[] = 'Refunded';
    } else {
        $sub_array[] = '<button class="btn btn-info sendRefund" type="button" id="'.$row["id"].'">Refund</button>';
    }
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>