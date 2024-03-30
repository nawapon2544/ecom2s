<?php
require_once('../../conn.php');
$slide_id = $_POST['slide_id'];
$img = $_POST['img'];



try {
  $sql = "DELETE FROM slide WHERE slide_id='$slide_id'";
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    $file_delete = "../../picture-slide/$img";
    if (file_exists($file_delete)) {
      unlink($file_delete);
    }
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
