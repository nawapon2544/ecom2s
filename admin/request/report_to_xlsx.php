<?php
require_once('../lib/order_status.php');
require_once '../lib/phpspreadsheet/vendor/autoload.php';
require_once('../../conn.php');
require_once('../lib/get_date.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$entries = isset($_POST['entries']) ? $_POST['entries'] : '';
$page = isset($_POST['page']) ? $_POST['page'] : '';
$month = isset($_POST['month']) ?  set_full_month($_POST['month']) : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';

$sql = "SELECT * FROM orders ";


if (!empty($month) && !empty($year)) {
  $sql .= "WHERE created LIKE '%$$month%' ";
} else if (!empty($get_year)) {
  $sql .= "WHERE created LIKE '%$year-%' ";
} else if (!empty($month)) {
  $sql .=  "WHERE created LIKE '%-$month-%' ";
}

$query_row = $page * $entries;
$sql .= "LIMIT $query_row,$entries";

$row = connect_db()->query($sql);

if ($row->rowCount() > 0) {
  try {
    $xlsx_file_name = 'ord-rept';

    if (!empty($month) && !empty($year)) {
      $xlsx_file_name .= "-$year-$month";
    } else if (!empty($month)) {
      $xlsx_file_name .= "-$month-allyear";
    } else if (!empty($year)) {
      $xlsx_file_name .= "-$year";
    }

    if (empty($month) && empty($year)) {
      $xlsx_file_name .= "all";
    }


    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    $arrayData = [
      [
        'ลำดับ', 'รหัสคำสั่งซื้อ', 'วันที่สั่งซื้อ', 'ชื่อลูกค้า', 'ที่อยู่',
        'เบอร์ติดต่อ','สถานะ', 'ค่าขนส่ง', 'ยอดรวม'
      ],
    ];

    $idx = $page * $entries + 1;

    while ($ord = $row->fetch(PDO::FETCH_ASSOC)) {
      $address = json_decode($ord['address']);
      $r = [
        $idx++,
        $ord['order_id'],
        $ord['created'],
        $ord['fname'] . ' ' . $ord['lname'],
        $address[0] . ' ' . $address[1],
        $ord['phone'],
        get_order_status($ord['status']),
        number_format($ord['delivery_cost'], 2),
        number_format($ord['total'], 2)
      ];
      array_push($arrayData, $r);
    }


    $spreadsheet->getActiveSheet()
      ->fromArray(
        $arrayData,  // The data to set
      );
    $entries_end = $idx - 1;
    $entries_no = "[$query_row-$entries_end]";
    $xlsx_file_name .= $entries_no;
    $writer = new Xlsx($spreadsheet);
    $xlsx_created = date_text();
    $writer->save("../xlsx/$xlsx_file_name-$xlsx_created.xlsx");
  } catch (Exception $e) {
    echo json_encode(['result' => true, 'err' => $e->getMessage()]);
  }
}


