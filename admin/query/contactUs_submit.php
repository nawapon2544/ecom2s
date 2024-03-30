<?php
require_once('../../conn.php');
require_once('../../function.php');
require_once('../lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_contact_id();
$data = $_POST['data'];
$name = 'contact_and_about';
$status = 'on';
$created = get_date_now();
$modified = get_date_now();
$sql = "SELECT * FROM `about_us` WHERE `row_id`='$row_id'";
echo $sql;
$row = connect_db()->query($sql);
if ($row->rowCount() == 0) {
  $sql = "INSERT INTO `about_us` VALUES(?,?,?,?,?,?)";
  $stmt = connect_db()->prepare($sql);
  $stmt->bindParam(1, $row_id);
  $stmt->bindParam(2, $data);
  $stmt->bindParam(3, $name);
  $stmt->bindParam(4, $status);
  $stmt->bindParam(5, $created);
  $stmt->bindParam(6, $modified);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
}
if ($row->rowCount() == 1) {
  echo "up";
  $sql = "UPDATE `about_us` SET `data`='$data',";
  $sql .= "`modified`='$modified' WHERE `row_id`='$row_id'";
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
}
