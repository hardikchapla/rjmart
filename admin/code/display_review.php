<?php
include('../../connection/connection.php');
$reoutput = array();
$query = "SELECT a.*,b.fullname as user_name,b.*,c.fullname as deliver_name,c.*,d.* FROM review a, user b, user c, product_order d WHERE a.user_id = b.id AND a.deliver_id = c.id AND a.order_id = d.id ORDER BY a.review_id DESC";
$statement = $db->query($query);
$result = $statement->fetchAll();
$data = array();
$i = 1;
foreach($result as $row)
{
    if($row['review'] == 0){
        $kk = '<span class="fa fa-star"></span>';
        $kk .= '<span class="fa fa-star"></span>';
        $kk .= '<span class="fa fa-star"></span>';
        $kk .= '<span class="fa fa-star"></span>';
        $kk .= '<span class="fa fa-star"></span>';
    }
    if($row['review'] == 1){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    if($row['review'] == 2){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    if($row['review'] == 3){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
    }
    if($row['review'] == 4){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    if($row['review'] == 5){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
    }

    $sub_array = array();
    $sub_array[] = $i;
    $sub_array[] = '<a type="button" href="user-orders.php?id='.$row["order_id"].'">'.$row["order_number"].'</a>';;
    $sub_array[] = $row["user_name"];
    $sub_array[] = $row["deliver_name"];
    $sub_array[] = $kk;
    $sub_array[] = $row["description"];
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>