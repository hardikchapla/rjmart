<?php
	header('Content-type: application/json; charset=UTF-8');
	$output = array();
	if ($_POST['id'])
	{
		require_once '../../connection/connection.php';
        $cat_id = $_POST['id'];
		$query = "DELETE FROM user WHERE id='$cat_id'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		if ($stmt) 
		{
			$query = "DELETE FROM user_address WHERE user_id='$cat_id'";
			$stmt = $db->prepare($query);
			$stmt->execute();
			$output['status']  = 'success';
			$output['message'] = 'User has been deleted successfully';
		} else {
			$output['status']  = 'error';
			$output['message'] = 'Oops! Something went wrong';
		}
		echo json_encode($output);
	}
?>