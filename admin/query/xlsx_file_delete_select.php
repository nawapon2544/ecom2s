<?php
$xlsx_files = json_decode($_POST['xlsx_file']);
$dir = "../xlsx";


try {
  $fail = 0;
  $success = 0;
  foreach ($xlsx_files as $file) {
    $file_delete = "$dir/$file";
    if (file_exists($file_delete)) {
      if (unlink($file_delete)) {
        $success++;
      } else {
        $fail++;
      }
    }
  };
  echo json_encode([
    'result' => true,
    'success' => $success,
    'fail' => $fail
  ]);
} catch (Exception $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
