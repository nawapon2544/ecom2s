<?php
require_once('../conn.php');
@session_start();
$user_id = $_SESSION['user_id'];
$last = (int)$_POST['last'];
$sql = "SELECT * FROM orders WHERE user_id='$user_id' AND status='success' ORDER BY created DESC ";

$fetchAll = connect_db()->query($sql);
$rowAll = $fetchAll->rowCount();
$sql .= "LIMIT $last,10";
$row = connect_db()->query($sql);
echo $rowAll;
echo $last;
$cart_list = [];
echo $last;
echo $rowAll;
if ($last < ($rowAll)) {
  echo 'no end loasdd';
  while ($order = $row->fetch((PDO::FETCH_ASSOC))) {
    $d = [
      'order_id' => $order['order_id'],
      'product' => $order['product'],
      'fname'=>$order['fname'],
      'lname'=>$order['fname'],
      'created'=>$order['created'],
      'total'=>$order['total']
    ];
    array_push($cart_list, $d);
  }
}
echo json_encode(['result' => true, 'order' => $cart_list]);
