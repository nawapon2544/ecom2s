<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$product_id = isset($_GET['id']) ? $_GET['id'] : '';
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;

$sql = "SELECT * FROM products ";

$sql .= !empty($product_id) ? " WHERE product_id='$product_id'" : '';
$sql .=  " ORDER BY modified DESC ";
$row_count_all = connect_db()->query($sql)->rowCount();
$page_all = ceil($row_count_all / $entries);
$query_row = $page * $entries;
$sql .= "LIMIT $query_row,$entries";

$product_list = connect_db()->query($sql);

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
    <i class="fa-brands fa-shopify"></i>
    จัดการสินค้า
  </p>
  <?php require_once('./entries/product_manage_entries_row.php') ?>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr class="align-middle">
          <th style="width: 5%;" scope="col">รายการ</th>
          <th class="col-img" scope="col">รูปภาพ</th>
          <th style="width: 40%;" scope="col">ชื่อสินค้า</th>
          <th style="width: 10%;" class="text-center" scope="col">คงเหลือ</th>
          <th style="width: 20%;" scope="col">วันที่เพิ่ม</th>
          <th style="width: 5%;" class="text-center" scope="col">แก้ไข</th>
          <th style="width: 5%;" class="text-center" scope="col">ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $idx = $page * $entries + 1;
        while ($product_items = $product_list->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr class="align-middle">
            <th><?php echo $idx++  ?></th>
            <td>
              <img src="../product-img/<?php echo explode(',', $product_items['img'])[0] ?>" class="table-img">
            </td>
            <td>
              <p class="m-0 text-secondary">
                <?php echo $product_items['product_id']  ?>
              </p>
              <p class="m-0  fw-bold">
                <?php echo $product_items['product_name']  ?>
              </p>
            </td>
            <td class="text-center">
              <?php echo $product_items['product_remain']  ?>
            </td>
            <td><?php echo $product_items['created']  ?></td>
            <td class="text-center">
              <a class="fw-bold text-dark" href="./?p=product-edit&id=<?php echo $product_items['product_id']  ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
            </td>
            <td class="text-center">
              <button class="btn btn-light product-delete" data-productId="<?php echo $product_items['product_id'] ?>" data-img="<?php echo $product_items['img']  ?>">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </td>
          </tr>
        <?php     } ?>
      </tbody>
    </table>
  </div>
  <?php if ($product_list->rowCount() == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีรายการ</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/product_manage_pagination.php') ?>
</div>
</div>
<script src="./script/get_params_script.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/product_manage.js"></script>