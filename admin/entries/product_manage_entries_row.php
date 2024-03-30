<section class="row align-items-center my-3">
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
    <button id="defaultEntries" class="my-2 btn btn-none">
      ค่าเริ่่มต้น
    </button>
  </div>
  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="input-group my-2">
      <input type="text" value="<?php echo $product_id  ?>" id="orderTextId" class="form-control form-control-sm" placeholder="รหัสคำสั่งซื้อ">
    </div>
  </div>
 
</section>