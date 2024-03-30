<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$delivery_id = ConfigABoutUsID::get_delivery_id();
$sql = "SELECT * FROM about_us WHERE row_id='$delivery_id'";
$row = connect_db()->query($sql);
$delivery_row = $row->fetch(PDO::FETCH_ASSOC);
$delivery = $row->rowCount() == 1 ? $delivery_row['data'] : '';

?>

<div class="container">
  <p class="bg-dark rounded  text-light px-3 py-2 my-1 fw-bold">
    การจัดส่งสินค้า
  </p>
  <p class="form-text bg-light fw-bold my-1 border rounded  p-2">
    ป้อนวิธีการจัดส่งสินค้า ของร้าน แบรนด์ หรือ บริษัทของเรา
  </p>
  <div class="my-2" id="form-state" data-val="<?php echo  htmlspecialchars($delivery) ?>">
    <textarea id="delivery" class="form-control"></textarea>
  </div>

  <button id="deliverySubmit" class="btn btn-success">
    บันทึก
  </button>
</div>
<script src="./js/delivery.js"></script>