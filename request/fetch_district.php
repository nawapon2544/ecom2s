<?php
require_once('../conn.php');
$province = trim($_POST['province']);
try {
  $sql =  "SELECT * FROM district WHERE province LIKE '%$province%' ORDER BY district ASC";
  $district_row  = connect_db()->query($sql);
  $district_list = [];

  while ($district = $district_row->fetch(PDO::FETCH_ASSOC)) {
    array_push($district_list, trim($district['district']));
  }
  echo json_encode(['result' => true, 'district' => $district_list]);
} catch (PDOException $e) {
  echo json_encode(['result' => false,'err'=> $e->getMessage()]);
}
