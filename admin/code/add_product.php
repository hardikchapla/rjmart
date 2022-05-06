<?php
	include('../../connection/connection.php');
	if($_REQUEST["operation"] == "Add")
	{
		$reoutput = array();
		$cat_name = addslashes($_REQUEST['cat_name']);
		$editor1 = addslashes($_REQUEST['editor1']);
        $selected_category = addslashes($_REQUEST['selected_category']);
		/*$price = addslashes($_REQUEST['price']);*/
		$created = date("Y-m-d H:i:s");

		$statement = $db->query("INSERT INTO product (name, description, created, cat_id) VALUES ('$cat_name', '$editor1', '$created', '$selected_category')");
		if(!empty($statement))
		{
		    $last_id = $db->lastInsertId();
            if (isset($_FILES['cat_profile'])) {
                $myFile = $_FILES['cat_profile'];
                $fileCount = count($myFile["name"]);
                $ext_list = ['jpg','jpeg','png','gif'];
                for ($i = 0; $i < $fileCount; $i++) {
                    $ext = pathinfo($_FILES['cat_profile']['name'][$i], PATHINFO_EXTENSION);
                    if(in_array($ext, $ext_list)){
                        $tmp = $myFile['tmp_name'][$i];
                        $new_name = rand(1000,1000000).'.'.$ext;
                        $path = '../../assets/img/product/'.$new_name;
                        if(move_uploaded_file($tmp,$path)){
                            $statement = $db->query("INSERT INTO product_image (p_id, image, created) VALUES ($last_id,'$new_name','$created')");
                        }
                    }
                }
            }
            if(isset($_REQUEST['product_type']) && isset($_REQUEST['Product_qty']) && isset($_REQUEST['product_type_price'])){
                $type_size = sizeof($_REQUEST['product_type']);
                for ($k=0; $k < $type_size; $k++) { 
                    $product_type = $_REQUEST['product_type'][$k];
                    $Product_qty = $_REQUEST['Product_qty'][$k];
                    $product_type_price = $_REQUEST['product_type_price'][$k];

                    $statement = $db->query("INSERT INTO product_type  SET product_id = '$last_id', product_type = '$product_type', Product_qty = '$Product_qty', product_type_price = '$product_type_price', created = '$created',updated = '$created'");
                }
            }
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
		$editor1 = addslashes($_REQUEST['editor1']);
        $selected_category = addslashes($_REQUEST['selected_category']);
		/*$price = addslashes($_REQUEST['price']);*/
        $created = date("Y-m-d H:i:s");
		$statement = $db->query("UPDATE product SET name = '$cat_name', description = '$editor1',  `updated` = '$created', cat_id = '$selected_category'  WHERE  id = '$cat_id'");
		if(!empty($statement))
		{
            if (isset($_FILES['cat_profile'])) {
                $myFile = $_FILES['cat_profile'];
                $fileCount = count($myFile["name"]);
                $ext_list = ['jpg','jpeg','png','gif'];
                for ($i = 0; $i < $fileCount; $i++) {
                    $ext = pathinfo($_FILES['cat_profile']['name'][$i], PATHINFO_EXTENSION);
                    if(in_array($ext, $ext_list)){
                        $tmp = $myFile['tmp_name'][$i];
                        $new_name = rand(1000,1000000).'.'.$ext;
                        $path = '../../assets/img/product/'.$new_name;
                        if(move_uploaded_file($tmp,$path)){
                            $statement = $db->query("INSERT INTO product_image (p_id, image, created) VALUES ($cat_id,'$new_name','$created')");
                        }
                    }
                }
            }
            if(isset($_REQUEST['product_type']) && isset($_REQUEST['Product_qty']) && isset($_REQUEST['product_type_price'])){
                $type_size = sizeof($_REQUEST['product_type']);
                for ($k=0; $k < $type_size; $k++) { 
                    $product_type = $_REQUEST['product_type'][$k];
                    $Product_qty = $_REQUEST['Product_qty'][$k];
                    $product_type_price = $_REQUEST['product_type_price'][$k];
                    $statement = $db->query("INSERT INTO product_type  SET product_id = '$cat_id', product_type = '$product_type', Product_qty = '$Product_qty', product_type_price = '$product_type_price', created = '$created',updated = '$created'");
                }
            }
            if(isset($_REQUEST['product_edit_type_id']) && isset($_REQUEST['product_edit_type']) && isset($_REQUEST['Product_edit_qty']) && isset($_REQUEST['product_edit_type_price'])){
                $edit_size = sizeof($_REQUEST['product_edit_type_id']);
                for ($n=0; $n < $edit_size; $n++) { 
                    $product_edit_type_id = $_REQUEST['product_edit_type_id'][$n];
                    $product_edit_type = $_REQUEST['product_edit_type'][$n];
                    $Product_edit_qty = $_REQUEST['Product_edit_qty'][$n];
                    $product_edit_type_price = $_REQUEST['product_edit_type_price'][$n];
                    $statement = $db->query("UPDATE product_type  SET product_type = '$product_edit_type', Product_qty = '$Product_edit_qty', product_type_price = '$product_edit_type_price', updated = '$created' WHERE product_type_id = '$product_edit_type_id'");
                }
            }
			$reoutput['error'] = 'updateSuccess';
		}
	}
	echo json_encode($reoutput);
?>