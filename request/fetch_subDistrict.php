<?php
require_once('../conn.php');

try {
  $district = trim($_POST['district']);
  $sql =  "SELECT * FROM sub_district WHERE district LIKE '%$district%' ORDER BY sub_district ASC";
  $sub_district_row  = connect_db()->query($sql);
  $sub_district_list = [];
  while ($sub_district = $sub_district_row->fetch(PDO::FETCH_ASSOC)) {
    array_push($sub_district_list, [
      'sub_district' => trim($sub_district['sub_district']),
      'postcode' => trim($sub_district['postcode'])
    ]);
  }
  echo json_encode(['result' => true, 'sub_district' => $sub_district_list]);
} catch (PDOException $e) {
  echo json_encode(['result' => false, 'err' => $e->getMessage()]);
}
