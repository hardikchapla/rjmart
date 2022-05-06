<?php
	include('../../connection/connection.php');
	if(isset($_POST["pincode_id"]))
	{
		$reoutput = array();
		$statement = $db->prepare(
			"SELECT * FROM pincode 
			WHERE id = '".$_POST["pincode_id"]."' LIMIT 1"
		);

		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$reoutput["pincode_id"] = $row["id"];
			$reoutput["pincode"] = $row["pincode"];
		}
		echo json_encode($reoutput);
	}
?>