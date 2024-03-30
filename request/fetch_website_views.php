<?php
require_once('../function.php');
require_once('../conn.php');
require_once('../admin/lib/config_abouUs_id.php');
$view_id = ConfigABoutUsID::get_view_id();
$data = 1;
$name = 'view';
$status = 'on';
$created = get_date_now();
$modified = get_date_now();

$sql = "SELECT * FROM about_us WHERE row_id='$view_id'";

$row = connect_db()->query($sql);


if ($row->rowCount() == 0) {
  $sql = "INSERT INTO about_us VALUES (?,?,?,?,?,?)";
  $stmt = connect_db()->prepare($sql);
  $stmt->bindParam(1, $view_id);
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
  $view = (int) $row->fetch(PDO::FETCH_ASSOC)['data'];
  $view += 1;
  $sql = "UPDATE about_us SET data=$view,";
  $sql .= "modified='$modified' ";
  $sql .= "WHERE row_id='$view_id'";
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
}
