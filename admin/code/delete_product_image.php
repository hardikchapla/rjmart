<?php
if ($_POST['id']) {
    require_once '../../connection/connection.php';
    $id = $_POST['id'];
    $query = "DELETE FROM product_image WHERE id= $id";
    $stmt = $db->prepare( $query );
    $stmt->execute();
    if ($stmt){
        $image = $_POST['image'];
        unlink('../../assets/img/product/'.$image);
    }
}
?>