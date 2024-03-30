<?php
require_once('../conn.php');
@session_start();
$user_id = $_SESSION['user_id'];
$email = $_POST['email'];
$sql = "UPDATE user SET email='$email' WHERE  user_id='$user_id'";
try {
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
