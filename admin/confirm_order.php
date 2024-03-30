<?php
require_once('../conn.php');
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;
$order_id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT * FROM orders WHERE pay_status='progress'";
$sql .= !empty($order_id) ? " AND order_id='$order_id'" : '';
$sql .= " ORDER BY created ASC ";

$row_count_all = connect_db()->query($sql)->rowCount();
$page_all = ceil($row_count_all / $entries);
$query_row = $page * $entries;

$sql .= " LIMIT $query_row,$entries";
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
    <i class="fa-solid fa-retweet"></i>
    ยืนยันคำสั่งซื้อ
  </p>
  <?php require_once('./entries/confirm_order_entries_row.php') ?>
  <div class="table-responsive">
    <table class="table">
      <thead class="table-light">
        <tr class="align-middle">
          <th style="width: 5%;" scope="col">#</th>
          <th style="width: 25%;" scope="col">รหัสคำสั่งซื้อ</th>
          <th style="width: 15%;" scope="col">วันที่สั่งซื้อ</th>
          <th style="width: 15%;" class="text-end" scope="col">ยอดรวม</th>
          <th style="width: 10%;" class="text-center" scope="col">หลักฐาน</th>
          <th style="width: 20%;" class="text-center" scope="col">ยืนยัน</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($order = $row->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr class="align-middle">
            <td scope="row">
              <?php echo $idx++ ?>
            </td>
            <td>
              <p class="m-0"><?php echo $order['order_id'] ?></p>
              <p class="m-0">
                <?php echo $order['fname'] . ' ' . $order['lname'] ?>
              </p>
            </td>
            <td>
              <?php echo $order['created'] ?>
            </td>

            <td class="text-end">
              <?php echo number_format($order['total'], 2) ?>
            </td>
            <td class="text-center">
              <button class="btn btn-light show-slip" data-slip="<?php echo $order['statement'] ?>">
                <i class="fa-solid fa-paperclip"></i>
              </button>
            </td>
            <td class="text-center">
              <button class="m-1 btn btn-none confirm-order" data-id="<?php echo $order['order_id'] ?>">
                <i class="fa-solid fa-circle-check"></i>
                ยืนยัน
              </button>
              <button class="m-1 btn btn-none cancel-order" data-id="<?php echo $order['order_id'] ?>">
                <i class="fa-solid fa-circle-xmark"></i>
                ยกเลิก
              </button>
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
  <?php require_once('./pagination/confirm_order_pagination.php') ?>
</div>
<?php require_once('./confirm_order_modal.php') ?>
<script src="./script/get_params_script.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/confirm_order.js"></script>
