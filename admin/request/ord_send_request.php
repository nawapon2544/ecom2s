<?php
require_once('../../function.php');
require_once('../../conn.php');

$modified = get_date_now();
$order_id = $_POST['order_id'];
$sql = '';

foreach ($order_id as $ord) {
  $sql .= "UPDATE orders SET delivery_number='$ord[delivery_number]',";
  $sql .= "delivery_service='$ord[delivery_service]',status='progress',modified='$modified' ";
  $sql .= " WHERE order_id='$ord[order_id]';\n ";
}

try {
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
