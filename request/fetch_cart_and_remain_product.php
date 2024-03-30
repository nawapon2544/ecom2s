<?php
require_once('../conn.php');
@session_start();
$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];

try {
  $sql = "SELECT cart.*,products.* FROM cart LEFT JOIN products ON ";
  $sql .= "cart.product_id=products.product_id";
  $sql .= " WHERE cart.user_id='$user_id' AND cart.product_id='$product_id'";
  $cart_row = connect_db()->query($sql);
  $row_count = $cart_row->rowCount();
  $cart = $cart_row->fetch(PDO::FETCH_ASSOC);
  $cart_count = $row_count > 0 ? $cart['quantity'] : 0;

  try {
    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $row = connect_db()->query($sql);
    $product = $row->fetch(PDO::FETCH_ASSOC);
    $remain = $product['product_remain'];
    echo json_encode(['result' => true, 'cart_count' => $cart_count, 'remain' => $remain]);
  } catch (PDOException $e) {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false]);
}
