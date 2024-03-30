<?php
require_once('../conn.php');
$email =  $_POST['email'];
$sql = "SELECT * FROM user WHERE email='$email'";

$row = connect_db()->query($sql);
$row_count = $row->rowCount();
if ($row_count == 0) {
  echo json_encode(['result' => true,]);
} else {
  echo json_encode(['result' => false]);
}
