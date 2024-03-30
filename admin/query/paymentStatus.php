<?php
require_once('../../conn.php');
require_once('../../function.php');
$payment_id = $_POST['payment_id'];
$status = $_POST['status'];
$modified = get_date_now();


try {
  $sql = "UPDATE payment SET status='$status',";
  $sql .= "modified='$modified' ";
  $sql .= "WHERE payment_id='$payment_id'";
  echo $sql;
  $stmt = connect_db()->prepare($sql);

  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
