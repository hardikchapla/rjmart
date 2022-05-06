<?php
    if (isset($_REQUEST['productId']) && isset($_REQUEST['status'])) {
        require_once '../../connection/connection.php';
        $productId = $_REQUEST['productId'];
        $status = $_REQUEST['status'];
        $query1 = "Update `product` SET is_active = '$status' WHERE id = '$productId'";
        $update = $db->prepare($query1);
        $update->execute();
        echo "true";
    }
?>