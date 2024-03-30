<?php
require_once('../../conn.php');
$order_id = $_POST['order_id'];

$sql = "SELECT * FROM orders WHERE status='prepare' AND order_id IN ($order_id)";

$row = connect_db()->query($sql);

$order_prepare_list = [];
while ($order = $row->fetch(PDO::FETCH_ASSOC)) {
  $product = json_decode($order['product']);
  $address = json_decode($order['address']);
  $d = [
    'order_id' => $order['order_id'],
    'created' => $order['created'],
    'product' => $product,
    'address' => $address
  ];
  array_push($order_prepare_list, $d);
}

echo json_encode($order_prepare_list);
