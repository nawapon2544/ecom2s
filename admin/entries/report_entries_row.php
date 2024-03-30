<?php
date_default_timezone_set("ASIA/BANGKOK");
$order_created_sql = "SELECT * FROM orders ORDER BY  created  LIMIT 0,1";
$order_created_row = connect_db()->query($order_created_sql);
$created  = date("Y-m-d");
if ($order_created_row->rowCount() > 0) {
  $order_created_start = $order_created_row->fetch(PDO::FETCH_ASSOC);

  $created = $order_created_start['created'];
}


$created_year = (int) date("Y", strtotime($created));
$ord_year_start = (int) $created_year;
$created_month = date("m", strtotime($created));

$today = date('Y-m-d H:i:s');
$year = date("Y", strtotime($today));
$ord_year_end = (int) $year
?>
<section class="row justify-content-center align-items-center my-3">
  <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="input-group my-1">
      <label class="input-group-text bg-none">
        แสดง
      </label>
      <select class="my-2 form-select form-select" id="entriesRow" data-entries="<?php echo $entries ?>">
        <option value="">รายการ</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">25</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="500">500</option>
        <option value="1000">1000</option>
        <option value="3000">3000</option>
        <option value="5000">5000</option>
      </select>
    </div>

  </div>
  <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <div class="input-group my-1">
      <label class="input-group-text bg-none">
        เลือก
      </label>
      <select class="form-select" data-year="<?php echo $get_year ?>" id="date-year">
        <option value="" selected>ปี</option>
        <?php for ($y = $ord_year_start; $y <= $ord_year_end; $y++) { ?>
          <option value="<?php echo $y ?>">
            <?php echo $y ?>
          </option>
        <?php }  ?>
      </select>
    </div>
  </div>
  <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <div class="input-group my-1">
      <label class="input-group-text bg-none">
        เลือก
      </label>
      <select class="form-select" data-month="<?php echo $get_month ?>" id="date-month">
        <option value="" selected>เดือน</option>
        <?php for ($m = 1; $m <= 12; $m++) { ?>
          <option value="<?php echo $m ?>">
            <?php echo get_full_month_thai($m) ?>
          </option>
        <?php }  ?>
      </select>
    </div>
  </div>


  <div class="col-auto">
    <button id="date-include" class="my-2 btn btn-none">
      <i class="fa-solid fa-magnifying-glass"></i>
      <span>ค้นหา</span>
    </button>
    <button id="date-include-reset" class="my-2 btn btn-none">
      รีเซ็ต
    </button>
    <button id="defaultEntries" class="my-2 btn btn-none">
      ค่าเริ่มต้น
    </button>
    <button id="toExcel" class="my-2 btn btn-none">
      <i class="fa-solid fa-file-excel"></i>
      บันทึก Excel
    </button>
    <button id="toPDF" class="my-2 btn btn-none">
      <i class="fa-solid fa-file-pdf"></i>
      ดาวน์โหลด PDF
    </button>
  </div>
</section>