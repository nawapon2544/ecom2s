<?php
require_once('../../function.php');
require_once('../../conn.php');
require_once('../lib/config_abouUs_id.php');

$row_id = ConfigABoutUsID::get_order_cancel_id();
$order_cancel = $_POST['order_cancel'];
$name = 'order_cancel';
$status = 'on';
$created = get_date_now();
$modified = get_date_now();
try {
  $sql = "SELECT row_id FROM about_us WHERE row_id='$row_id'";
  $row = connect_db()->query($sql);
  if ($row->rowCount() == 0) {
    $sql = "INSERT INTO about_us VALUES (?,?,?,?,?,?)";
    $stmt = connect_db()->prepare($sql);
    $stmt->bindParam(1, $row_id);
    $stmt->bindParam(2, $order_cancel);
    $stmt->bindParam(3, $name);
    $stmt->bindParam(4, $status);
    $stmt->bindParam(5, $created);
    $stmt->bindParam(6, $modified);
    if ($stmt->execute()) {
      echo json_encode(['result' => true]);
    } else {
      echo json_encode(['result' => false]);
    }
  }

  if ($row->rowCount() == 1) {
    $sql = "UPDATE about_us SET data='$order_cancel',";
    $sql .= "modified='$modified' WHERE row_id='$row_id'";
    $stmt = connect_db()->prepare($sql);
    if ($stmt->execute()) {
      echo json_encode(['result' => true]);
    } else {
      echo json_encode(['result' => false]);
    }
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
