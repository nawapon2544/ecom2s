<?php
try {
  require_once('../function.php');
  require_once('../conn.php');
  $product_id = "P-" . date("YmdHis") . "-" . number_random(4) . char_random(2);
  $product_name = $_POST['product_name'];
  $product_cost_price = $_POST['product_cost_price'];
  $product_price = $_POST['product_price'];
  $product_real_price = $_POST['product_real_price'];
  $product_remain = $_POST['product_remain'];
  $product_category = $_POST['product_category'];
  $product_type = $_POST['product_type'];
  $product_detail = $_POST['product_detail'];
  $product_data = $_POST['product_data'];
  $product_dimension = $_POST['product_dimension'];
  $product_keyword = $_POST['product_keyword'];
  $product_delivery_cost = $_POST['product_delivery_cost'];
  $product_img_files = [];
  $files = $_FILES['product_img'];
  $product_img_dir = "../product-img";
  if (!dir($product_img_dir)) {
    mkdir($product_img_dir);
  }
  $img_upload = true;
  for ($i = 0; $i < count($files['name']); $i++) {
    $filetype = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
    $old = $files['tmp_name'][$i];

    $n = $product_id . "_$i." . $filetype;
    $new = "$product_img_dir/$n";
    $m = move_uploaded_file($old, $new);
    if ($m) {
      array_push($product_img_files, $n);
    }
    if (!$m) {
      $img_upload = false;
      return;
    }
  }

  if (!$img_upload) {
    echo json_encode(['result' => false, 'msg' => 'upload file error']);
    return;
  }

  if ($img_upload) {
    $product_img = implode(',', $product_img_files);
    $create = get_date_now();
    $modified = get_date_now();
    try {
      $mysql = connect_db();
      $sql = "INSERT INTO products VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt = connect_db()->prepare($sql);
      $stmt->bindParam(1, $product_id);
      $stmt->bindParam(2, $product_name);
      $stmt->bindParam(3, $product_category);
      $stmt->bindParam(4, $product_type);
      $stmt->bindParam(5, $product_cost_price);
      $stmt->bindParam(6, $product_price);
      $stmt->bindParam(7, $product_real_price);
      $stmt->bindParam(8, $product_detail);
      $stmt->bindParam(9, $product_remain);

      $stmt->bindParam(10, $product_data);
      $stmt->bindParam(11, $product_dimension);
      $stmt->bindParam(12, $product_keyword);
      $stmt->bindParam(13, $product_delivery_cost);
      $stmt->bindParam(14, $create);
      $stmt->bindParam(15, $modified);
      $stmt->bindParam(16, $product_img);


      try {
        $result =   $stmt->execute();
        echo json_encode(['result' => true]);
      } catch (Exception $e) {
        echo json_encode(['result' => false, 'msg' => $e->getMessage()]);
      }
    } catch (PDOException $e) {
      echo json_encode(['result' => false, 'msg' => $e->getMessage()]);
    }
  }
} catch (Exception $e) {
  echo json_encode(['result' => false, 'msg' => $e->getMessage()]);
}
