<?php
	include('../../connection/connection.php');
	$reoutput = array();
	$query = "SELECT * FROM terms_and_conditions ORDER BY id DESC";
	$statement = $db->query($query);
	$result = $statement->fetchAll();
	$data = array();
	$i = 1;
	foreach($result as $row)
	{
		$sub_array = array();
		$sub_array[] = $i;
		$sub_array[] = $row["slug"];
		$sub_array[] = '<div class="product_desc_view"> <button type="button" class="btn btn-outline-info view_plan_details mr-2" data-toggle="modal" data-target="#exampleModal" id="'.$row["id"].'">View</button></div>
      					';
		$sub_array[] = '<button class="btn btn-primary fa fa-pencil updatePrivacyPolicy" type="button" id="'.$row["id"].'">Edit</button>';
		$data[] = $sub_array;
		$i++;
	}
	$reoutput = array(
		"data"=>$data
	);
	echo json_encode($reoutput);
?>