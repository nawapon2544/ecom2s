<?php
require_once('../conn.php');

try {
  $sql =  "SELECT * FROM province";
  $row = connect_db()->query($sql);

  $province_list = [];
  while ($province = $row->fetch(PDO::FETCH_ASSOC)) {
    array_push($province_list, $province['province']);
  }
  echo json_encode(['result' => true, 'province' => $province_list]);
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
