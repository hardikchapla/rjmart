<?php
	include('../../connection/connection.php');
	if($_POST["operation"] == "Edit")
	{
		$reoutput = array();
		$privacy_id = $_REQUEST['privacy_id'];
		$editor1 = addslashes($_REQUEST['editor1']);
        $created = date("Y-m-d H:i:s");
		$statement = $db->query("UPDATE privacy_policy SET description = '$editor1',  `updated_at` = '$created'  WHERE  id = '$privacy_id'");
		if(!empty($statement))
		{
			$reoutput['error'] = 'updateSuccess';
		}
	}
	echo json_encode($reoutput);
?>