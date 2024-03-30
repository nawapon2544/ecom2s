<?php
require_once('../../conn.php');
require_once('../../function.php');
$slide_id = "P" . date("HmdHis");
$descript = $_POST['descript'];
$created = get_date_now();
$modified = get_date_now();

$slide_dir = "../../picture-slide";

if (!is_dir($slide_dir)) {
  echo "non";
  mkdir($slide_dir);
}
$file = $_FILES['slide'];
$tmp_old = $file['tmp_name'];
$img  = "$slide_id.jpg";
$new_tmp = "$slide_dir/$img";
echo $new_tmp;
$m = move_uploaded_file($tmp_old, $new_tmp);

if (!$m) {
  echo json_encode(['result' => false]);
  return;
}


if ($m) {
  try {
    $sql = "INSERT INTO slide VALUES(?,?,?,?,?)";
    $stmt = connect_db()->prepare($sql);
    $stmt->bindParam(1, $slide_id);
    $stmt->bindParam(2, $img);
    $stmt->bindParam(3, $descript);
    $stmt->bindParam(4, $created);
    $stmt->bindParam(5, $modified);

    if ($stmt->execute()) {
      echo json_encode(['result' => true]);
    } else {
      echo json_encode(['result' => false]);
    }
  } catch (PDOException $e) {
    echo json_encode(['result' => false, 'err' => $e->getMessage()]);
  }
}
