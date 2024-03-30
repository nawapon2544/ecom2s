<?php
require_once('../../conn.php');
require_once('../../function.php');

$order_id = $_POST['order_id'];
$status = $_POST['status'];
$modified = get_date_now();
$sql = "UPDATE orders SET status='$status',";
$sql .= "modified ='$modified' WHERE order_id='$order_id'";
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
