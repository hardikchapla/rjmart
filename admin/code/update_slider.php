<?php
	include('../../connection/connection.php');
	if(isset($_POST["cat_id"]))
	{
		$reoutput = array();
		$statement = $db->prepare(
			"SELECT * FROM slider 
			WHERE slider_id = '".$_POST["cat_id"]."' LIMIT 1"
		);

		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$reoutput["cat_id"] = $row["slider_id"];
			$reoutput["cat_name"] = $row["category_id"];
			$reoutput["user_profile"] = $row["slider_image"];
			$reoutput["slider_type"] = $row["slider_type"];
			$reoutput["is_active"] = $row["is_active"];
		}
		echo json_encode($reoutput);
	}
?>