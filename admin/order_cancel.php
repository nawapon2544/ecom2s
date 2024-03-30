<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_order_cancel_id();
$sql = "SELECT * FROM about_us WHERE row_id='$row_id'";
$row = connect_db()->query($sql);
$order_cancel_row = $row->fetch(PDO::FETCH_ASSOC);
$order_cancel = $row->rowCount() == 1 ? $order_cancel_row['data'] : '';
?>

<div class="container">
  <p class="bg-dark rounded  text-light px-3 py-2 my-1 fw-bold">
    การยกเลิกการสั่งซื้อสินค้า
  </p>
  <p class="form-text bg-light fw-bold my-1 border rounded  p-2">
    ป้อนวิธีการยกเลิกการสั่งซื้อสินค้าของร้านค้า บริษัท แบรนด์ ของเรา
  </p>
  <div class="my-2" id="form-state" data-val="<?php echo htmlspecialchars($order_cancel)  ?>">
    <textarea id="orderCancel" class="form-control"></textarea>
  </div>
  <button id="orderCancelSubmit" class="btn btn-success">
    บันทึก
  </button>
</div>
<script src="./js/order_cancel.js"></script>