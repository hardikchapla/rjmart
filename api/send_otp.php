<?php
	include "../connection/connection.php";
	include "../helper/constant.php";
    include "../helper/core_function.php";
	$status = 0;
	$message = "";
	$data = array();
	$response = array();

	if(!empty($_REQUEST)){
 		if(empty($_REQUEST['mobile'])){
 			$status = 2;
			$message = "Please enter mobile number";
			$data = array();
			$response['status'] = $status;
			$response['message'] = $message;
			$response['data'] = $data;
			echo json_encode($response);
			die;
 		}
        $mobile = $_REQUEST['mobile'];
        $checkmobile = $db->query("SELECT * FROM user WHERE mobile = '$mobile'");
 		if($checkmobile->rowCount() > 0){
            $otp = rand(100000, 999999);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://2factor.in/API/V1/214c8c4d-0cca-11ed-9c12-0200cd936042/SMS/'.$mobile.'/'.$otp,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $responses = curl_exec($curl);

            curl_close($curl);
            $new_response = json_decode($responses, 1);
            if ($new_response['Status'] == 'Success') {
                $status = 1;
                $message = "OTP Send successfully";
                $data = (object)  array('otp' => $otp, 'mobile' => $mobile);
            } else {
                $status = 0;
                $message = "Something want wrong. please try again later";
                $data = (object)  array();
            }
            
        } else {
            $status = 0;
            $message = "This mobile number is registered. please register first";
            $data = (object)  array();
        }
    } else {
        $status = 0;
		$message = "Please enter field values";
		$data = (object)  array();
    }
    $response['status'] = $status;
	$response['message'] = $message;
	$response['data'] = $data;
	echo json_encode($response);
	die;
?>