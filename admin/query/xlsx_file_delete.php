<?php


$dir = "../xlsx";
$xlsx_file = $_POST['xlsx_file'];
$file_delete = "$dir/$xlsx_file";

try {
  if (file_exists($file_delete)) {
    if (unlink($file_delete)) {
      echo json_encode(['result' => true]);
    } else {
      echo json_encode(['result' => false]);
    }
  }
} catch (Exception $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
