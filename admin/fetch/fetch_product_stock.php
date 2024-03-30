<?php
require_once('../../conn.php');
$name = $_POST['name'];
$sql = "SELECT * FROM products WHERE product_name LIKE'%$name%'";
$row = connect_db()->query($sql);

$product_list  = [];
while ($product = $row->fetch(PDO::FETCH_ASSOC)) {
  array_push($product_list, $product);
}

echo json_encode(['result'=>true,'product'=>$product_list]);