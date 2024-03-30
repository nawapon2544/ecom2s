<?php
require_once('../../function.php');
require_once('../../conn.php');
require_once('../lib/config_abouUs_id.php');

$row_id = ConfigABoutUsID::get_warranty_policy_id();
$warranty_policy = $_POST['warranty_policy'];
$name = 'warranty_policy';
$status = 'on';
$created = get_date_now();
$modified = get_date_now();
try {
  $sql = "SELECT row_id FROM about_us WHERE row_id='$row_id'";
  $row = connect_db()->query($sql);
  if ($row->rowCount() == 0) {
    $sql = "INSERT INTO about_us VALUES (?,?,?,?,?,?)";
    $stmt = connect_db()->prepare($sql);
    $stmt->bindParam(1, $row_id);
    $stmt->bindParam(2, $warranty_policy);
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
    $sql = "UPDATE about_us SET data='$warranty_policy',";
    $sql .= "modified='$modified'";
    $sql .= " WHERE row_id='$row_id'";
    echo $sql;
    $stmt = connect_db()->prepare($sql);
    if ($stmt->execute()) {
      echo json_encode(['result' => true]);
    } else {
      echo json_encode(['result' => false]);
    }
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
