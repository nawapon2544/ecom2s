<?php
require_once('../conn.php');
require_once('../function.php');
$sql =  "INSERT INTO user VALUES(?,?,?,?,?,?,?,?,?)";
$user_id = 'usid-' . date("Hmd-") . number_random(4) . char_random(2) . number_random(2);
$username = $_POST['username'];
$email = $_POST['email'];
$password = md5(trim($_POST['password']));
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$created = get_date_now();
$modified = get_date_now();



try {
  $stmt = connect_db()->prepare($sql);
  $stmt->bindParam(1, $user_id);
  $stmt->bindParam(2, $username);
  $stmt->bindParam(3, $email);
  $stmt->bindParam(4, $password);
  $stmt->bindParam(5, $fname);
  $stmt->bindParam(6, $lname);
  $stmt->bindParam(7, $phone);
  $stmt->bindParam(8, $created);
  $stmt->bindParam(9, $modified);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false]);
}
