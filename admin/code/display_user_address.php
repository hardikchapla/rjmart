<?php
include('../../connection/connection.php');
$user_id = (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') ? $_REQUEST['user_id']:0;
$reoutput = array();
$query = "SELECT * FROM user_address WHERE user_id = '$user_id' ORDER BY id DESC";
$statement = $db->query($query);
$result = $statement->fetchAll();
$data = array();
$i = 1;
foreach($result as $row)
{
    $sub_array = array();
    $sub_array[] = $i;
    $sub_array[] = $row['full_name'];
    $sub_array[] = $row["mobile_number"];
    $sub_array[] = $row["alt_mobile_number"];
    $sub_array[] = $row['house_no'];
    $sub_array[] = $row['building_name'];
    $sub_array[] = $row['road_area_colony'];
    $sub_array[] = $row['main_area'];
    $sub_array[] = $row['landmark'];
    $sub_array[] = $row['city'];
    $sub_array[] = $row['state'];
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>