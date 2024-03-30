<?php
require_once('../../conn.php');

$val = $_POST['value'];
$sql = "SELECT DISTINCT product_type FROM products WHERE product_type LIKE '%$val%' LIMIT 0,5";
try {
  $row = connect_db()->query($sql);
  $product_type_list = [];
  while ($product_type = $row->fetch(PDO::FETCH_ASSOC)) {
    array_push($product_type_list, $product_type['product_type']);
  }
  echo json_encode(
    [
      'result' => true,
      'product_type' => $product_type_list
    ]
  );
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
