<?php
include('../../connection/connection.php');
$user_id = (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') ? $_REQUEST['user_id']:0;
$reoutput = array();
$query = "SELECT a.*,b.full_name,count(c.order_items_id) as order_item FROM product_order a, user_address b, order_items c WHERE a.user_address_id = b.id AND a.id = c.order_id AND (a.order_status = '1' OR a.order_status = '4') GROUP BY c.order_id ORDER BY a.id DESC";
$statement = $db->query($query);
$result = $statement->fetchAll();
$data = array();
$i = 1;
foreach($result as $row)
{
    $sub_array = array();
    $sub_array[] = $i;
    $sub_array[] = '<a type="href" href="user-orders.php?id='.$row["id"].'">'.$row['order_number'].'</a>';
    $sub_array[] = $row["full_name"];
    $sub_array[] = $row["order_item"];
    $sub_array[] = $row['total_amount'];
    $sub_array[] = $row['payment_type'];
    if($row['order_status'] == 1){
        $sub_array[] = '<button class="btn btn-info fa fa-trash shippedorder" type="button" id="'.$row["id"].'" >Shipped</button>';
    } else {
        $sub_array[] = '<button class="btn btn-success fa fa-trash completeorder" type="button" id="'.$row["id"].'" >Completed</button>';
    }
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>