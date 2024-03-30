<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5;
?>

<div class="bg-white container p-2">
  <p class="px-2 py-2 fw-bold bg-light border rounded">
    <i class="fa-solid fa-file-excel"></i>
    ไฟล์รายงาน (.xlsx)
  </p>
  <?php require_once('./entries/entries_row.php') ?>
  <table class="table table-hover">
    <thead class="table-light">
      <tr class="align-middle">
        <th class="text-center" scope="col">#</th>
        <th scope="col">ไฟล์</th>
        <th class="text-center" scope="col">ดาวน์โหลด</th>
        <th class="text-center" scope="col">ลบ</th>
        <th class="text-center" scope="col">เลือก</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $dir = "./xlsx";
      $idx = $page * $entries + 1;
      $end  = $entries * ($page + 1);
      $handle = opendir($dir);
      $files = glob($dir . '*.xlsx');
      $filecount =   0;

      if ($handle) {
        while (false !== ($entry = readdir($handle))) {
          if ($entry != "." && $entry != "..") {
            $filecount++;
            if ($filecount >= $idx) {
              if ($idx <= $end) { ?>
                <tr class="align-middle">
                  <td class="text-center">
                    <?php echo $idx++ ?>
                  </td>
                  <td>
                    <?php echo $entry ?>
                  </td>
                  <td class="text-center">
                    <a class="btn btn-success" href="./xlsx/<?php echo $entry ?>">
                      <i class="fa-solid fa-file-excel"></i>
                      <span>ดาวน์โหลด</span>
                    </a>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-light xlsx-file-delete" data-filename="<?php echo $entry ?>">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </td>
                  <td class="text-center">
                    <input class="form-check-input" name="xlsxfile" type="checkbox" value="<?php echo $entry ?>">
                  </td>
                </tr>
              <?php } ?>
            <?php      } ?>
          <?php    } ?>
        <?php   } ?>
        <?php closedir($handle); ?>
      <?php   }  ?>
    </tbody>
  </table>
  <?php if ($filecount == 0) { ?>
    <div class="alert alert-danger text-danger">
      <i class="fa-solid fa-circle-xmark"></i>
      <p class="m-0 text-danger fw-bold">ไม่มีไฟล์</p>
    </div>
  <?php } ?>
  <?php require_once('./pagination/xlsx_file_pagination.php') ?>
</div>
</div>

<div id="ord-prepare-bar" class="ord-bar">
  <button id="xlsx-file-delete-select" class="btn btn-light btn-hover m-1">
    <i class="fa-solid fa-trash-can"></i>
    ลบที่เลือก
  </button>
  <button id="xlsx-file-all" class="btn btn-hover btn-light m-1">
    <i class="fa-solid fa-check"></i>
    เลือกทั้งหมด
  </button>
</div>
<script src="./script/get_params_script.js"></script>
<script src="./script/entriesRow.js"></script>
<script src="./js/xlsx_file.js"></script>