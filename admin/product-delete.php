<?php
require_once('../conn.php');

try {
  $product_id = $_POST['product_id'];
  $img = explode(',', $_POST['img']);
  $sql = "DELETE  FROM products WHERE product_id='$product_id'";
  $stmt = connect_db()->prepare($sql);
  $result = $stmt->execute();

  if ($result) {
    foreach ($img as $img) {
      $file = "../product-img/$img";
      if (file_exists($file)) {
        unlink($file);
      }
    }
    echo json_encode(['result' => true]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'msg' => $e->getMessage()]);
}
