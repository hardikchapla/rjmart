<?php
	include('../../connection/connection.php');
	
	if($_POST["operation"] == "Add")
	{
		$reoutput = array();
		$pincode = addslashes($_REQUEST['pincode_no']);
		$check = $db->query("SELECT * FROM pincode WHERE pincode = '$pincode'");
		if($check->rowCount() == 0){
			$is_active = $_REQUEST['is_active'];
			$created = date("Y-m-d H:i:s");
			$statement = $db->query("INSERT INTO pincode (pincode, is_active, created_at) VALUES ('$pincode', '$is_active','$created')");
			if(!empty($statement))
			{
				$reoutput['error'] = 'success';
			}
			else{
				$reoutput['error'] = 'fail';
			}
		} else {
			$reoutput['error'] = 'duplicate';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$reoutput = array();
		$pincode_id = $_REQUEST['pincode_id'];
        $pincode = addslashes($_REQUEST['pincode_no']);
		$is_active = $_REQUEST['is_active'];
        $created = date("Y-m-d H:i:s");
		$check = $db->query("SELECT * FROM pincode WHERE pincode = '$pincode' AND id != '$pincode_id'");
		if($check->rowCount() == 0){
			$statement = $db->query("UPDATE pincode SET `pincode` = '$pincode',`is_active` = '$is_active',updated_at = '$created' WHERE  id = '$pincode_id'");
			if(!empty($statement))
			{
				$reoutput['error'] = 'updateSuccess';
			}
		} else {
			$reoutput['error'] = 'duplicate';
		}
	}
	echo json_encode($reoutput);
?>