<?php
require_once('../conn.php');
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;
$sql = "SELECT * FROM slide ORDER BY modified DESC ";

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
    <i class="fa-solid fa-mountain-sun"></i>
    ภาพสไลด์
  </p>
  <button id="open-slide-modal" class="btn btn-success">
    <i class="fa-solid fa-plus"></i>
    <span>เพิ่มภาพสไลด์</span>
  </button>
  <?php require_once('./entries/entries_row.php') ?>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-secondary">
        <tr class="align-middle">
          <th class="text-center" style="width:5% ;" scope="col">#</th>
          <th class="text-center col-img" scope="col">ภาพ</th>
          <th scope="col" style="width:15% ;">วันที่เพิ่ม</th>
          <th style="width:45% ;" scope="col">ข้อความ</th>
          <th class="text-center" style="width:5% ;" scope="col">ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($slide = $row->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr class="align-middle">
            <td class="text-center">
              <?php echo $idx++ ?>
            </td>
            <td class="text-center">
              <img src="../picture-slide/<?php echo $slide['img'] ?>" style="height:3rem;">
            </td>
            <td>
              <?php echo $slide['created'] ?>
            </td>
            <td class="text-secondary">
              <?php echo $slide['descript'] == ''
                ? 'ไม่มีคำอธิบาย' : $slide['descript']
              ?>
            </td>
            <td class="text-center">
              <button class="btn text-dark slide-delete" data-img="<?php echo $slide['img'] ?>" data-id="<?php echo $slide['slide_id'] ?>">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </td>
          </tr>
        <?php    }  ?>
      </tbody>
    </table>
  </div>
  <?php if ($row->rowCount() == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีรายการ</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/slide_pagination.php') ?>
</div>

</div>

<?php require_once('./slide_modal.php') ?>
<script src="./script/get_params_script.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/slide.js"></script>