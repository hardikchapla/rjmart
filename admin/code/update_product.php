<?php
	include('../../connection/connection.php');
	if(isset($_POST["cat_id"]))
	{
		$reoutput = array();
		$statement = $db->prepare(
			"SELECT * FROM product 
			WHERE id = '".$_POST["cat_id"]."' LIMIT 1"
		);

		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$reoutput["cat_id"] = $row["id"];
			$reoutput["cat_name"] = $row["name"];
			$reoutput["description"] = $row["description"];
			/*$reoutput["price"] = $row["price"];*/
			$reoutput["category_id"] = $row["cat_id"];
			$query = $db->prepare("SELECT * FROM product_type WHERE product_id = '".$row['id']."'");
			$query->execute();
			$aa = array();
			$a = 0;
			while($fequery = $query->fetch()){
				$aa[$a]['product_type_id'] = $fequery['product_type_id'];
				$aa[$a]['product_type'] = $fequery['product_type'];
				$aa[$a]['Product_qty'] = $fequery['Product_qty'];
				$aa[$a]['product_type_price'] = $fequery['product_type_price'];
				$a++;
			}
			$reoutput['product_type'] = $aa;
		}
		echo json_encode($reoutput);
	}
?>