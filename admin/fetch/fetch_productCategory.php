<?php
require_once('../../conn.php');
$val = $_POST['value'];
$sql = "SELECT DISTINCT product_category FROM products WHERE product_category LIKE '%$val%' LIMIT 0,5";

try {
  $row = connect_db()->query($sql);
  $p_category_list = [];
  while ($p_category = $row->fetch(PDO::FETCH_ASSOC)) {
    array_push($p_category_list, $p_category['product_category']);
  }
  echo json_encode(
    [
      'result' => true,
      'product_category' => $p_category_list
    ]
  );
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
