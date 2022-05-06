<?php
	include('../../connection/connection.php');
	$reoutput = array();
	$query = "SELECT * FROM user WHERE user_type = '0' ORDER BY id DESC";
	$statement = $db->query($query);
	$result = $statement->fetchAll();
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
		$sub_array[] = $row["email"];
		$sub_array[] = $row['mobile'];
		$sub_array[] = '<a href="user-details.php?id='.$row["id"].'"><button class="btn btn-outline-info userProfileDetails">View</button></a>';
		$sub_array[] = '<button class="btn btn-danger deleteUser" type="button" id="'.$row["id"].'" >Delete</button>';
		$data[] = $sub_array;
		$i++;
	}
	$reoutput = array(
		"data"=>$data
	);
	echo json_encode($reoutput);
?>