<?php
require_once('../../conn.php');
require_once('../../function.php');
$emp_id = 'emp-' . number_random(4) . '-' . char_random(2);
$username = $_POST['username'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$private_role = $_POST['private_role'];
$created = get_date_now();
$modified = get_date_now();

try {
  $sql = "INSERT INTO employee VALUES(?,?,?,?,?,?,?,?)";
  $stmt = connect_db()->prepare($sql);
  $stmt->bindParam(1, $emp_id);
  $stmt->bindParam(2, $username);
  $stmt->bindParam(3, $password);
  $stmt->bindParam(4, $fname);
  $stmt->bindParam(5, $lname);
  $stmt->bindParam(6, $private_role);
  $stmt->bindParam(7, $created);
  $stmt->bindParam(8, $modified);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
