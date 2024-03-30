<?php
require_once('../conn.php');
@session_start();
$user_id = $_SESSION['user_id'];
$last = (int)$_POST['last'];

$sql = "SELECT  cart.*,products.* FROM cart ";
$sql .= "LEFT JOIN products ON cart.product_id=products.product_id ";
$sql .= "WHERE cart.user_id='$user_id' ORDER BY cart.modified DESC";

echo $sql ;
$fetchAll = connect_db()->query($sql);
$rowAll = $fetchAll->rowCount();
echo $sql;
$sql .= " LIMIT $last,15";
$row = connect_db()->query($sql);

$cart_list = [];
echo $last;
echo $rowAll;
if ($last < ($rowAll)) {
  while ($cart = $row->fetch((PDO::FETCH_ASSOC))) {
    $d = [
      'cart_id' => $cart['cart_id'],
      'product_id' => $cart['product_id'],
      'product_real_price' => $cart['product_real_price'],
      'product_price' => $cart['product_price'],
      'product_name' => $cart['product_name'],
      'product_remain' => $cart['product_remain'],
      'img' => explode(',', $cart['img'])[0],
      'quantity' => $cart['quantity']
    ];
    array_push($cart_list, $d);
  }
}
echo json_encode(['result' => true, 'cart' => $cart_list]);
