<?php
	include('../../connection/connection.php');
	$reoutput = array();
	$query = "SELECT * FROM category ORDER BY id DESC";
	$statement = $db->query($query);
	$result = $statement->fetchAll();
	$data = array();
	$i = 1;
	foreach($result as $row)
	{
	    $image = '';
	    if($row['image'] != ''){
            $image = '<img src="../assets/img/category/'.$row["image"].'" style = "border-radius: 40px" width="40" height="40" />';
        } else {
            $image = '<img src="../assets/img/category/cat.jpg" style = "border-radius: 40px" width="40" height="40" />';
        }
		$sub_array = array();
		$sub_array[] = $i;
		$sub_array[] = $image;
		$sub_array[] = $row["name"];
		if($row["is_active"] == '1'){
        	$sub_array[] = '<button class="btn btn-warning fa fa-pencil changeStatus" type="button" id="'.$row["id"].'" key="0">Deactivate</button>';
        }else{
        	$sub_array[] = '<button class="btn btn-info fa fa-pencil changeStatus" type="button" id="'.$row["id"].'" key="1">Activate</button>';
        }
		$sub_array[] = '<button class="btn btn-primary fa fa-pencil updateCategory" type="button" id="'.$row["id"].'">Edit</button>';
		$sub_array[] = '<button class="btn btn-danger fa fa-trash deleteCategory" type="button" id="'.$row["id"].'" >Delete</button>';
		$data[] = $sub_array;
		$i++;
	}
	$reoutput = array(
		"data"=>$data
	);
	echo json_encode($reoutput);
?>