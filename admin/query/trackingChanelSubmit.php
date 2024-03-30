<?php
require_once('../../conn.php');
require_once('../../function.php');

$track_chanel_id = "TRK-" . number_random(4) . "-";
$track_chanel_id .= char_random(2) . "-" . number_random(2);
$social = $_POST['social'];
$account_name = $_POST['account_name'];
$social_link = $_POST['social_link'];
$set_default = 'off';
$status = 'on';
$created = get_date_now();
$modified = get_date_now();

try {
  $sql = "INSERT INTO tracking_chanel VALUES(?,?,?,?,?,?,?,?)";
  $stmt = connect_db()->prepare($sql);
  $stmt->bindParam(1, $track_chanel_id);
  $stmt->bindParam(2, $social);
  $stmt->bindParam(3, $account_name);
  $stmt->bindParam(4, $social_link);
  $stmt->bindParam(5, $set_default);
  $stmt->bindParam(6, $status);
  $stmt->bindParam(7, $created);
  $stmt->bindParam(8, $modified);

  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
