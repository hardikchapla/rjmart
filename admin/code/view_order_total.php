<?php
include('../../connection/connection.php');
$start_date = $_REQUEST['start_date'];
$end_date = $_REQUEST['end_date'];
$fStartDate = date('Y-m-d', strtotime($start_date));
$lEndDate = date('Y-m-d', strtotime($end_date));
$reoutput = array();
if($fStartDate == '' && $lEndDate == ''){
    $query = "SELECT sum(total_amount) as total_amount FROM product_order WHERE order_status = 2";
} else {
    $query = "SELECT sum(total_amount) as total_amount FROM product_order WHERE order_status = 2 AND DATE(created) BETWEEN '$fStartDate' AND '$lEndDate'";
}
$statement = $db->query($query);
$statement->execute();
$result = $statement->fetch();
$reoutput['total_amount'] = (isset($result['total_amount']) && $result['total_amount'] != '') ? $result['total_amount']:0;
echo json_encode($reoutput);
die;
?>