<?php
require_once('../../conn.php');
$user_id = $_POST['user_id'];
$sql = "DELETE FROM user WHERE user_id='$user_id'";

try {
  $stmt = connect_db()->query($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => true, 'err' => $e->getMessage()]);
}
