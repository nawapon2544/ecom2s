<?php

require_once('../conn.php');
require_once('../function.php');

$id = "v-" . date("Ymd") .'-'. char_random(4) . '-' . number_random(2);
$product_id = $_POST['product_id'];
$view = 1;
$created = get_date_now();
$modified =  get_date_now();


$sql = "SELECT view FROM product_view WHERE product_id ='$product_id'";
$row = connect_db()->query($sql);

if ($row->rowCount() == 0) {
  $sql = "INSERT INTO product_view VALUES(?,?,?,?,?)";
  $stmt = connect_db()->prepare($sql);
  $stmt->bindParam(1, $id);
  $stmt->bindParam(2, $product_id);
  $stmt->bindParam(3, $view);
  $stmt->bindParam(4, $created);
  $stmt->bindParam(5, $modified);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
}

if ($row->rowCount() == 1) {

  $sql = "UPDATE product_view SET view=view+$view,";
  $sql .= "modified='$modified' WHERE product_id='$product_id'";
  $stmt = connect_db()->prepare($sql);
  if ($stmt->execute()) {
    echo json_encode(['result' => true]);
  } else {
    echo json_encode(['result' => false]);
  }
}
