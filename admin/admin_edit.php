<?php
require_once('../conn.php');
$emp_id = $_GET['id'];
$sql = "SELECT * FROM employee WHERE employee_id='$emp_id'";
$row = connect_db()->query($sql);
$emp = $row->fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12">
      <div class="my-2 bg-white rounded">
        <p class="p-2 rounded-top bg-dark text-light">เพิ่มผู้ดูแล</p>
        <div class="p-2">
          <div class="my-2">
            <label class="form-label">
              ชื่อผู้ใช้งาน
            </label>
            <input type="text" value="<?php echo $emp['username'] ?>" class="form-control" id="username" placeholder="ป้อนชื่อพนักงาน หรือ ชื่อผู้ใช้ในระบบ">
          </div>
          <div class="my-2">
            <label class="form-label">
              รหัสผ่าน
            </label>
            <input type="text" value="<?php echo $emp['password'] ?>" class="form-control" id="password" placeholder="ป้อนรหัสผ่าน">
          </div>
          <div class="my-2">
            <label class="form-label">
              ชื่อ
            </label>
            <input type="text" value="<?php echo $emp['fname'] ?>" class="form-control" id="fname" placeholder="ป้อนชื่อพนักงาน หรือ ชื่อผู้ใช้งาน">
          </div>
          <div class="my-2">
            <label class="form-label">
              นามสกุล
            </label>
            <input type="text" value="<?php echo $emp['lname'] ?>" class="form-control" id="lname" placeholder="ป้อนนามสกุลพนักงาน">
          </div>
          <div class="my-2" id="private-role" data-role="<?php echo $emp['private_role'] ?>">
            <label class="form-label">
              ระดับการเข้าถึง
            </label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="private-role" value="genaral" id="genaral">
              <label class="form-check-label" for="genaral">
                ทั่วไป
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="private-role" value="admin-role" id="admin-role">
              <label class="form-check-label" for="admin-role">
                ผู้ดูแล
              </label>
            </div>
          </div>
          <div class="my-2 d-flex justify-content-center">
            <button data-id="<?php echo $emp['employee_id'] ?>" id="employee-update" class="btn btn-success">บันทึก</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/admin_edit.js"></script>