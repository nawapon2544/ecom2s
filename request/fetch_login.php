<?php
@session_start();
require_once('../conn.php');
$login = $_POST['username'];
$password = md5(trim($_POST['password']));
$sql = "SELECT * FROM user WHERE (username='$login' OR email='$login') AND password='$password'";
$result = connect_db()->query($sql);
if ($result->rowCount() == 0) {
  echo json_encode(['result' => false]);
} else {
  $row = $result->fetch(PDO::FETCH_ASSOC);
  $_SESSION['user_id'] = $row['user_id'];

  if ($_SESSION['user_id']) {
    echo json_encode(['result' => true]);
  }
}
