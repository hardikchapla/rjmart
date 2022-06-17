<?php

function userCheckEmail($Email) {

    if (!empty($Email)):

        global $db;

        $getEmailQry = $db->query("SELECT * FROM user WHERE user_email = '$Email'");

        $getLoginResponse = $getEmailQry->fetch();

        if ($getLoginResponse):

            return TRUE;

        endif;

    else:

        return FALSE;

    endif;

}

function addAPISession($user_id, $user_device_type = NULL, $user_device_tokan = NULL) {

    if (!empty($user_id)):



        $checkUserLogin = checkUserIsLogin($user_id);

        if ($checkUserLogin):

            deleteLoginUser($user_id);

        endif;





        $generateNewSessionId = uniqid() . uniqid() . md5(@date('YmdHis')) . uniqid() . uniqid();

        global $db;

        $sessionQry = $db->query("INSERT INTO user_session (user_id,user_session,user_device_type,user_device_tokan) VALUES ('$user_id','$generateNewSessionId','$user_device_type','$user_device_tokan')");

        $last_id = $db->lastInsertId();

        if ($sessionQry):

            if ($last_id):

                $sessionGetQry = $db->query("SELECT * FROM user_session WHERE session_id = '$last_id'");

                $getAPISessionData = $sessionGetQry->fetch();

                $apiData = [];

                $apiData['session_id'] = (intval($getAPISessionData['session_id'])) ? intval($getAPISessionData['session_id']) : '';

                $apiData['user_id'] = ($getAPISessionData['user_id']) ? $getAPISessionData['user_id'] : '';

                $apiData['user_session'] = ($getAPISessionData['user_session']) ? $getAPISessionData['user_session'] : '';

                $apiData['user_device_type'] = ($getAPISessionData['user_device_type']) ? $getAPISessionData['user_device_type'] : '';

                $apiData['user_device_tokan'] = ($getAPISessionData['user_device_tokan']) ? $getAPISessionData['user_device_tokan'] : '';

                return $apiData;

            endif;

        else:

            return FALSE;

        endif;

    else:

        return FALSE;

    endif;

}

function checkUserIsLogin($user_id) {

    if (!empty($user_id)):

        global $db;

        $getUserQry = $db->query("SELECT * FROM user_session WHERE user_id='$user_id'");

        $getLoginResponse = $getUserQry->fetch();

        if ($getLoginResponse):

            return TRUE;

        endif;

    else:

        return FALSE;

    endif;

}

function deleteLoginUser($user_id) {

    if (!empty($user_id)):

        global $db;

        $getUserQry = $db->query("DELETE FROM user_session WHERE user_id='$user_id'");

        if ($getUserQry):

            return TRUE;

        endif;

    else:

        return FALSE;

    endif;

}



function UserLoginResponse($user_id, $user_device_type = NULL, $user_device_tokan = NULL) {

    if (!empty($user_id)):

        $apiSession = addAPISession($user_id, $user_device_type, $user_device_tokan)['user_session'];

        if ($apiSession):

            global $db;

            $getUserQry = $db->query("SELECT * FROM user WHERE User_Id = '$user_id'");

            $getLoginResponse = $getUserQry->fetch();

            if ($getLoginResponse):

                $loginData = [];

                $loginData['user_id'] = (intval($getLoginResponse['user_id'])) ? intval($getLoginResponse['user_id']) : '';

                $loginData['user_first_name'] = ($getLoginResponse['user_first_name']) ? $getLoginResponse['user_first_name'] : '';

                $loginData['user_last_name'] = ($getLoginResponse['user_last_name']) ? $getLoginResponse['user_last_name'] : '';

                $loginData['user_email'] = ($getLoginResponse['user_email']) ? $getLoginResponse['user_email'] : '';

                $loginData['user_profile'] = ($getLoginResponse['user_profile']) ? UserProfileImageURL($getLoginResponse['user_profile']) : '';

                $loginData['user_mobile'] = ($getLoginResponse['user_mobile']) ? $getLoginResponse['user_mobile'] : '';

                $loginData['user_latitude'] = ($getLoginResponse['user_latitude']) ? $getLoginResponse['user_latitude'] : '';

                $loginData['user_logtitude'] = ($getLoginResponse['user_logtitude']) ? $getLoginResponse['user_logtitude'] : '';

                $loginData['Device_type'] = $user_device_type;

                $loginData['Device_tokan'] = $user_device_tokan;

                $loginData['sessionId'] = $apiSession;

                return $loginData;

            endif;

        else:

            return FALSE;

        endif;

    else:

        return FALSE;

    endif;

}



function baseURL() {

    $actualLink = 'http://' . $_SERVER['HTTP_HOST'];

    return $actualLink;

}

function directoryName() {

    return dirname($_SERVER['REQUEST_URI']) . "/";

}



function UserProfileImageURL($imageName) {

    $imagePath = '../assets/profile/';

    $imageBastPath = baseURL() . directoryName();

    $imageUrl = $imageBastPath . $imagePath . $imageName;

    return $imageUrl;

}

function removeuserProfileImage1($fileName) {

    $destinationPath = '../assets/profile/'.$fileName;

    return @unlink($destinationPath);

}

function removeuserProfileImageforapi($fileName) {

    $destinationPath = '../../assets/profile/'.$fileName;

    return @unlink($destinationPath);

}

function removecategoryimage($fileName) {

    $destinationPath = '../../assets/category/'.$fileName;

    return @unlink($destinationPath);

}

function CategoryImageURL($imageName) {

    $imagePath = '../assets/category/';

    $imageBastPath = baseURL() . directoryName();

    $imageUrl = $imageBastPath . $imagePath . $imageName;

    return $imageUrl;

}

function ProductImageURL($imageName) {

    $imagePath = '../assets/product/';

    $imageBastPath = baseURL() . directoryName();

    $imageUrl = $imageBastPath . $imagePath . $imageName;

    return $imageUrl;

}

function EventImageURL($imageName) {

    $imagePath = '../assets/events/';

    $imageBastPath = baseURL() . directoryName();

    $imageUrl = $imageBastPath . $imagePath . $imageName;

    return $imageUrl;

}

function BlogImageURL($imageName) {

    $imagePath = '../assets/blog/';

    $imageBastPath = baseURL() . directoryName();

    $imageUrl = $imageBastPath . $imagePath . $imageName;

    return $imageUrl;

}

function sendMail($messageBody, $Email, $subject) {

    require("../libraries/PHPMailer/PHPMailerAutoload.php");

    $messagebody = $messageBody;

    $mail = new PHPMailer();



    $mail->isSMTP();

    $mail->Host = MAIL_HOST;

    $mail->SMTPAuth = true;

    $mail->Username = MAIL_USERNAME;

    $mail->Password = MAIL_PASSWORD;

    $mail->SMTPSecure = MAIL_SMTP_SECURE;

    $mail->Port = MAIL_SMTP_PORT;

    $mail->SMTPDebug  = 0;

    $mail->From = MAIL_FROM;

    $mail->FromName = MAIL_FROM_NAME;

    $mail->addAddress($Email);

    $mail->isHTML(true);



    $mail->Subject = $subject;

    $mail->Body = $messagebody;

    $mail->smtpConnect(

            array(

                "ssl" => array(

                    "verify_peer" => false,

                    "verify_peer_name" => false,

                    "allow_self_signed" => true

                )

            )

    );

    $mail->send();



    if (!empty($mail)):

        return TRUE;

    endif;

}

function checkUserSession($user_id, $user_session) {

    if (!empty($user_id) && !empty($user_session)):

        global $db;

        $getAPISessionQry = $db->query("SELECT * FROM user_session WHERE user_session='$user_session' AND user_id='$user_id'");

        $getAPISession = $getAPISessionQry->fetch();

        if ($getAPISession):

            $sessionData = [];

            $sessionData['session_id'] = (intval($getAPISession['session_id'])) ? intval($getAPISession['session_id']) : '';

            $sessionData['user_id'] = (intval($getAPISession['user_id'])) ? intval($getAPISession['user_id']) : '';

            $sessionData['user_session'] = ($getAPISession['user_session']) ? $getAPISession['user_session'] : '';

            $sessionData['user_device_type'] = ($getAPISession['user_device_type']) ? $getAPISession['user_device_type'] : '';

            $sessionData['user_device_tokan'] = ($getAPISession['user_device_tokan']) ? $getAPISession['user_device_tokan'] : '';

            return $sessionData;

        endif;

    else:

        return FALSE;

    endif;

}

function updateuserprofile($user_id){

    if(!empty($user_id)):

        global $db;

        $userprofile = $db->query("SELECT * FROM user WHERE user_id = '$user_id'");

        $feuserprofile = $userprofile->fetch();

        $usersession = $db->query("SELECT * FROM user_session WHERE user_id = '$user_id'");

        $feusersession = $usersession->fetch();

        if($feuserprofile):

            $userdata = array();

            $userdata['user_id'] = ($feuserprofile['user_id']) ? $feuserprofile['user_id'] : '';

            $userdata['user_first_name'] = ($feuserprofile['user_first_name']) ? $feuserprofile['user_first_name'] : '';

            $userdata['user_last_name'] = ($feuserprofile['user_last_name']) ? $feuserprofile['user_last_name'] : '';

            $userdata['user_email'] = ($feuserprofile['user_email']) ? $feuserprofile['user_email'] : '';

            $userdata['user_profile'] = ($feuserprofile['user_profile']) ? UserProfileImageURL($feuserprofile['user_profile']) : '';

            $userdata['user_mobile'] = ($feuserprofile['user_mobile']) ? $feuserprofile['user_mobile'] : '';

            $userdata['user_latitude'] = ($feuserprofile['user_latitude']) ? $feuserprofile['user_latitude'] : '';

            $userdata['user_logtitude'] = ($feuserprofile['user_logtitude']) ? $feuserprofile['user_logtitude'] : '';

            return $userdata;

        endif;

    else:

        return FALSE;

    endif;    

}

function productDetails($product_id){

    if(!empty($product_id)):

        global $db;

        $product = $db->query("SELECT * FROM product WHERE product_id = '$product_id'");

        if($product->rowCount() > 0):

            $aa = array();

            $a = 0;

            $feproduct = $product->fetch();

            $aa['product_id'] = ($feproduct['product_id']) ? $feproduct['product_id']:'';

            $aa['product_name'] = ($feproduct['product_name']) ? $feproduct['product_name']:'';

            $aa['product_description'] = ($feproduct['product_description']) ? $feproduct['product_description']:'';

            $aa['product_price'] = ($feproduct['product_price']) ? $feproduct['product_price']:'';

            $aa['product_offer'] = ($feproduct['product_offer']) ? $feproduct['product_offer']:'';

            $aa['product_offer_price'] = ($feproduct['product_offer_price']) ? $feproduct['product_offer_price']:'';

            $category = $db->query("SELECT * FROM category WHERE category_id = '".$feproduct['category_id']."'");

            $fecategory = $category->fetch();

            $aa['category_id'] = $feproduct['category_id'];

            $aa['category_name'] = ($fecategory['category_name']) ? $fecategory['category_name']:'';

            $aa['category_image'] = ($fecategory['category_image']) ? CategoryImageURL($fecategory['category_image']):'';

            $images = $db->query("SELECT * FROM product_image WHERE product_id = '".$feproduct['product_id']."'");

            $bb = array();

            $b = 0;

            if($images->rowCount() > 0):

                while ($feimages = $images->fetch()) {

                    $bb[$b]['product_image_id'] = ($feimages['product_image_id']) ? $feimages['product_image_id']:'';

                    $bb[$b]['product_image'] = ($feimages['product_image']) ? ProductImageURL($feimages['product_image']):'';

                    $b++;

                }

            endif;

            $aa['product_image'] = $bb;

            return $aa;

        else:

            return false;

        endif;

    else:

        return false;

    endif;

}

function sendPushNotification($token, $title, $deviceType = 'ios', $data = array()) {
// notification messages
    $arrayToSend = '';
    if ($deviceType == 'ios'):
        $arrayToSend = array('to' => $token, 'notification' => array("body" => $data['message'], "title" => $title), 'data' => $data, 'priority' => 'high', 'badge' => '1');
    else:
        $arrayToSend = array('to' => $token, 'data' => array("title" => $title, "body" => $data), 'priority' => 'high');
    endif;
//    echo "<pre>";
//    print_r($deviceType);
//    print_r($arrayToSend);
//    die;
    $json = json_encode($arrayToSend);
//FCM API end-point
    $url = 'https://fcm.googleapis.com/fcm/send';
//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
    if ($deviceType == 'ios'):
        // Ios
        $server_key = 'AAAAjyZmtgM:APA91bHwKF8aO-UvlRhWPO7BoI17ooIn4FfdGMSwx5c8lv0PZitKD3Cp8drYoRax6k22eWOZWu4-a1TOeWwx1J37cy4oz0i-yTMGRjgspEWo8PBw11IOIkc38n9GUwOCLTx0YXOBc_5l';
    else:
        // Android
        $server_key = 'AAAAjyZmtgM:APA91bHwKF8aO-UvlRhWPO7BoI17ooIn4FfdGMSwx5c8lv0PZitKD3Cp8drYoRax6k22eWOZWu4-a1TOeWwx1J37cy4oz0i-yTMGRjgspEWo8PBw11IOIkc38n9GUwOCLTx0YXOBc_5l';
    endif;
//header with content_type api key
    $headers = array();
    $headers[] = 'Authorization: key=' . $server_key;
    $headers[] = 'Content-Type: application/json';
//CURL request to route notification to FCM connection server (provided by Google)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    return $result;
}
function sendPushNotificationDeliveryBoy($token, $title, $deviceType = 'ios', $data = array()) {
    // notification messages
    $arrayToSend = '';
    if ($deviceType == 'ios'):
        $arrayToSend = array('to' => $token, 'notification' => array("body" => $data['message'], "title" => $title), 'data' => $data, 'priority' => 'high', 'badge' => '1');
    else:
        $arrayToSend = array('to' => $token, 'data' => array("title" => $title, "body" => $data), 'priority' => 'high');
    endif;
//    echo "<pre>";
//    print_r($deviceType);
//    print_r($arrayToSend);
//    die;
    $json = json_encode($arrayToSend);
//FCM API end-point
    $url = 'https://fcm.googleapis.com/fcm/send';
//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
    if ($deviceType == 'ios'):
        // Ios
        $server_key = 'AAAANqfW5cA:APA91bF7AE3Nr972VRqYf8lNH4kcFPw3sAO-Q2V4ddZkYLN3eiFtDgzLYkbkafRQKag3YhtnjJsPV1YOZbuXoIXa1sWOJ7VN_oqq1PWdORKnochN25-a5VqBa6DroMH06KLU8DU3mYSG';
    else:
        // Android
        $server_key = 'AAAANqfW5cA:APA91bF7AE3Nr972VRqYf8lNH4kcFPw3sAO-Q2V4ddZkYLN3eiFtDgzLYkbkafRQKag3YhtnjJsPV1YOZbuXoIXa1sWOJ7VN_oqq1PWdORKnochN25-a5VqBa6DroMH06KLU8DU3mYSG';
    endif;
//header with content_type api key
    $headers = array();
    $headers[] = 'Authorization: key=' . $server_key;
    $headers[] = 'Content-Type: application/json';
//CURL request to route notification to FCM connection server (provided by Google)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    return $result;
}
function sendPushNotificationAdmin($token, $title, $deviceType = 'ios', $data = array()) {
// notification messages
    $arrayToSend = '';
    if ($deviceType == 'ios'):
        $arrayToSend = array('to' => $token, 'notification' => array("body" => $data['message'], "title" => $title), 'data' => $data, 'priority' => 'high', 'badge' => '1');
    else:
        $arrayToSend = array('to' => $token, 'data' => array("title" => $title, "body" => $data), 'priority' => 'high');
    endif;
//    echo "<pre>";
//    print_r($deviceType);
//    print_r($arrayToSend);
//    die;
    $json = json_encode($arrayToSend);
//FCM API end-point
    $url = 'https://fcm.googleapis.com/fcm/send';
//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
    if ($deviceType == 'ios'):
        // Ios
        $server_key = 'AAAAe4jMMPk:APA91bF0FbxWL9ww0iUIt9aCEupV-eWAoPLYNBe7iagKFAqTWdX1sPjw36IrwdVOd-krtsfIsEFF5YHqmQ38ncRBoUu4kzd6MRaxR614Ho-fDWQewvDZ4ZqsgcEbBb3O_Tgh7ir_BkoR';
    else:
        // Android
        $server_key = 'AAAAe4jMMPk:APA91bF0FbxWL9ww0iUIt9aCEupV-eWAoPLYNBe7iagKFAqTWdX1sPjw36IrwdVOd-krtsfIsEFF5YHqmQ38ncRBoUu4kzd6MRaxR614Ho-fDWQewvDZ4ZqsgcEbBb3O_Tgh7ir_BkoR';
    endif;
//header with content_type api key
    $headers = array();
    $headers[] = 'Authorization: key=' . $server_key;
    $headers[] = 'Content-Type: application/json';
//CURL request to route notification to FCM connection server (provided by Google)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    return $result;
}

function send_email_verification($user_email)

{

    $messagebody = '<html>

                        <body>

                            <div style="background:#f2f2f2;margin:0 auto;max-width:640px;padding:0 20px">

                                <table align="center" border="0" cellpadding="0" cellspacing="0">

                                    <tbody>

                                    <tr>

                                        <td>&nbsp;</td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <div style="text-align: center;background-color: #2196F3;color: #Fff;font-family:"Open Sans", sans-serif;font-size:13px; padding: 1px;margin-top: 10px;border-radius:10px 10px 0 0;">

                                                <h2>Email Verification</h2>

                                            </div>

                                            <div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">



                                                <p>Dear User,</p>

                                                <p>Please use the following verify link to verify your email and this link is use for 30 minutes after 30 minutes link has been expire</p>

                                                <p>Your verify email Link : <strong><a href="'.baseURL().'/Business_Pro/api/verify_email.php?Email='.base64_encode($user_email).'">Click here to verify your email</a></strong></p> 

                                            </div>                                                    

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>&nbsp;</td>

                                    </tr>

                                    </tbody>

                                </table>

                            </div>

                        </body>

                    </html>';

    $subject = "Business Pro Email Verification";

   return  sendMail($messagebody,$user_email, $subject);

}
function sendsms($mobile, $message){
    $url = "http://dnd.bulksmssurat.in/httpapi/smsapi?uname=gujrat123&password=gujrat123&sender=Gujrat&receiver=".$mobile."&route=TA&msgtype=1&sms=".urlencode($message);
    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: fd9ceceb-7a60-30c6-bccf-5dd935d71ee6"
            ),
        ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    // if ($err) {
    //   echo "cURL Error #:" . $err;
    // } else {
    //   echo $response;
    // }
    return true;
}

?>