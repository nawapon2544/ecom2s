<?php
require_once('../conn.php');
$username=  $_POST['username'];
$sql = "SELECT * FROM user WHERE username='$username'";

$row = connect_db()->query($sql);
$row_count = $row->rowCount();
echo $row_count;
if ($row_count == 0) {
  echo json_encode(['result' => true, 'register' => false]);
} else {
  echo json_encode(['result' => false, 'register' => true]);
}
