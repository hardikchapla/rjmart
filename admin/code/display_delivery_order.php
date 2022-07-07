<?php
include('../../connection/connection.php');
$user_id = (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') ? $_REQUEST['user_id']:0;
$start_date = (isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != '') ? $_REQUEST['start_date']:'';
$end_date = (isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != '') ? $_REQUEST['end_date']:'';
$status = $_REQUEST['status'];
$reoutput = array();
if($start_date != '' && $end_date != ''){
    $start_date = str_replace('/','-',$_REQUEST['start_date']);
    $end_date = str_replace('/','-',$_REQUEST['end_date']);
    $query = "SELECT k.id as request_id,k.*,a.*,b.full_name,count(c.order_items_id) as order_item FROM near_by_request k, product_order a, user_address b, order_items c WHERE k.order_id = a.id AND a.user_address_id = b.id AND k.order_id = c.order_id AND k.to_id = '$user_id' AND k.status = '$status' AND DATE_FORMAT(a.created,'%Y-%m-%d') BETWEEN '$start_date' AND '$end_date' GROUP BY c.order_id ORDER BY k.id DESC";
} else {
    $query = "SELECT k.id as request_id,k.*,a.*,b.full_name,count(c.order_items_id) as order_item FROM near_by_request k, product_order a, user_address b, order_items c WHERE k.order_id = a.id AND a.user_address_id = b.id AND k.order_id = c.order_id AND k.to_id = '$user_id' AND k.status = '$status' GROUP BY c.order_id ORDER BY k.id DESC";
}
$statement = $db->query($query);
$result = $statement->fetchAll();
$data = array();
$i = 1;
foreach($result as $row)
{
    if($row['order_status'] == 0){
        $order_status = '<span class="label warning1">Pending</span>';
    } elseif ($row['order_status'] == 1) {
        $order_status = '<span class="label info1">Confirmed</span>';
    } elseif($row['order_status'] == 2) {
        $order_status = '<span class="label success1">Completed</span>';
    } elseif($row['order_status'] == 4) {
        $order_status = '<span class="label success1">Shipped</span>';    
    } else {
        $order_status = '<span class="label danger1">Cancelled</span>';
    }
    $sub_array = array();
    $sub_array[] = $i;
    $sub_array[] = $row['order_number'];
    $sub_array[] = $row["full_name"];
    $sub_array[] = $row["order_item"];
    $sub_array[] = '₹'.$row['total_amount'];
    $sub_array[] = $order_status;
    $sub_array[] = $row['payment_type'];
    $sub_array[] = '<a href="delivery-orders.php?id='.$row["id"].'"><button class="btn btn-outline-info userProfileDetails" type="button" >View</button></a>';
    
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>