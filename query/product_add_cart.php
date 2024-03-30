<?php
require_once('../conn.php');
require_once('../function.php');
@session_start();
if (!isset($_SESSION['user_id'])) {
  echo json_encode(['signin' => false]);
} else {

  $user_id = $_SESSION['user_id'];
  $cart_id = "c_" . date("YmdHis-") . number_random(4) . char_random(2);
  $quantity = $_POST['qty'];
  $product_id = base64_decode($_POST['product_id']);
  $created = get_date_now();
  $modified = get_date_now();
  $type = $_POST['type'];
  try {
    $fetch_product = connect_db()->query("SELECT * FROM cart WHERE product_id='$product_id' AND user_id='$user_id'");

    if ($fetch_product->rowCount() < 1) {
      $stmt = connect_db()->prepare("INSERT INTO cart VALUES(?,?,?,?,?,?)");
      $stmt->bindParam(1, $cart_id);
      $stmt->bindParam(2, $product_id);
      $stmt->bindParam(3, $user_id);
      $stmt->bindParam(4, $quantity);
      $stmt->bindParam(5, $created);
      $stmt->bindParam(6, $modified);

      if ($stmt->execute()) {
        echo json_encode(['result' => true]);
      } else {
        echo json_encode(['result' => false]);
      }
    } else {
      $sql = $type == 'add' ? "UPDATE cart SET quantity=quantity+$quantity "
        : "UPDATE cart SET quantity=$quantity";
      $sql .= " WHERE product_id='$product_id' AND user_id='$user_id'";
      $stmt = connect_db()->prepare($sql);
      if ($stmt->execute()) {
        echo json_encode(['result' => true]);
      } else {
        echo json_encode(['result' => false]);
      }
    }
  } catch (PDOException $e) {
    echo json_encode(['result' => false, 'err' => $e->getMessage()]);
  }
}
