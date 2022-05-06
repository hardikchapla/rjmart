<?php
	include('../../connection/connection.php');
	$reoutput = array();
	$query = "SELECT * FROM product ORDER BY id DESC";
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
        if($row["is_active"] == '1'){
        	$status = '<button class="btn btn-warning fa fa-pencil changeStatus" type="button" id="'.$row["id"].'" key="0">Deactivate</button>';
        }else{
        	$status = '<button class="btn btn-info fa fa-pencil changeStatus" type="button" id="'.$row["id"].'" key="1">Activate</button>';
        }
        $getCat = $db->query("SELECT * FROM category WHERE id = '$row[cat_id]'");
        $fetchCat = $getCat->fetch();
        $catName = $fetchCat['name'];
		$sub_array = array();
		$sub_array[] = $i;
		$sub_array[] = $catName;
		$sub_array[] = $image;
		$sub_array[] = $row["name"];
		/*$sub_array[] = '₹ '.$row["price"];*/
		$sub_array[] = '<div class="product_desc_view"> <button type="button" class="btn btn-outline-info view_plan_details mr-2" data-toggle="modal" data-target="#exampleModal" id="'.$row["id"].'">View</button></div>
      					';
      	$sub_array[] = $status;
		$sub_array[] = '<button class="btn btn-primary fa fa-pencil updateSubCategory" type="button" id="'.$row["id"].'">Edit</button>';
		// $sub_array[] = '<a class="btn btn-info userProfileDetails" type="button" href="product-details.php?id='.$row["id"].'">View</a>';
		$sub_array[] = '<button class="btn btn-danger fa fa-trash deleteSubCategory" type="button" id="'.$row["id"].'" >Delete</button>';
		$data[] = $sub_array;
		$i++;
	}
	$reoutput = array(
		"data"=>$data
	);
	echo json_encode($reoutput);
?>
