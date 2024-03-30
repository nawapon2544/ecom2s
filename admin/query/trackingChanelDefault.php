<?php
require_once('../../conn.php');
require_once('../../function.php');

$track_chanel_id = $_POST['track_chanel_id'];
$set_default = $_POST['set_default'];
$social = $_POST['social'];
$modified = get_date_now();

try {
  $sql = "UPDATE tracking_chanel SET set_default='off' WHERE social='$social';";
  $sql .= "UPDATE tracking_chanel SET set_default='$set_default' WHERE track_chanel_id='$track_chanel_id';";

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
