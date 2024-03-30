<?php
require_once('../conn.php');

$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;

$sql = "SELECT * FROM user ORDER BY modified DESC ";
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
  <i class="fa-solid fa-user-gear"></i>
    ผู้ใช้
  </p>
  <?php require_once('./entries/entries_row.php') ?>
  <table class="table">
    <thead class="table-secondary">
      <tr class="align-middle">
        <th class="text-center" style="width: 5%;" scope="col">#</th>
        <th style="width: 15%;" scope="col">ชื่อ - นามสกุล</th>
        <th style="width: 15%;" scope="col">ผู้ใช้งาน</th>
        <th style="width: 35%;" scope="col">รหัสผ่าน</th>
        <th style="width: 15%;" class="text-center" scope="col">ลบ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $idx = $page * $entries + 1;
      while ($user = $row->fetch(PDO::FETCH_ASSOC)) {  ?>
        <tr class="align-middle">
          <th class="text-center" scope="row"><?php echo $idx++  ?></th>
          <td>
            <?php echo  $user['fname'] . ' ' . $user['lname'] ?>
          </td>
          <td>
            <?php echo  $user['username'] ?>
          </td>
          <td>
            <div class="input-group my-1">
              <input type="password" disabled value="<?php echo $user['password'] ?>" class="form-control">
              <button class="input-group-text btn btn-light obscure-password" data-obscure="true" data-password="<?php echo base64_encode($password)  ?>">
                <i class="fa-solid fa-lock"></i>
              </button>
              <button class="input-group-text btn btn-light user-edit-pass">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
            </div>
            <button class="btn btn-light user-edit-confirm" data-id="<?php echo base64_encode($user['user_id']) ?>">
              ตกลง
            </button>
            <button class="btn btn-light user-edit-cancel">
              ยกเลิก
            </button>
          </td>
          <td class="text-center">
            <button class="btn btn-light user-delete" data-id="<?php echo $user['user_id'] ?>">
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php require_once('./pagination/user_pagination.php') ?>
</div>
</div>
<script src="./script/get_params_script.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/user.js"></script>