<?php
require_once('../conn.php');
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;
$sql = "SELECT * FROM employee ORDER BY created ASC ";
$row_count_all = connect_db()->query($sql)->rowCount();
$page_all = ceil($row_count_all / $entries);
$query_row = $page * $entries;

$sql .= "LIMIT $query_row,$entries";
$row = connect_db()->query($sql);


$QUERY_STRING_P = $_GET['p'];
$route = "?p=$QUERY_STRING_P";
$route  .= "&entries=$entries";
$route .= "&page=";

$page_target = ceil($row_count_all / $entries);
if ($page + 1 > $page_target) {
  if ($page > 0) {
    $page--;
    $route .= $page;
    $route = "'./$route'";
    echo "<script>location.assign($route)</script>";
  }
}
?>
<div class="bg-white container p-2">
  <p class="px-2 py-2 fw-bold bg-light border rounded">
    <i class="fa-solid fa-gear"></i>
    จัดการผู้ดูแล และพนักงาน
  </p>
  <?php require_once('./entries/entries_row.php') ?>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr class="align-middle">
          <th class="text-center" style="width:5% ;" scope="col">#</th>
          <th scope="col" style="width:15% ;">ผู้ใช้งาน</th>
          <th scope="col" style="width:10% ;">รหัสผ่าน</th>
          <th scope="col" style="width:15% ;">ชื่อ</th>
          <th scope="col" style="width:10% ;">นามสกุล</th>
          <th scope="col" style="width:10% ;">ระดับการเข้าถึง</th>
          <th class="text-center" scope="col" style="width:5% ;">ลบ</th>
          <th class="text-center" scope="col" style="width:5% ;">แก้ไข</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($emp = $row->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr class="align-middle">
            <td class="text-center">
              <?php echo $idx++ ?>
            </td>
            <td>
              <?php echo $emp['username'] ?>
            </td>
            <td>
              <?php echo $emp['password'] ?>
            </td>
            <td>
              <?php echo $emp['fname'] ?>
            </td>
            <td>
              <?php echo $emp['lname'] ?>
            </td>
            <td>
              <?php echo $emp['private_role']  ?>
            </td>
            <td class="text-center">
              <button class="btn btn-light emp-delete" data-id="<?php echo $emp['employee_id']  ?>">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </td>
            <td class="text-center">
              <button class="btn btn-light emp-edit" data-id="<?php echo $emp['employee_id']  ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
            </td>
          </tr>
        <?php  } ?>
      </tbody>
    </table>
  </div>
  <?php require_once('./pagination/admin_manage_page.php') ?>
</div>
<script src="./script/get_params_script.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/admin_manage.js"></script>