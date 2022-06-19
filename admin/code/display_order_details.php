<?php
include('../../connection/connection.php');
$reoutput = array();
$order_id = $_REQUEST['order_id'];
$query = "SELECT a.*,b.*,c.* FROM order_items a, product b, product_type c WHERE a.product_id = b.id AND a.product_type_id = c.product_type_id AND a.order_id = '$order_id'";
$statement = $db->query($query);
$result = $statement->fetchAll();
$data = array();
$i = 1;
foreach($result as $row)
{
    $selectImages = $db->query("SELECT * FROM product_image WHERE p_id = '$row[id]'");
    $fetchImage = $selectImages->fetch();
    $image = '';
    if($fetchImage['image'] != ''){
        $image = '<img src="../assets/img/product/'.$fetchImage["image"].'" style = "width:50px; height:50px;" />';
    } else {
        $image = '<img src="../assets/img/product/product.jpg" style = "border-radius: 40px" width="40" height="40" />';
    }
    $getCat = $db->query("SELECT * FROM category WHERE id = '$row[cat_id]'");
    $fetchCat = $getCat->fetch();
    $catName = $fetchCat['name'];
    $sub_array = array();
    $sub_array[] = $i;
    $sub_array[] = $image;
    $sub_array[] = $catName;
    $sub_array[] = $row["name"];
    $sub_array[] = '<div class="product_desc_view"> <button type="button" class="btn btn-outline-info view_plan_details mr-2" data-toggle="modal" data-target="#exampleModal" id="'.$row["id"].'">View</button></div>
      					';
    $sub_array[] = $row["offer"];
    $sub_array[] = $row["product_type"];
    $sub_array[] = $row["Product_qty"];
    $sub_array[] = '₹'.$row["product_type_price"];
    $sub_array[] = $row["qty"];
    $data[] = $sub_array;
    $i++;
}
$reoutput = array(
    "data"=>$data
);
echo json_encode($reoutput);
?>