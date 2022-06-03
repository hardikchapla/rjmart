<?php
	include('../../connection/connection.php');
	if($_POST["operation"] == "Edit")
	{
		$reoutput = array();
		$terms_id = $_REQUEST['terms_id'];
		$editor1 = addslashes($_REQUEST['editor1']);
        $created = date("Y-m-d H:i:s");
		$statement = $db->query("UPDATE terms_and_conditions SET description = '$editor1',  `updated_at` = '$created'  WHERE  id = '$terms_id'");
		if(!empty($statement))
		{
			$reoutput['error'] = 'updateSuccess';
		}
	}
	echo json_encode($reoutput);
?>