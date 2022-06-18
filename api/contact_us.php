<?php
	include "../connection/connection.php";
	include "../helper/constant.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();
	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['user_id'])){
 			$status = 2;
			$message = "Please enter user id";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
        $user_id = $_REQUEST['user_id'];
        $checkmobile = $db->query("SELECT * FROM user WHERE id = '$user_id'");
 		if($checkmobile->rowCount() > 0){
            $contact = $db->query("SELECT * FROM contact_us WHERE id = 1");
            $fecontact = $contact->fetch(PDO::FETCH_ASSOC);
            $status = 1;
            $message = "Contact Us";
            $data = $fecontact;
        } else {
            $status = 0;
            $message = "Please enter valid userid";
            $data = array();
        }
   } else {
       $status = 0;
       $message = "Please enter field values";
       $data = array();
   }
   $response['status'] = $status;
   $response['message'] = $message;
   $response['data'] = $data;
   echo json_encode($response);
   die;
?>