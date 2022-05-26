<?php
	include('../../connection/connection.php');
	$reoutput = array();
	$query = "SELECT * FROM slider ORDER BY slider_id DESC";
	$statement = $db->query($query);
	$result = $statement->fetchAll();
	$data = array();
	$i = 1;
	foreach($result as $row)
	{
	    $image = '';
	    if($row['slider_image'] != '' && $row['slider_type'] == 0){
            $image = '<img src="../assets/img/slider/'.$row["slider_image"].'" style = "border-radius: 40px" width="40" height="40" />';
        } else {
            $image = '<img src="../assets/img/slider/Slider-Webpage-Fruits.jpg" style = "border-radius: 40px" width="40" height="40" />';
        }
        $selectCategory = $db->query("SELECT * FROM category WHERE id='$row[category_id]'");
        $feCat = $selectCategory->fetch();
        
		$sub_array = array();
		$sub_array[] = $i;
		$sub_array[] = $image;
		$sub_array[] = $feCat["name"];
		if($row['slider_type'] == 0){
			$sub_array[] = "Image";
		} else {
			$sub_array[] = "Video";
		}
		if($row["is_active"] == '1'){
        	$sub_array[] = '<button class="btn btn-warning fa fa-pencil changeStatus" type="button" id="'.$row["slider_id"].'" key="0">Deactivate</button>';
        }else{
        	$sub_array[] = '<button class="btn btn-info fa fa-pencil changeStatus" type="button" id="'.$row["slider_id"].'" key="1">Activate</button>';
        }
		$sub_array[] = '<button class="btn btn-primary fa fa-pencil updateCategory" type="button" id="'.$row["slider_id"].'">Edit</button>';
		$sub_array[] = '<button class="btn btn-danger fa fa-trash deleteCategory" type="button" id="'.$row["slider_id"].'" >Delete</button>';
		$data[] = $sub_array;
		$i++;
	}
	$reoutput = array(
		"data"=>$data
	);
	echo json_encode($reoutput);
?>