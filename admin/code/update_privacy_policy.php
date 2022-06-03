<?php
	include('../../connection/connection.php');
	if(isset($_POST["privacy_id"]))
	{
		$reoutput = array();
		$statement = $db->prepare(
			"SELECT * FROM privacy_policy 
			WHERE id = '".$_POST["privacy_id"]."' LIMIT 1"
		);

		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$reoutput["privacy_id"] = $row["id"];
			$reoutput["privacy_slug"] = $row["slug"];
			$reoutput["description"] = $row["description"];
		}
		echo json_encode($reoutput);
	}
?>