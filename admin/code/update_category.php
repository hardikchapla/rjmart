<?php
	include('../../connection/connection.php');
	if(isset($_POST["cat_id"]))
	{
		$reoutput = array();
		$statement = $db->prepare(
			"SELECT * FROM category 
			WHERE id = '".$_POST["cat_id"]."' LIMIT 1"
		);

		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$reoutput["cat_id"] = $row["id"];
			$reoutput["cat_name"] = $row["name"];
			$reoutput["user_profile"] = $row["image"];
			$reoutput["is_active"] = $row["is_active"];
		}
		echo json_encode($reoutput);
	}
?>