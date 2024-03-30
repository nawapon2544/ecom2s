<?php
require_once('../../conn.php');
require_once('../lib/config_abouUs_id.php');
require_once('../../function.php');

$dir = "../../logo";
if (!is_dir($dir)) {
  mkdir($dir);
}
$qrcode_id = ConfigABoutUsID::get_qrcode_id();
$name = 'qrcode';
$status = 'on';
$created = get_date_now();
$modified = get_date_now();


$file =  $_FILES['qrcode'];
$tmp_name = $file['tmp_name'];
$filename = "qrcode.jpg";
$tmp_new = "$dir/$filename";

$m = move_uploaded_file($tmp_name, $tmp_new);

if (!$m) {
  echo json_encode(['result' => false]);
  return;
}

$sql = "SELECT row_id FROM about_us WHERE row_id='$qrcode_id'";
$row = connect_db()->query($sql);

if ($m) {
  if ($row->rowCount() == 0) {
    $sql = "INSERT INTO about_us VALUES(?,?,?,?,?,?)";
    $stmt = connect_db()->prepare($sql);
    $stmt->bindParam(1, $qrcode_id);
    $stmt->bindParam(2, $filename);
    $stmt->bindParam(3, $name);
    $stmt->bindParam(4, $status);
    $stmt->bindParam(5, $created);
    $stmt->bindParam(6, $modified);

    if ($stmt->execute()) {
      echo json_encode(['result' => true]);
    }else{
      echo json_encode(['result' => false]);
    }
  }
}
