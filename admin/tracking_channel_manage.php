<?php
require_once('../conn.php');
require_once('./lib/tracking_chanel_social.php');
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;

$sql = "SELECT * FROM tracking_chanel ORDER BY modified DESC ";
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
    <i class="fa-brands fa-twitter"></i>
    จัดการช่องทางการติดตาม
  </p>
  <?php require_once('./entries/entries_row.php') ?>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr class="align-middle">
          <th class="text-center" style="width:5% ;" scope="col">#</th>
          <th scope="col" style="width:15% ;">ช่องทาง</th>
          <th scope="col" style="width:20% ;">ชื่อแอคเคาท์</th>
          <th scope="col" style="width:15% ;">link</th>
          <th scope="col" style="width:15% ;">ค่าเริ่มต้น</th>
          <th class="text-center" scope="col" style="width:15% ;">เปิด - ปิด</th>
          <th class="text-center" scope="col" style="width:5% ;">ลบ</th>
          <th class="text-center" scope="col" style="width:5% ;">แก้ไข</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($tracking_chanel = $row->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr class="align-middle">
            <td class="text-center">
              <?php echo $idx++ ?> 
            </td>
            <td>
              <p class="fw-bold m-0">
                <?php echo set_text_social($tracking_chanel['social']) ?>
                <?php echo ucfirst($tracking_chanel['social']) ?>
              </p>
            </td>
            <td>
              <?php echo $tracking_chanel['account_name'] ?>
            </td>
            <td>
              <?php echo $tracking_chanel['social_link'] ?>
            </td>
            <td>
              <?php $set_default = $tracking_chanel['set_default'] == 'on' ? 'checked' : '' ?>
              <div class="form-switch">
                <input class="form-check-input tracking-set-default" data-social="<?php echo $tracking_chanel['social'] ?>" data-id="<?php echo $tracking_chanel['track_chanel_id']  ?>" <?php echo $set_default  ?> type="checkbox" role="switch">
              </div>
            </td>
            <td class="text-center">
              <?php $checked = $tracking_chanel['status'] == 'on' ? 'checked' : '' ?>
              <div class="form-switch">
                <input class="form-check-input tracking-switch" data-id="<?php echo $tracking_chanel['track_chanel_id']  ?>" <?php echo $checked  ?> type="checkbox" role="switch">
              </div>
            </td>
            <td class="text-center">
              <button class="btn text-dark tracking-delete" data-id="<?php echo $tracking_chanel['track_chanel_id']  ?>">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </td>
            <td class="text-center">
              <button class="btn text-dark tracking-edit" data-id="<?php echo $tracking_chanel['track_chanel_id']  ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
            </td>
          </tr>
        <?php  } ?>
      </tbody>
    </table>

  </div>
  <?php if ($row->rowCount() == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีรายการ</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/tracking_channel_manage_pagination.php') ?>
</div>
</div>
<script src="./script/entriesRow.js"></script>
<script src="./script/get_params_script.js"></script>
<script src="./js/tracking_channel_manage.js"></script>