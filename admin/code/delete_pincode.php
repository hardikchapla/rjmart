<?php
	header('Content-type: application/json; charset=UTF-8');
	$output = array();
	if ($_POST['pincode_id'])
	{
		require_once '../../connection/connection.php';
        $pincode_id = $_POST['pincode_id'];
		$query = "DELETE FROM pincode WHERE id='$pincode_id'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		if ($stmt) 
		{
			$output['status']  = 'success';
			$output['message'] = 'Pincode has been deleted successfully';
		} else {
			$output['status']  = 'error';
			$output['message'] = 'Oops! Something went wrong';
		}
		echo json_encode($output);
	}
?>