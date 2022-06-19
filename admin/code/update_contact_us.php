<?php
	include('../../connection/connection.php');

	if($_POST["operation"] == "Edit")
	{
		$reoutput = array();
		$contact_us_id = $_REQUEST['contact_us_id'];
		$email = $_REQUEST['email'];
		$call_us = $_REQUEST['call_us'];
		$whatsapp_us = $_REQUEST['whatsapp_us'];
        $content = addslashes($_REQUEST['content']);
        $created = date("Y-m-d H:i:s");
        $statement = $db->query("UPDATE contact_us SET `email` = '$email',`call_us` = '$call_us',`whatsapp_us` = '$whatsapp_us',`content` = '$content',updated_at = '$created' WHERE  id = '$contact_us_id'");
        if(!empty($statement))
        {
            $reoutput['error'] = 'success';
        }
	}
	echo json_encode($reoutput);
?>