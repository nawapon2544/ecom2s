<?php
require_once('../../conn.php');

$track_chanel_id = $_POST['track_chanel_id'];

try {
  $sql = "DELETE FROM  tracking_chanel WHERE track_chanel_id='$track_chanel_id'";
  $stmt = connect_db()->prepare($sql);

  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
