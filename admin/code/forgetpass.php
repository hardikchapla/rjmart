<?php
    require_once '../../connection/connection.php';
    require_once '../../helper/constant.php';
    require_once '../../helper/core_function.php';
	$Email = $_REQUEST['email'];
	$emails = $db->query("SELECT * FROM admin WHERE email = '$Email'");
	if($emails->rowCount() > 0)
	{
        $femaile = $emails->fetch();
        $Password = $femaile['password'];
		$messageBody = '<html>
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
                                                    <h2>Password Recovery</h2>
                                                </div>
                                                <div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">

                                                    <p>Dear User,</p>
                                                    <p>Please use the following security password for the ' . $Email . ' account</p>
                                                    <p>Your Password: <strong><a href="'.RESET_LINK.'?Email='.base64_encode($Email).'&Password='.$Password.'">Click here for Set Your reset password</a></strong></p>
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
            include("../libraries/PHPMailer/PHPMailerAutoload.php");
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = 'true';
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->FromName = MAIL_FROM_NAME;
            $mail->From = MAIL_FROM;
            $mail->SMTPSecure = MAIL_SMTP_SECURE;
            $mail->Port = MAIL_SMTP_PORT;
            $mail->SMTPDebug  = '0';
            $mail->addAddress($Email);
            $mail->isHTML('true');
            $mail->Subject = PASSWORD_RECOVERY;
            $mail->Body = $messageBody;
            $mail->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );
        if($mail->Send())
        {
			$success['success'] = "success";
            $success['message'] = "Your Reset Password Link Sent To Your Email";
		}
		else
		{
			$success['success'] = "fail";
            $success['message'] = "Please Enter Valid Email";
		}
    }
    else
    {
    	$success['success'] = "fail";
        $success['message'] = "Please Enter Valid Email or please contact us";
    }		
    echo json_encode($success);
?>