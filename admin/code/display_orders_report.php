<?php
include('../../connection/connection.php');
$start_date = str_replace('/','-',$_REQUEST['start_date']);
$end_date = str_replace('/','-',$_REQUEST['end_date']);
if($start_date == '' && $end_date == ''){
    $query = "SELECT a.*,b.full_name,count(c.order_items_id) as order_item FROM product_order a, user_address b, order_items c WHERE a.user_address_id = b.id AND a.id = c.order_id AND a.order_status = '2' GROUP BY c.order_id ORDER BY a.id DESC";
} else {
    $query = "SELECT a.*,b.full_name,count(c.order_items_id) as order_item FROM product_order a, user_address b, order_items c WHERE a.user_address_id = b.id AND a.id = c.order_id AND a.order_status = '2' AND DATE_FORMAT(a.created,'%Y-%m-%d') Between '$start_date' AND '$end_date' GROUP BY c.order_id ORDER BY a.id DESC";
}
$reoutput = array();

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
    $sub_array[] = '₹'.$row['total_amount'];
    $sub_array[] = $row['payment_type'];
    $sub_array[] = '<a href="user-orders.php?id='.$row["id"].'"><button class="btn btn-outline-info userProfileDetails" type="button" >View</button></a>';
    
    $sub_array[] = '<div class="product_desc_view"> <button type="button" class="btn btn-outline-info view_plan_details mr-2" data-toggle="modal" data-target="#exampleModal" id="'.$row["id"].'">Invoice</button></div>';
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>