<?php
header('Content-type:application/json');
include('../../connection/connection.php');
$reoutput = array();
$id = $_REQUEST['id'];
$query = "SELECT id, image FROM product_image where p_id = $id";
$statement = $db->query($query);
$result = $statement->fetchAll();
$reoutput = $result;
echo json_encode($reoutput);
?>