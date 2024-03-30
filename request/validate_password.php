<?php
require_once('../conn.php');
@session_start();
$user_id = $_SESSION['user_id'];

$password = md5(trim($_POST['password']));
$sql = "SELECT * FROM user WHERE user_id='$user_id' AND password='$password'";
$row = connect_db()->query($sql);

$row_count = $row->rowCount();

if ($row_count == 0) {
  echo json_encode(['result' => false]);
} else if ($row_count > 0) {
  echo json_encode(['result' => true]);
}
