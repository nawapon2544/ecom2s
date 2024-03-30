<?php
require_once('../../conn.php');
require_once('../../function.php');

$track_chanel_id = $_POST['track_chanel_id'];
$status = $_POST['status'];
$modified = get_date_now();

try {
  $sql = "UPDATE tracking_chanel SET status='$status',";
  $sql .= "modified='$modified' ";
  $sql .= " WHERE track_chanel_id='$track_chanel_id'";
  $stmt = connect_db()->prepare($sql);

  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
