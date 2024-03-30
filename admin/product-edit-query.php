<?php
try {
  require_once('../function.php');
  require_once('../conn.php');
  $product_id = $_POST['product_id'];
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
  $product_before_img = empty(trim($_POST['product_before_img']))
    ? [] : explode(',', $_POST['product_before_img']);
  $product_remove_img = empty(trim($_POST['product_remove_img']))
    ? [] : explode(',', $_POST['product_remove_img']);

  $num_before_img = [];
  foreach ($product_before_img as $img) {
    $name =  pathinfo($img, PATHINFO_FILENAME);
    $n = (int) substr($name, stripos($name, '_') + 1);
    array_push($num_before_img, $n);
  }
  $num_before_img_max = max($num_before_img);
  $img_upload = true;
  $product_img_dir = "../product-img";
  if (!dir($product_img_dir)) {
    mkdir($product_img_dir);
  }
  $product_img_files = [];

  if (isset($_FILES['product_img'])) {
    $files = $_FILES['product_img'];
    for ($i = 0; $i < count($files['name']); $i++) {
      $num_before_img_max++;
      $filetype = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
      $old = $files['tmp_name'][$i];

      $n = $product_id . "_$num_before_img_max." . $filetype;
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
  }


  if (!$img_upload) {
    echo json_encode(['result' => false, 'msg' => 'upload file error']);
    return;
  }

  if ($img_upload) {

    $product_img  = [];
    array_push($product_img, ...$product_before_img);
    array_push($product_img, ...$product_img_files);
    $img = implode(',', $product_img);

    $create = get_date_now();
    $modified = get_date_now();
    try {

      $sql = "UPDATE products SET product_name='$product_name',";
      $sql .= "product_category='$product_category',";
      $sql .= "product_type='$product_type',";
      $sql .= "product_cost_price=$product_cost_price,";
      $sql .= "product_price=$product_price,";
      $sql .= "product_real_price=$product_real_price,";
      $sql .= "product_detail='$product_detail',";
      $sql .= "product_remain=$product_remain,";
      $sql .= "product_data='$product_data',";
      $sql .= "product_dimension='$product_dimension',";
      $sql .= "product_keyword='$product_keyword',";
      $sql .= "delivery_cost='$product_delivery_cost',";
      $sql .= "modified='$modified',";
      $sql .= "img='$img' WHERE product_id='$product_id'";
      $stmt = connect_db()->prepare($sql);
      echo $sql;
      try {
        $result =   $stmt->execute();
        if ($result) {
          foreach ($product_remove_img as $img) {
            $files_remove = "../product-img/$img";
            if (file_exists($files_remove)) {
              unlink($files_remove);
            };
          }
          echo json_encode(['result' => true]);
        }
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
