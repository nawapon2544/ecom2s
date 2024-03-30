<?php
require_once('../../function.php');
require_once('../../conn.php');
require_once('../lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_logo_id();
$plattern = $_POST['plattern'];
$data = ['plattern' => $plattern];
$name = 'logo';
$status = 'on';
$created = get_date_now();
$modified =  get_date_now();

$sql = "SELECT * FROM about_us WHERE row_id='$row_id'";

$row = connect_db()->query($sql);
$query = $row->rowCount() == 0 ? 'insert' : 'update';

$logo_dir = '../../logo';
if ($plattern == 'logoImg') {

  if (!is_dir($logo_dir)) {
    mkdir($logo_dir);
  }
  $file =  $_FILES['logo_img'];
  $filename = "logo.png";

  $tmp_old = $file['tmp_name'];
  $tmp_new = "$logo_dir/$filename";
  $m = move_uploaded_file($tmp_old, $tmp_new);

  if (!$m) {
    echo json_encode(['result' => false]);
    return;
  }

  if ($m) {
    $data['val'] = $filename;
  }
}

if ($plattern == 'logoText') {
  if (file_exists("$logo_dir/logo.png")) {
    unlink("$logo_dir/logo.png");
  }
  $data['val'] = $_POST['logo_text'];
}

if ($query == 'insert') {
  $data = json_encode($data);
  $sql = "INSERT INTO about_us VALUES(?,?,?,?,?,?)";
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
if ($query == 'update') {
  $data = json_encode($data);
  $sql = "UPDATE about_us SET data='$data',";
  $sql .= "modified='$modified' WHERE row_id='$row_id'";
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
}
