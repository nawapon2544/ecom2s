<?php
require_once('../function.php');
require_once('../conn.php');
require_once('./lib/get_date.php');
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;
$get_year = isset($_GET['year']) ? $_GET['year'] : '';
$get_month = isset($_GET['month']) ? set_full_month($_GET['month']) : '';

$sql = "SELECT * FROM orders ";



if (!empty($get_month) && !empty($get_year)) {
  $sql .= "WHERE created LIKE '%$get_year-$get_month%' ";
} else if (!empty($get_year)) {
  $sql .= "WHERE created LIKE '%$get_year-%' ";
} else if (!empty($get_month)) {
  $sql .=  "WHERE created LIKE '%-$get_month-%' ";
}

$sql .= " ORDER BY created ASC ";
$row_count_all = connect_db()->query($sql)->rowCount();
$page_all = ceil($row_count_all / $entries);
$query_row = $page * $entries;

$sql .= "LIMIT $query_row,$entries";
$row = connect_db()->query($sql);

$QUERY_STRING_P = $_GET['p'];
$route = "?p=$QUERY_STRING_P";
if (!empty($get_month) && !empty($get_year)) {
  $route  .= "&year=$get_year&month=$get_month";
} else if (!empty($get_year)) {
  $route .= "&year=$get_year";
} else if (!empty($get_month)) {
  $route .=  "&month=$get_month";
}
$route  .= "&entries=$entries";
$route .= "&page=";

$page_target = ceil($row_count_all / $entries);
if ($page + 1 > $page_target) {
  if ($page > 0) {
    $page--;
    $route .= $page;
    $route = "'./$route'";
    echo "<script>location.assign($route)</script>";
  }
}

?>

<div class="bg-white container p-2">
  <p class="px-2 py-2 fw-bold bg-light border rounded">
  <i class="fa-solid fa-file-lines"></i>
    รายงาน
  </p>
  <?php require_once('./entries/report_entries_row.php') ?>
  <div class="table-responsive">
    <table class="table">
      <thead class="table-light">
        <tr>
          <th style="width: 5%;" scope="col">#</th>
          <th style="width: 25%;" scope="col">รหัสคำสั่งซื้อ</th>
          <th style="width: 15%;" scope="col">วันที่สั่งซื้อ</th>
          <th style="width: 25%;" scope="col">ชื่อลูกค้า</th>
          <th style="width: 15%;" class="text-end" scope="col">ค่าขนส่ง</th>
          <th style="width: 15%;" class="text-end" scope="col">ยอดรวม</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($order = $row->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr>
            <td scope="row">
              <?php echo $idx++ ?>
            </td>
            <td>
              <?php echo $order['order_id'] ?>
            </td>
            <td>
              <?php echo $order['created'] ?>
            </td>
            <td>
              <?php echo $order['fname'] . ' ' . $order['lname'] ?>
            </td>
            <td class="text-end">
              <?php echo number_format($order['delivery_cost'], 2) ?>
            </td>

            <td class="text-end">
              <?php echo number_format($order['total'], 2) ?>
            </td>

          </tr>
        <?php  } ?>
      </tbody>
    </table>
  </div>
  <?php if ($row->rowCount() == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีรายการ</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/report_pagination.php') ?>
</div>

<script src="./script/get_params_script.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/report.js"></script>