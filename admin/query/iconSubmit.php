<?php
require_once('../../conn.php');
require_once('../../function.php');
require_once('../lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_icon_id();
$data = '';
$name = 'icon';
$status = 'on';
$created = get_date_now();
$modified = get_date_now();
$sql = "SELECT row_id FROM about_us WHERE row_id='$row_id'";

$logo_dir = "../../logo";

if (!is_dir($logo_dir)) {
  mkdir($logo_dir);
}


$file = $_FILES['icon'];
$filename = "icon.png";
$tmp_name = $file['tmp_name'];
$new_tmp = "$logo_dir/$filename";

$m = move_uploaded_file($tmp_name, $new_tmp);

if (!$m) {
  echo json_encode(['result' => false]);
  return;
}

if ($m) {
  $data = $filename;
}
$row = connect_db()->query($sql);
if ($row->rowCount() == 0) {

  try {
    $sql = "INSERT INTO about_us VALUES (?,?,?,?,?,?) ";
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
  } catch (PDOException $e) {
    echo json_encode(['result' => false, 'err' => $e->getMessage()]);
  }
}

if ($row->rowCount() == 1) {
  try {
    $sql = "UPDATE about_us SET data='$data',";
    $sql .= "modified='$modified' WHERE row_id='$row_id'";
    $stmt = connect_db()->prepare($sql);
    if ($stmt->execute()) {
      echo json_encode(['result' => true]);
    } else {
      echo json_encode(['result' => false]);
    }
  } catch (PDOException $e) {
    echo json_encode(['result' => false, 'err' => $e->getMessage()]);
  }
}
