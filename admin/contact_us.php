<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$data_id = ConfigABoutUsID::get_contact_id();
$sql = "SELECT * FROM `about_us` WHERE `row_id`='$data_id'";


$row = connect_db()->query($sql);
$about_us_row = $row->fetch(PDO::FETCH_ASSOC);
$data = $row->rowCount() == 1
  ? json_decode($about_us_row['data']) : [];
$brand = $row->rowCount() == 1 ? $data->brand : '';
$location = $row->rowCount() == 1 ? $data->location : '';
$sub_district = $row->rowCount() == 1 ? $data->sub_district : '';
$district = $row->rowCount() == 1 ? $data->district : '';
$province = $row->rowCount() == 1 ? $data->province : '';
$postcode = $row->rowCount() == 1 ? $data->postcode : '';
$business_hours = $row->rowCount() == 1 ? $data->business_hours : '';
$about_us = $row->rowCount() == 1 ? $data->about_us : '';
$email = $row->rowCount() == 1 ? $data->email : '';
$contact_phone = $row->rowCount() == 1 ? $data->contact_phone : '';

?>
<div class="container">
  <div class="my-2 row justify-content-center">
    <div class="p-3 rounded col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 border bg-white">
      <div class="my-2">
        <label class="form-label">
          ชื่อบริษัท
        </label>
        <div class="input-group">
          <span class="input-group-text bg-dark text-light">
          <i class="fa-solid fa-registered"></i>
          </span>
          <input type="text" value="<?php echo $brand  ?>" id="brand" class="form-control" placeholder="ป้อน ชื่อบริษัท ชื่อร้าน ชื่อแบรนด์" aria-label="Username" aria-describedby="basic-addon1">
        </div>
      </div>

      <div class="my-2">
        <label class="form-label">
          รายละเอียดที่ตั้ง
        </label>
        <textarea class="form-control" id="location" placeholder="ป้อน รายละเอียดที่ตั้ง อาคารที่ตั้ง บ้านเลขที่ หมู่บ้าน ซอย ถนน" name="" id="" cols="30" rows="10">
        <?php echo $location  ?>
        </textarea>

      </div>

      <div class="my-2">
        <label class="form-label">
          ตำบล
        </label>
        <input type="text" value="<?php echo $sub_district ?>" id="subDistrict" class="form-control border border-primary" placeholder="ป้อนชื่อตำบล">
      </div>


      <div class="my-2">
        <label class="form-label">
          อำเภอ
        </label>
        <input type="text" value="<?php echo $district  ?>" id="district" class="form-control" placeholder="ป้อนชื่ออำเภอ">
      </div>


      <div class="my-2">
        <label class="form-label">
          จังหวัด
        </label>
        <input type="text" value="<?php echo $province  ?>" id="province" class="form-control" placeholder="ป้อนชื่อจังหวัด">
      </div>


      <div class="my-2">
        <label class="form-label">
          รหัสไปรษณีย์
        </label>
        <div class="input-group">
          <span class="input-group-text bg-dark text-light">
            <i class="fa-solid fa-envelopes-bulk"></i>
          </span>
          <input type="text" value="<?php echo $postcode  ?>" id="postcode" class="form-control" placeholder="ป้อนรหัสไปรษณีย์">
        </div>

      </div>
      <div class="my-2">
        <label class="form-label">
          เวลาทำการ
        </label>
        <input type="text" value="<?php echo $business_hours ?>" id="businessHours" class="form-control" placeholder="ป้อนเวลาทำการ เช่น วันจันทร์ - วันอาทิตย์ เวลา 08.00 - 17.30">
      </div>

      <div class="my-2">
        <label class="form-label">
          เกี่ยวกับเรา
        </label>
        <textarea class="form-control" id="aboutUs" placeholder="ป้อนข้อมูล รายละเอียดที่เกี่ยวกับเรา" name="" id="" cols="30" rows="10">
        <?php echo $about_us  ?>
        </textarea>
      </div>

      <div class="my-2">
        <label class="form-label">
          อีเมล
        </label>
        <div class="input-group">
          <span class="input-group-text bg-dark text-light">
            <i class="fa-solid fa-at"></i>
          </span>
          <input type="text" value="<?php echo $email  ?>" id="email" class="form-control" placeholder="ป้อนอีเมล">
        </div>
      </div>
      <div class="my-2">
        <label class="form-label">
          เบอร์ติดต่อ
        </label>
        <div class="input-group">
          <span class="input-group-text bg-dark text-light">
            <i class="fa-solid fa-phone-volume"></i>
          </span>
          <input type="text" value="<?php echo $contact_phone ?>" id="contactPhone" class="form-control" placeholder="ป้อนเบอร์ติดต่อ">
        </div>

      </div>
      <button class="btn btn-success" id="contactUsSubmit">
        บันทึก
      </button>
    </div>
  </div>
</div>
<script src="./js/contact_us.js"></script>