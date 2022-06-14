<?php
include('../../connection/connection.php');
$reoutput = array();
$query = "SELECT a.*,b.* FROM notification a,user b WHERE a.sender_id = b.id AND a.receiver_type = 1 AND a.is_read = 0 ORDER BY a.id DESC";
$statement = $db->query($query);
$result = $statement->fetchAll();
$update = $db->query("UPDATE notification SET is_read = 1 WHERE receiver_type = 1 AND is_read = 0");
$data = array();
$i = 1;
foreach($result as $row)
{
    $image = '';
    if($row['avatar'] != ''){
        $image = '<img src="../assets/img/user/'.$row["avatar"].'" style = "border-radius: 40px" width="40" height="40" />';
    } else {
        $image = '<img src="../assets/img/user/default.png" style = "border-radius: 40px" width="40" height="40" />';
    }
    $sub_array = array();
    $sub_array[] = $i;
    $sub_array[] = $image;
    $sub_array[] = $row["fullname"];
    $sub_array[] = $row["title"];
    $sub_array[] = $row['message'];
    $sub_array[] = $row['type'];
    // if($row['type'] == 'new_register'){
    //     $sub_array[] = '<a class="btn btn-outline-info userProfileDetails" type="button" href="user-details.php?id='.$row["sender_id"].'">View</a>';
    // } else {
    //     $sub_array[] = '<a class="btn btn-outline-info userProfileDetails" type="button" href="user-orders.php?id='.$row["order_id"].'">View</a>';
    // }
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>