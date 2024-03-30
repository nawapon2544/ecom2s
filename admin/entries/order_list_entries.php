<section class="row align-items-center my-1">
  <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="input-group my-1">
      <label class="input-group-text bg-none">
        แสดง
      </label>
      <select class="my-2 form-select form-select-sm" id="entriesRow">
        <option value="">รายการ</option>
        <?php for ($i = 5; $i <= 100; $i += 5) { ?>
          <?php
          $entries_selected = '';
          if ($i > 5) {
            $entries_selected = $i == $entries ? 'selected' : '';
          }

          if ($i >= 26 && $i <= 49) {
            continue;
          }
          if ($i >= 51 && $i <= 99) {
            continue;
          } ?>
          <option value="<?php echo $i  ?>" <?php echo $entries_selected  ?>>
            <?php echo $i  ?>
          </option>
        <?php  } ?>
      </select>
    </div>
  </div>
  <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <select class="form-select form-select-sm" id="order-status" data-status="<?php echo $status ?>">
      <option value="" selected>สถานะ</option>
      <option value="cancel">ยกเลิก</option>
      <option value="prepare">จัดเตรียม</option>
      <option value="send">จัดส่ง</option>
      <option value="progress">ส่งแล้ว</option>
    </select>
  </div>


  <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="my-1">
      <input id="orderTextId" value="<?php echo $order_id  ?>" class="form-control form-control-sm" type="text" placeholder="รหัสคำสั่งซื้อ">
    </div>
  </div>
  <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="my-1">
      <input id="orderTextName" value="<?php echo str_ireplace('-', ' ', $name) ?>" class="form-control form-control-sm" type="text" placeholder="ชื่อ นามสกุล">
    </div>
  </div>


  <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="my-1">
      <div class="form-floating">
        <input id="dateStart" value="<?php echo $_date_text_1  ?>" class="form-control form-control-sm" type="date">
        <label>Start</label>
      </div>
    </div>
  </div>
  <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="my-1">
      <div class="form-floating">
        <input id="dateEnd" value="<?php echo $_date_text_2  ?>" class="form-control form-control-sm" type="date">
        <label>End</label>
      </div>
    </div>
  </div>
  <div class="col">
    <button id="dateOrderInclude" class="btn btn-none my-1">
      <i class="fa-solid fa-magnifying-glass"></i>
      ค้นหา
    </button>
    <button id="defaultEntries" class="my-1 btn btn-none">
      ค่าเริ่่มต้น
    </button>
  </div>
</section>