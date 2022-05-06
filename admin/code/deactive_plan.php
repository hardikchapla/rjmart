<?php
	include('../../connection/connection.php');
	// $reoutput = array();
	// $category_name = addslashes($_REQUEST['category_name']);
	// $created = date("Y-m-d H:i:s");
	$reoutput = array();
	$id = $_REQUEST['id'];
	$statement = $db->query("UPDATE premium_plan SET `plan_status` = '2' WHERE  id = '$id'");
	if(!empty($statement))
	{
		$reoutput['error'] = 'success';
	}
	else{
		$reoutput['error'] = 'fail';
	}
	echo json_encode($reoutput);
?>