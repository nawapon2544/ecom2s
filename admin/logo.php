<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_logo_id();
$sql = "SELECT * FROM about_us WHERE row_id='$row_id'";

$row = connect_db()->query($sql);
$row_count = $row->rowCount();
$logo_row = $row->fetch(PDO::FETCH_ASSOC);
$data = $row_count == 1 ? json_decode($logo_row['data']) : '';
$plattern = $row_count == 1 ? $data->plattern : '';
$val = $row_count == 1 ? $data->val  : '';


$img_plattern_check = $plattern == 'logoImg' ? 'checked' : '';
$text_active = $plattern == 'logoText' ? $val : '';
$text_plattern_check = $plattern == 'logoText' ? 'checked' : '';
$btn_edit_display = $row_count == 1 ? 'd-inline' : 'd-none';
$btn_submit_display = $row_count == 0 ? 'd-inline' : 'd-none';
$plattern_toggle = $row_count == 1 ? 'disabled' : '';
?>

<div class="container">
  <div class="p-2 row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
      <section class="bg-light border rounded-top">
        <p class="bg-dark text-light text-center rounded-top px-2 py-2 fw-bold">
          โลโก้ร้านค้า
        </p>
        <div class="p-2">
          <label class="fw-bold rounded p-2">
            เลือกรูปแบบโลโก้
          </label>
          <div class="p-2 bg-white border-2 d-flex border rounded">
            <div class="m-2">
              <input class="form-check-input" <?php echo $text_plattern_check ?> name="logo-plattern" type="radio" value="logoText" id="logoText" <?php echo  $plattern_toggle  ?>>
              <label class="form-check-label" for="logoText">
                ข้อความ
              </label>
            </div>
            <div class="m-2">
              <input class="form-check-input" <?php echo $img_plattern_check ?> name="logo-plattern" type="radio" value="logoImg" id="logoImg" <?php echo $plattern_toggle  ?>>
              <label class="form-check-label" for="logoImg">
                รูปภาพ
              </label>
            </div>
          </div>
          <div id="logo-img-section" class="my-3">
            <div class="input-group">
              <span class="input-group-text">
                <i class="fa-solid fa-registered"></i>
              </span>
              <input type="text" value="<?php echo $text_active ?>" id="text-logo-input" disabled class="form-control" placeholder="ป้อนชื่อโลโก้ร้านค้า">
            </div>
          </div>

          <label for="logo-img-upload" class="fw-bold border label-file bg-success text-light p-2 rounded ">
            <input type="file" class="d-none" id="logo-img-upload" disabled>
            <i class="fa-solid fa-mountain-sun"></i>
            <span>เลือกโลโก้</span>
          </label>
          <div class="logo-section">
            <?php if ($plattern == 'logoImg') { ?>
              <img src="../logo/<?php echo $val ?>">
            <?php    } ?>

            <?php if ($plattern == 'logoText') { ?>
              <i class="fa-solid fa-mountain-sun"></i>
            <?php     } ?>
          </div>
          <div class="p-2 bg-white border rounded my-2 d-flex justify-content-center">
            <button id="logoSubmit" class="m-1 btn btn-primary <?php echo $btn_submit_display ?>">
              บันทึก
            </button>
            <button id="logoEditCancel" class="m-1 btn btn-dark d-none">
              ยกเลิก
            </button>
            <button id="logoEdit" class="m-1 btn btn-dark <?php echo $btn_edit_display ?>">
              <i class="fa-solid fa-pen-to-square"></i>
              แก้ไข
            </button>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script src="./js/logo.js"></script>