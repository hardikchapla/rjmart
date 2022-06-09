<?php
include('../../connection/connection.php');
$reoutput = array();
$query = "SELECT * FROM user WHERE user_type = '1'";
$statement = $db->query($query);
$result = $statement->fetchAll();
$data = array();
$i = 1;
foreach($result as $row)
{
    $review = $db->query("SELECT AVG(review) as avarage FROM review WHERE deliver_id = '".$row['id']."' ORDER BY review_id DESC ");
    $fereview = $review->fetch();
    $average = round($fereview['avarage']);
    $kk = '';
    if($average == 0){
        $kk = '<span class="fa fa-star"></span>';
        $kk .= '<span class="fa fa-star"></span>';
        $kk .= '<span class="fa fa-star"></span>';
        $kk .= '<span class="fa fa-star"></span>';
        $kk .= '<span class="fa fa-star"></span>';
    }
    if($average == 1){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    if($average == 2){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    if($average == 3){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
    }
    if($average == 4){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    if($average == 5){
        $kk = '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
        $kk .= '<i class="fa fa-star checked" aria-hidden="true"></i>';
    }
    
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
    $sub_array[] = $row["email"];
    $sub_array[] = $row['mobile'];
    // $sub_array[] = $kk;
    $sub_array[] = '<a href="delivery_boy_details.php?id='.$row["id"].'"><button class="btn btn-outline-info userProfileDetails" type="button" >View</button></a>';
    $sub_array[] = '<button class="btn btn-danger fa fa-trash deleteUser" type="button" id="'.$row["id"].'" >Delete</button>';
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>