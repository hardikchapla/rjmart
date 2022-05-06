<?php
	include('../../connection/connection.php');
	$reoutput = array();
	$query = "SELECT * FROM pincode ORDER BY id DESC";
	$statement = $db->query($query);
	$result = $statement->fetchAll();
	$data = array();
	$i = 1;
	foreach($result as $row)
	{
		$sub_array = array();
		$sub_array[] = $i;
		$sub_array[] = $row["pincode"];
		$sub_array[] = '<button class="btn btn-primary fa fa-pencil updatePincode" type="button" id="'.$row["id"].'">Edit</button>';
		$sub_array[] = '<button class="btn btn-danger fa fa-trash deletePincode" type="button" id="'.$row["id"].'" >Delete</button>';
		$data[] = $sub_array;
		$i++;
	}
	$reoutput = array(
		"data"=>$data
	);
	echo json_encode($reoutput);
?>