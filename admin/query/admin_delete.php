<?php
require_once('../../conn.php');
$emp_id = $_POST['employee_id'];


try {
  $sql = "DELETE FROM employee WHERE employee_id='$emp_id' ";
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => true, 'err' => $e->getMessage()]);
}
