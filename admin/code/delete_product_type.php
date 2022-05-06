<?php
if ($_POST['product_type_id']) {
    require_once '../../connection/connection.php';
    $product_type_id = $_POST['product_type_id'];
    $query = "DELETE FROM product_type WHERE product_type_id= $product_type_id";
    $stmt = $db->prepare( $query );
    $stmt->execute();
}
?>