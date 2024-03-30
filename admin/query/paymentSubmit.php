<?php
require_once('../../conn.php');
require_once('../../function.php');
$payment_id = "B-" . number_random(4) . '-' . char_random(2) . '-' . number_random(2);
$bank = $_POST['bank'];
$account_name = $_POST['account_name'];
$account_number = $_POST['account_number'];
$status = 'off';
$created = get_date_now();
$modified = get_date_now();


try {
  $sql = "INSERT INTO payment VALUES(?,?,?,?,?,?,?)";
  $stmt = connect_db()->prepare($sql);
  $stmt->bindParam(1, $payment_id);
  $stmt->bindParam(2, $bank);
  $stmt->bindParam(3, $account_name);
  $stmt->bindParam(4, $account_number);
  $stmt->bindParam(5, $status);
  $stmt->bindParam(6, $created);
  $stmt->bindParam(7, $modified);

  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
