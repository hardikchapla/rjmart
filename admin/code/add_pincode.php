<?php
	include('../../connection/connection.php');
	
	if($_POST["operation"] == "Add")
	{
		$reoutput = array();
		$pincode = addslashes($_REQUEST['pincode_no']);
		$created = date("Y-m-d H:i:s");
		$statement = $db->query("INSERT INTO pincode (pincode, created_at) VALUES ('$pincode','$created')");
		if(!empty($statement))
		{
			$reoutput['error'] = 'success';
		}
		else{
			$reoutput['error'] = 'fail';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$reoutput = array();
		$pincode_id = $_REQUEST['pincode_id'];
        $pincode = addslashes($_REQUEST['pincode_no']);
        $created = date("Y-m-d H:i:s");
		$statement = $db->query("UPDATE pincode SET `pincode` = '$pincode',updated_at = '$created' WHERE  id = '$pincode_id'");
		if(!empty($statement))
		{
			$reoutput['error'] = 'updateSuccess';
		}
	}
	echo json_encode($reoutput);
?>