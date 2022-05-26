<?php
    if (isset($_REQUEST['pincodeId']) && isset($_REQUEST['status'])) {
        require_once '../../connection/connection.php';
        $pincodeId = $_REQUEST['pincodeId'];
        $status = $_REQUEST['status'];
        $query1 = "Update `pincode` SET is_active = '$status' WHERE id = '$pincodeId'";
        $update = $db->prepare($query1);
        $update->execute();
        echo "true";
    }
?>