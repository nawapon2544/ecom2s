<?php
require_once('../../conn.php');
$order_id = $_POST['order_id'];
$sql = "UPDATE orders SET pay_status='paid',";
$sql .= "status='prepare' WHERE order_id ='$order_id'";

try {
  $stmt = connect_db()->prepare($sql);
  if($stmt->execute()){
    echo json_encode(['result' => true]);
  }else{
    echo json_encode(['result' => false]);
  }
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
