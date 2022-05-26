<?php
    if (isset($_REQUEST['categoryId']) && isset($_REQUEST['status'])) {
        require_once '../../connection/connection.php';
        $categoryId = $_REQUEST['categoryId'];
        $status = $_REQUEST['status'];
        $query1 = "Update `category` SET is_active = '$status' WHERE id = '$categoryId'";
        $update = $db->prepare($query1);
        $update->execute();
        echo "true";
    }
?>