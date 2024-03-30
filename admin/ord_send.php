<?php
require_once('../conn.php');

$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$order_id = isset($_GET['id']) ? $_GET['id'] : '';
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;


$sql = "SELECT * FROM orders WHERE status='send' AND pay_status='paid' ";
$sql .= !empty($order_id) ?  " AND order_id='$order_id'" : '';
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
<div class="bg-white container p-2">
  <p class="px-2 py-2 fw-bold bg-light border rounded">
    <i class="fa-solid fa-truck-fast"></i>
    คำสั่งซื้อที่ต้องส่ง
  </p>
  <?php require_once('./entries/ord_send_entries_row.php') ?>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr class="align-middle">
          <th class="text-center" scope="col" style="width: 5%;">#</th>
          <th scope="col" style="width: 25%;">คำสั่งซื้อ</th>
          <th scope="col" style="width: 20%;">ชื่อ - นามสกุล</th>
          <th style="width: 20%;">วันสั่งซื้อ</th>
          <th class="text-center" style="width: 5%;">คัดลอก</th>
          <th class="text-center" style="width: 5%;">ส่งพัสดุ</th>
          <th class="text-center" style="width: 5%;">
            <i class="fa-solid fa-check-to-slot"></i>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($ord = $row->fetch(PDO::FETCH_ASSOC)) {  ?>
          <tr class="align-middle">
            <td class="text-center">
              <?php echo $idx++  ?>
            </td>
            <td>
              <?php echo $ord['order_id'] ?>
            </td>
            <td>
              <?php echo $ord['fname'] . ' ' . $ord['lname'] ?>
            </td>
            <td>
              <?php echo $ord['created'] ?>
            </td>
            <td class="text-center">
              <div class="tooltip-s">
                <button class="btn btn-hover text-dark copy" data-id="<?php echo $ord['order_id'] ?>">
                  <i class="fa-regular fa-copy"></i>
                </button>
                <div class="tooltip-text"></div>
              </div>
            </td>
            <td class="text-center">
              <button class="btn btn-hover text-dark ord-send" data-id="<?php echo  base64_encode($ord['order_id']) ?>">
                <i class="fa-solid fa-truck-fast"></i>
              </button>
            </td>
            <td class="text-center">
              <input class="form-check-input" name="ord-send-select" type="checkbox" value="<?php echo base64_encode($ord['order_id']) ?>">
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php if ($row->rowCount() == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีรายการ</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/ord_send_pagination.php') ?>
</div>

<div class="ord-bar">
  <button id="ord-send-select-add-number" class="btn btn-light btn-hover m-1">
    <i class="fa-solid fa-paper-plane"></i>
    ส่งที่เลือก
  </button>

  <button id="ord-send-select-all" class="btn btn-hover btn-light m-1">
    <i class="fa-solid fa-check"></i>
    เลือกทั้งหมด
  </button>
</div>
<?php require_once('./ord_send_modal.php')  ?>
<script src="./script/entriesRow.js"></script>
<script src="./script/get_params_script.js"></script>
<script src="./script/orderCopyID.js"></script>
<script src="./js/ord_send.js"></script>