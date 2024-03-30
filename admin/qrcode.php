<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$qrcode_id = ConfigABoutUsID::get_qrcode_id();
$sql = "SELECT * FROM about_us WHERE row_id='$qrcode_id'";
$row = connect_db()->query($sql);
$qrcode_row = $row->fetch(PDO::FETCH_ASSOC);
$qrocde = $row->rowCount() == 1 ? $qrcode_row['data'] : '';
?>
<div class="container p-2">
  <div class="row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12">
      <div class="bg-white rounded">
        <h5 class="fw-bold bg-dark text-light px-2 py-1 rounded-top">
          เพิ่ม QR Code
        </h5>
        <div class="p-2">
          <div id="qrcode-wrapper" class="border my-2">
            <?php if (!empty($qrocde)) { ?>
              <img src="../logo/qrcode.jpg">
            <?php  } ?>
          </div>
          <label for="qrcode-upload" class="fw-bold label-file bg-light p-2 rounded">
            <i class="fa-solid fa-qrcode"></i>
            <span>เลือกรูปภาพ QR Code </span>
            <input type="file" class="d-none" id="qrcode-upload">
          </label>
          <div class="my-2 d-flex justify-content-center">
            <button id="qrcodeSubmit" class="btn btn-success">บันทึก</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/qrcode.js"></script>