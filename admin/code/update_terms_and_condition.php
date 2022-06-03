<?php
	include('../../connection/connection.php');
	if(isset($_POST["terms_id"]))
	{
		$reoutput = array();
		$statement = $db->prepare(
			"SELECT * FROM terms_and_conditions 
			WHERE id = '".$_POST["terms_id"]."' LIMIT 1"
		);

		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$reoutput["terms_id"] = $row["id"];
			$reoutput["privacy_slug"] = $row["slug"];
			$reoutput["description"] = $row["description"];
		}
		echo json_encode($reoutput);
	}
?>