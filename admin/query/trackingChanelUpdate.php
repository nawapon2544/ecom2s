<?php
require_once('../../conn.php');
require_once('../../function.php');

$track_chanel_id = $_POST['track_chanel_id'];
$social = $_POST['social'];
$account_name = $_POST['account_name'];
$social_link = $_POST['social_link'];
$modified = get_date_now();

try {
  $sql = "UPDATE tracking_chanel SET social='$social',";
  $sql .= "account_name='$account_name',";
  $sql .= "social_link='$social_link',";
  $sql .= "modified='$modified' ";
  $sql .= "WHERE track_chanel_id='$track_chanel_id'";

  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
