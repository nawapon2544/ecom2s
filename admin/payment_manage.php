<?php
require_once('../conn.php');
require_once('./lib/payment_display.php');

$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;

$sql = "SELECT * FROM payment ";
$sql .= "ORDER BY created ASC ";

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
    <i class="fa-brands fa-paypal"></i>
    จัดการธนาคาร
  </p>
  <?php require_once('./entries/entries_row.php') ?>
  <div class="table-responsive">
    <table class="table">
      <thead class="table-light">
        <tr class="align-middle">
          <th class="text-center" style="width: 5%;" scope="col">#</th>
          <th style="width: 20%;" scope="col">ธนาคาร</th>
          <th style="width: 20%;" scope="col">ชื่อบัญชี</th>
          <th style="width: 15%;" scope="col">หมายเลข</th>
          <th class="text-center" style="width: 10%;" scope="col">เปิด-ปิด</th>
          <th class="text-center" style="width: 5%;" scope="col">แก้ไข</th>
          <th class="text-center" style="width: 5%;" scope="col">ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($payment = $row->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr class="align-middle">
            <th class="text-center" scope="row">
              <?php echo $idx++; ?>
            </th>
            <td>
              <img src="../icon-bank/<?php echo $payment['bank'] ?>.png" class="icon-bank">
              <?php echo get_bank($payment['bank']) ?>
            </td>
            <td><?php echo $payment['account_name'] ?></td>
            <td>
              <?php echo $payment['account_number'] ?>
            </td>
            <td class="text-center">
              <?php $checked = $payment['status'] == 'on' ? 'checked' : '' ?>
              <div class="form-switch">
                <input <?php echo $checked ?> class="form-check-input payment-switch" value="<?php echo $payment['payment_id'] ?>" type="checkbox">
              </div>
            </td>
            <td class="text-center">
              <button class="btn text-dark payment-edit" data-id="<?php echo $payment['payment_id']  ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
            </td>
            <td class="text-center">
              <button class="btn  text-dark payment-delete" data-id="<?php echo $payment['payment_id']  ?>">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </td>
          </tr>
        <?php   } ?>

      </tbody>
    </table>
  </div>
  <?php if ($row->rowCount() == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีรายการ</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/payment_manage_pagination.php') ?>
</div>
<script src="./script/get_params_script.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/payment_manage.js"></script>