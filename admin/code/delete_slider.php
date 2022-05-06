<?php
	header('Content-type: application/json; charset=UTF-8');
	$output = array();
	if ($_POST['cat_id'])
	{
		require_once '../../connection/connection.php';
        $cat_id = $_POST['cat_id'];
		$query = "DELETE FROM slider WHERE slider_id='$cat_id'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		if ($stmt) 
		{
			$output['status']  = 'success';
			$output['message'] = 'Slider has been deleted successfully';
		} else {
			$output['status']  = 'error';
			$output['message'] = 'Oops! Something went wrong';
		}
		echo json_encode($output);
	}
?>