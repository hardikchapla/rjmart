<?php
	// session_start();
	include "../../connection/connection.php";
	$username = $_REQUEST['userName'];
	$full_name = $_REQUEST['fullName'];
	$email = $_REQUEST['email'];
	$number = $_REQUEST['number'];
	$created = date("Y-m-d H:i:s");
	$admin = $_SESSION['adminId'];
	if(empty($_FILES['photo']['name']))
	{
		$select = $db->query("UPDATE admin set username ='$username',email='$email',name='$full_name',updated='$created', `number` = '$number' WHERE id = '$admin'");
		if($select)
		{
			$success['error'] = 'success';
			$success['message'] = 'Admin profile has been updated successfully';
		}
		else
		{
			$success['error'] = "error";
			$success['message'] = 'Oops! Something went wrong';
		}
	}
	else
	{
		$file = $_FILES['photo']['name'];
		$tmp = $_FILES['photo']['tmp_name'];
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$photo = rand(1000,1000000).$file; 
		$path = '../assets/img/'.$photo;
		move_uploaded_file($tmp,$path);
		@unlink("../assets/img/".$_REQUEST['image']);
		$select = $db->query("UPDATE admin set username ='$username',email='$email',name='$full_name',avatar='$photo',updated='$created', `number` = '$number' WHERE id = '$admin'");

		if($select)
		{
			$success['error'] = 'success';
			$success['message'] = 'Admin profile has been updated successfully';
		}
		else
		{
			$success['error'] = "error";
			$success['message'] = 'Oops! Something went wrong';
		}
	}
echo json_encode($success);
?>
