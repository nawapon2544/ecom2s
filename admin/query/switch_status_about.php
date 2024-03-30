<?php
require_once('../../conn.php');
require_once('../../function.php');
$row_id = $_POST['row_id'];
$status = $_POST['status'];
$modified = get_date_now();
echo $status;
try {
  $sql = "UPDATE about_us SET status='$status',";
  $sql .= "modified='$modified' WHERE row_id='$row_id'";
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
