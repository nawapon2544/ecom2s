<?php
require_once('./lib/order_payStatus.php');
require_once('./lib/order_status.php');
$status = isset($_GET['status']) ? $_GET['status'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$order_id = isset($_GET['id']) ? $_GET['id'] : '';
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;
$entries = !empty($order_id) ? 1 : $entries;


$_dt = isset($_GET['dt']) ? $_GET['dt'] : '';
$_date_start = isset($_GET['date_start']) ? $_GET['date_start'] : '';
$_date_end = isset($_GET['date_end']) ? $_GET['date_end'] : '';

$name = isset($_GET['name']) ? $_GET['name'] : '';
$text_name_sql = '';
if (!empty($name)) {
  $text_name_sql = " WHERE ";
  $name_text_word = explode('-', $name);
  foreach ($name_text_word as $i => $n) {
    $text_name_sql .= "fname LIKE '%$n%' OR lname LIKE '%$n%' ";
    if ($i < count($name_text_word) - 1) {
      $text_name_sql .= " OR ";
    }
  }
}
$sql = "SELECT * FROM orders ";

$sql .= !empty($order_id) ?  "WHERE order_id='$order_id'" : '';
$sql .= !empty($text_name_sql) ? $text_name_sql : '';
$sql .= !empty($_dt) ? "WHERE created LIKE '%$_dt%' " : '';
$sql .= !empty($_date_start) && !empty($_date_end)
  ? "WHERE created BETWEEN '$_date_start' AND '$_date_end' " : '';

$sql .= !empty($status) ? "WHERE status='$status' " : '';
$sql .=  " ORDER BY created DESC ";


$row_count_all = connect_db()->query($sql)->rowCount();
$page_all = ceil($row_count_all / $entries);
$query_row = $page * $entries;

$sql .= "LIMIT $query_row,$entries";

$order_row = connect_db()->query($sql);

$_date_text_1 = !empty($_date_start) ? $_date_start  : $_dt;
$_date_text_2 = !empty($_date_end) ? $_date_end  : '';


$QUERY_STRING_P = $_GET['p'];
$route = "?p=$QUERY_STRING_P";
$route  .= "&entries=$entries";
$route  .= !empty($_dt) ? "&dt=$_dt" : '';
$route  .= !empty($_date_start) && !empty($_date_end)
  ? "&date_start=$_date_start&date_end=$_date_end" : '';
$route  .= !empty($name) ? "&name=$name" : '';
$route .= !empty($status) ? "&status=$status" : '';
$route .= "&page=";

?>
<div class="bg-white container p-2">
  <p class="px-2 py-2 fw-bold bg-light border rounded">
    คำสั่งซื้อทั้งหมด
  </p>
  <?php require_once('./entries/order_list_entries.php') ?>
  <div class="table-responsive my-1">
    <table class="table table-hover">
      <thead class="table-light">
        <tr class="align-middle">
          <th scope="col" class="text-center" style="width:5% ;">#</th>
          <th scope="col" style="width:25% ;">รหัสคำสั่งซื้อ</th>
          <th scope="col" style="width:15% ;">วันที่สั่งซื้อ</th>
          <th class="text-center" scope="col" style="width:15% ;">การจ่ายเงิน</th>
          <th class="text-center" scope="col" style="width:15% ;">สถานะ</th>
          <th class="text-center" style="width: 5%;">คัดลอก</th>
          <th class="text-center" scope="col" style="width:10% ;">ดูข้อมูล</th>
          <th class="text-center" scope="col" style="width:10% ;">ใบเสร็จ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($ord = $order_row->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <tr class="align-middle">
            <td class="text-center">
              <?php echo $idx++ ?>
            </td>
            <td>
              <p class="m-0 fw-bold">
                <?php echo $ord['order_id'] ?>
              </p>
              <p class="m-0 text-secondary">
                <?php echo $ord['fname'] . ' ' . $ord['lname'] ?>
              </p>
            </td>
            <td><?php echo $ord['created'] ?></td>
            <td class="text-center ">
              <p class="rounded-1 fw-bold px-2 m-0  <?php echo set_text_pay_status($ord['pay_status'])  ?>">
                <?php echo order_pay_status($ord['pay_status']) ?>
              </p>

            </td>
            <td class="text-center">
              <p class="rounded-1 m-0 fw-bold px-2 <?php echo settext_order_status($ord['status'])  ?>">
                <?php echo get_order_status($ord['status']) ?>
              </p>

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
              <a target="_blank" href="./?p=order-list-detail&id=<?php echo $ord['order_id']  ?>" class="btn text-secondary btn-none">
                <i class="fa-regular fa-window-restore"></i>
              </a>
            </td>
            <td class="text-center">
              <a target="_blank" href="./order_receipt.php?id=<?php echo $ord['order_id']  ?>" class="btn text-secondary btn-none">
                <i class="fa-solid fa-receipt"></i>
              </a>
            </td>

          </tr>
        <?php }   ?>
      </tbody>
    </table>
  </div>
  <?php if ($order_row->rowCount() == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีรายการ</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/order_list_paginatin.php')  ?>
</div>
<script src="./script/entriesRow.js"></script>
<script src="./script/orderCopyID.js"></script>
<script src="./script/orderFunc.js"></script>
<script src="./js/order_list.js"></script>