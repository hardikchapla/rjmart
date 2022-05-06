<?php
	include('../../connection/connection.php');
	
	if($_POST["operation"] == "Add")
	{
		$reoutput = array();
		$selected_category = addslashes($_REQUEST['selected_category']);
		$slider_type = $_REQUEST['slider_type'];
		$created = date("Y-m-d H:i:s");
		if(!empty($_FILES['cat_profile']['name']))
		{
			$file = $_FILES['cat_profile']['name'];
			$tmp = $_FILES['cat_profile']['tmp_name'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$photo = rand(1000,1000000).$file; 
			$path = '../../assets/img/slider/'.$photo;
			move_uploaded_file($tmp,$path);
		}
		else
		{
			$photo = $_REQUEST['cat_profile1'];
		}
		$statement = $db->query("INSERT INTO slider (category_id, slider_image,slider_type, created) VALUES ('$selected_category','$photo','$slider_type', '$created')");
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
		$cat_id = $_REQUEST['cat_id'];
        $selected_category = addslashes($_REQUEST['selected_category']);
		$slider_type = $_REQUEST['slider_type'];
        $created = date("Y-m-d H:i:s");
        if(!empty($_FILES['cat_profile']['name']))
        {
            $file = $_FILES['cat_profile']['name'];
            $tmp = $_FILES['cat_profile']['tmp_name'];
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $photo = rand(1000,1000000).$file;
            $path = '../../assets/img/slider/'.$photo;
            move_uploaded_file($tmp,$path);
        }
        else
        {
            $photo = $_REQUEST['cat_profile1'];
        }
		$statement = $db->query("UPDATE slider SET `category_id` = '$selected_category',`slider_type` = '$slider_type',`slider_image` = '$photo', created = '$created' WHERE slider_id = '$cat_id'");
		if(!empty($statement))
		{
			$reoutput['error'] = 'updateSuccess';
		}
	}
	echo json_encode($reoutput);
?>