<?php
require_once('../conn.php');
$id = $_GET['id'];
$sql = "SELECT * FROM tracking_chanel  WHERE track_chanel_id='$id'";
$row = connect_db()->query($sql);
$tracking_chanel = $row->fetch(PDO::FETCH_ASSOC);
$social = $tracking_chanel['social'];
$account_name = $tracking_chanel['account_name'];
$social_link = $tracking_chanel['social_link'];
?>

<div class="container">

  <div class="row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
      <div class="bg-white">
        <p class="bg-dark text-light rounded-top px-4 py-2 my-1 fw-bold">
          <i class="fa-brands fa-twitter"></i>
          ช่องทางการติดตาม
        </p>
        <div class="p-2">
          <div id="tracking-social" data-tracking-social="<?php echo $social ?>">
            <div class="m-1">
              <input class="form-check-input" value="facebook" type="radio" name="social" id="facebook">
              <label class="form-check-label facebook" for="facebook">
                <i class="fa-brands fa-square-facebook"></i>
                Facebook
              </label>
            </div>
            <div class="m-1">
              <input class="form-check-input" value="instagram" type="radio" name="social" id="instagram">
              <label class="form-check-label instagram" for="instagram">
                <i class="fa-brands fa-square-instagram"></i>
                Instagram
              </label>
            </div>
            <div class="m-1">
              <input class="form-check-input" value="tiktok" type="radio" name="social" id="tiktok">
              <label class="form-check-label" for="tiktok">
                <i class="fa-brands fa-tiktok"></i>
                Tiktok
              </label>
            </div>
            <div class="m-1">
              <input class="form-check-input" value="youtube" type="radio" name="social" id="youtube">

              <label class="form-check-label youtube" for="youtube">
                <i class="fa-brands fa-youtube"></i>
                Youtube
              </label>
            </div>
            <div class="m-1">
              <input class="form-check-input" value="twitter" type="radio" name="social" id="twitter">

              <label class="form-check-label twitter" for="twitter">
                <i class="fa-brands fa-square-twitter"></i>
                Twitter
              </label>
            </div>
            <div class="m-1">
              <input class="form-check-input" value="line" type="radio" name="social" id="line">

              <label class="form-check-label line" for="line">
                <i class="bi bi-line"></i>
                Line
              </label>
            </div>
          </div>
          <div class="my-1">
            <label class="form-label">
              ชื่อแอคเคาท์
            </label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="fa-solid fa-plus"></i>
              </span>
              <input type="text" value="<?php echo $account_name ?>" id="social-account-name" class="form-control" placeholder="ป้อนชื่อแอคเคาท์">
            </div>
          </div>
          <div class="my-1">
            <label class="form-label">
              ลิงค์การเข้าถึง
            </label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="fa-solid fa-link"></i>
              </span>
              <input type="text" value="<?php echo $social_link ?>" id="social-link" class="form-control" placeholder="ป้อนลิงค์">
            </div>
          </div>
          <div class="text-center my-1">
            <button id="trackingChanelSubmit" class="btn btn-success" data-id="<?php echo $tracking_chanel['track_chanel_id']  ?>">
              บันทึก
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<script src="./js/tracking_channel_edit.js"></script>