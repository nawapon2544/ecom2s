<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$icon_id = ConfigABoutUsID::get_icon_id();
$sql = "SELECT * FROM about_us WHERE row_id='$icon_id'";
$row = connect_db()->query($sql);
$icon_row = $row->fetch(PDO::FETCH_ASSOC);
$icon = $row->rowCount() == 1 ? $icon_row['data'] : '';
?>

<div class="container">
  <div class="my-3 row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
      <div class="bg-light border rounded">
        <h5 class="bg-dark p-2 text-light rounded-top">เปลี่ยนไอคอน Icon</h5>
        <div class="my-2 p-2">
          <div>
            <label for="icon-upload" class="fw-bold bg-success text-light p-2 label-file rounded">
              <i class="fa-brands fa-nfc-symbol"></i>
              <input type="file" id="icon-upload" class="d-none">
              <span>เลือกไอคอน</span>
            </label>
          </div>
          <section id="icon-section" class="d-flex justify-content-center">
            <?php if (!empty($icon)) { ?>
              <img src="../logo/<?php echo $icon ?>">
            <?php } ?>
          </section>
          <div class="d-flex justify-content-center">
            <button id="iconSubmit" class="btn btn-dark">
              บันทึก
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/icon.js"></script>