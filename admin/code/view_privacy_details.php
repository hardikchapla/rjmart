<?php
	include('../../connection/connection.php');
	if(isset($_POST["id"]))
	{
		$reoutput = array();
		$statement = $db->prepare(
			"SELECT * FROM privacy_policy 
			WHERE id = '".$_POST["id"]."' LIMIT 1"
		);

		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$reoutput["plan_details"] = $row["description"];
		}
		echo json_encode($reoutput);
	}
?>