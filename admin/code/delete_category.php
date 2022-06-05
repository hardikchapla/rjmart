<?php
	header('Content-type: application/json; charset=UTF-8');
	$output = array();
	if ($_POST['cat_id'])
	{
		require_once '../../connection/connection.php';
        $cat_id = $_POST['cat_id'];
		$category = $db->query("SELECT * FROM category WHERE id = '$cat_id'");
		$fecategory = $category->fetch();
		$slider = $db->query("SELECT * FROM slider WHERE category_id = '$cat_id'");
		$query = "DELETE FROM category WHERE id='$cat_id'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		if ($stmt) 
		{
			unlink('../../assets/img/category/'.$fecategory['image']);
			if($slider->rowCount() > 0){
				while ($feslider = $slider->fetch()) {
					unlink('../../assets/img/slider/'.$feslider['slider_image']);
				}
				$delete_slider = $db->query("DELETE FROM slider WHERE category_id = '$cat_id'");
			}
			$output['status']  = 'success';
			$output['message'] = 'Category has been deleted successfully';
		} else {
			$output['status']  = 'error';
			$output['message'] = 'Oops! Something went wrong';
		}
		echo json_encode($output);
	}
?>