<?php
require_once('../conn.php');

$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$order_id = isset($_GET['id']) ? $_GET['id'] : '';
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;

$sql = "SELECT * FROM orders  WHERE status='prepare' AND pay_status='paid' ";
$sql .= !empty($order_id) ?  "AND  order_id='$order_id'" : '';
$sql .= " ORDER BY created ASC ";

$row_count_all = connect_db()->query($sql)->rowCount();
$page_all = ceil($row_count_all / $entries);
$query_row = $page * $entries;

$sql .= "LIMIT $query_row,$entries";
$row = connect_db()->query($sql);

$QUERY_STRING_P = $_GET['p'];
$route = "?p=$QUERY_STRING_P";
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
<div class="container bg-white p-2">
  <p class="px-2 py-2 fw-bold bg-light border rounded">
    <i class="fa-solid fa-suitcase"></i>
    คำสั่งซื้อที่ต้องจัดเตรียม
  </p>
  <?php require_once('./entries/ord_prepare_entries_row.php') ?>
  <table class="table table-hover">
    <thead class="table-light">
      <tr class="align-middle">
        <th class="text-center" scope="col" style="width: 5%;">
          รายการ
        </th>
        <th scope="col" style="width: 35%;">หมายเลขคำสั่งซื้อ</th>
        <th scope="col" style="width: 15%;">ชื่อ - นามสกุล</th>
        <th scope="col" style="width: 15%;">วันที่สั่งซื้อ</th>
        <th class="text-center" style="width: 10%;">คัดลอก</th>
        <th class="text-center" style="width: 5%;">พิมพ์</th>
        <th class="text-center" style="width: 10;">เตรียมแล้ว</th>
        <th class="" style="width: 5%;">
          <i class="fa-solid fa-check-to-slot"></i>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
      $idx = $page * $entries + 1;
      while ($ord = $row->fetch(PDO::FETCH_ASSOC)) {  ?>
        <tr class="align-middle">
          <td scope="row" class="text-center">
            <?php echo $idx++  ?>
          </td>
          <td>
            <?php echo $ord['order_id'] ?>
          </td>
          <td><?php echo $ord['fname'] . ' ' . $ord['lname'] ?></td>
          <td><?php echo $ord['created'] ?></td>
          <td class="text-center">
            <div class="tooltip-s">
              <button class="btn btn-hover text-dark copy" data-id="<?php echo $ord['order_id'] ?>">
                <i class="fa-regular fa-copy"></i>
              </button>
              <div class="tooltip-text"></div>
            </div>
          </td>
          <td class="text-center">
            <a target="_blank" href="./ord_prepare_printer.php?order_id=<?php echo $ord['order_id']  ?>" class="btn btn-hover text-dark">
              <i class="fa-solid fa-print"></i>
            </a>
          </td>
          <td class="text-center">
            <button class="btn btn-hover text-dark ord-prepare" data-id="<?php echo  base64_encode($ord['order_id']) ?>">
              <i class="fa-solid fa-check-to-slot"></i>
            </button>
          </td>
          <td class="text-center">
            <div class="form-check align-items-center">
              <input class="form-check-input" name="ord-prepare-select" type="checkbox" value="<?php echo base64_encode($ord['order_id']) ?>">
            </div>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php if ($row->rowCount() == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีรายการ</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/ord_prepare_pagination.php') ?>
</div>
</div>

<div id="ord-prepare-bar" class="ord-bar">
  <button id="ord-prepare-select-confirm" class="btn btn-light btn-hover m-1">
    <i class="fa-solid fa-circle-check"></i>
    ยืนยันการเตรียม
  </button>

  <button id="ord-prepare-print-select" class="btn btn-light btn-hover m-1">
    <i class="fa-solid fa-print"></i>
    พิมพ์ที่เลือก
  </button>

  <button id="ord-prepare-select-all" class="btn btn-hover btn-light m-1">
    <i class="fa-solid fa-check"></i>
    เลือกทั้งหมด
  </button>
</div>
<script src="./script/get_params_script.js"></script>
<script src="./script/orderCopyID.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/order_prepare.js"></script>