<?php
require_once('../../conn.php');
require_once('../../function.php');
$payment_id = $_POST['payment_id'];
$bank = $_POST['bank'];
$account_name = $_POST['account_name'];
$account_number = $_POST['account_number'];
$modified = get_date_now();

try {
  $sql = "UPDATE payment SET bank='$bank',";
  $sql .= "account_name='$account_name',";
  $sql .= "account_number='$account_number',";
  $sql .= "modified='$modified' WHERE payment_id='$payment_id'";
  $stmt = connect_db()->prepare($sql);

  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
