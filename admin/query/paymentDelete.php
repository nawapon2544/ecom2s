<?php
require_once('../../conn.php');
$payment_id = $_POST['payment_id'];
try {
  $sql = "DELETE FROM payment WHERE payment_id='$payment_id'";
  $stmt = connect_db()->prepare($sql);

  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
