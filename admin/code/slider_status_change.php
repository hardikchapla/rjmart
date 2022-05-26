<?php
    if (isset($_REQUEST['sliderId']) && isset($_REQUEST['status'])) {
        require_once '../../connection/connection.php';
        $sliderId = $_REQUEST['sliderId'];
        $status = $_REQUEST['status'];
        $query1 = "Update `slider` SET is_active = '$status' WHERE slider_id = '$sliderId'";
        $update = $db->prepare($query1);
        $update->execute();
        echo "true";
    }
?>