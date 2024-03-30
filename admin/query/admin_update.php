<?php
require_once('../../conn.php');
require_once('../../function.php');
$emp_id = $_POST['employee_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$private_role = $_POST['private_role'];

$modified = get_date_now();


try {
  $sql = "UPDATE employee SET username='$username',";
  $sql .= "password='$password',fname='$fname',";
  $sql .= "lname='$lname',private_role='$private_role',";
  $sql .= "modified='$modified' WHERE employee_id='$emp_id'";

  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => true, 'err' => $e->getMessage()]);
}
