<?php
	header('Content-type: application/json; charset=UTF-8');
	$output = array();
	if ($_POST['cat_id'])
	{
		require_once '../../connection/connection.php';
        $cat_id = intval($_POST['cat_id']);
		$query = "DELETE FROM product WHERE id=:cat_id";
		$stmt = $db->prepare( $query );
		$stmt->execute(array(':cat_id'=>$cat_id));
		if ($stmt) 
		{
			$image = "SELECT * FROM product_image WHERE p_id = :p_id";
			$imgs = $db->prepare($image);
			$imgs->execute(array(':p_id'=>$cat_id));
			if($imgs->rowCount() > 0){
				while($feimags = $imgs->fetch()){
					$query1 = "DELETE FROM product_image WHERE id = ':image_id'";
					$stmts1 = $db->prepare($query1);
					$stmts1->execute(array(':image_id'=>$feimags['id']));
					unlink('../../assets/img/product/'.$feimags['image']);
				}
			}

			$query = "DELETE FROM product_type WHERE product_id = ':product_id'";
			$stmts = $db->prepare($query);
			$stmts->execute(array(':product_id'=>$cat_id));

			$output['status']  = 'success';
			$output['message'] = 'Product has been deleted successfully';
		} else {
			$output['status']  = 'error';
			$output['message'] = 'Oops! Something went wrong';
		}
		echo json_encode($output);
	}
?>
