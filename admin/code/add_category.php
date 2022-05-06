<?php
	include('../../connection/connection.php');
	
	if($_POST["operation"] == "Add")
	{
		$reoutput = array();
		$cat_name = addslashes($_REQUEST['cat_name']);
		$created = date("Y-m-d H:i:s");
		if(!empty($_FILES['cat_profile']['name']))
		{
			$file = $_FILES['cat_profile']['name'];
			$tmp = $_FILES['cat_profile']['tmp_name'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$photo = rand(1000,1000000).$file; 
			$path = '../../assets/img/category/'.$photo;
			move_uploaded_file($tmp,$path);
		}
		else
		{
			$photo = $_REQUEST['cat_profile1'];
		}
		$statement = $db->query("INSERT INTO category (name, image, created) VALUES ('$cat_name','$photo','$created')");
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
        $cat_name = addslashes($_REQUEST['cat_name']);
        $created = date("Y-m-d H:i:s");
        if(!empty($_FILES['cat_profile']['name']))
        {
            $file = $_FILES['cat_profile']['name'];
            $tmp = $_FILES['cat_profile']['tmp_name'];
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $photo = rand(1000,1000000).$file;
            $path = '../../assets/img/category/'.$photo;
            move_uploaded_file($tmp,$path);
        }
        else
        {
            $photo = $_REQUEST['cat_profile1'];
        }
		$statement = $db->query("UPDATE category SET `name` = '$cat_name',`image` = '$photo', updated = '$created' WHERE  id = '$cat_id'");
		if(!empty($statement))
		{
			$reoutput['error'] = 'updateSuccess';
		}
	}
	echo json_encode($reoutput);
?>