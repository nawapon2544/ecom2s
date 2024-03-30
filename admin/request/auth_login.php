<?php
@session_start();
require_once('../../conn.php');
require_once('../lib/config.php');
$username = $_POST['username'];
$password = $_POST['password'];

$config = ConfigAdmin::config();
$config_admin = $config['admin'];
$config_password = $config['password'];

$validate = false;

$emp_fname = '';

if ($config_admin == $username && $config_password == $password) {
  $validate = true;
  $emp_fname = 'admin';
} else {
  $sql = "SELECT * FROM employee WHERE username='$username' AND password='$password' ";
  $row = connect_db()->query($sql);

  if ($row->rowCount() == 0) {
    $validate = false;
  }
  if ($row->rowCount() == 1) {
    $validate = true;
    $emp_fname = $row->fetch(PDO::FETCH_ASSOC)['fname'];
  }
}


if ($validate) {
  $_SESSION['username'] = $username;
  $_SESSION['employee_fname'] = $emp_fname;
  if (isset($_SESSION['username']) && isset($_SESSION['employee_fname'])) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
}else{
  echo json_encode(['result' => false]);
}
