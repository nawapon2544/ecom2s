<?php if (empty($order_id)) { ?>
  <?php if ($row->rowCount() > 0) { ?>
    <section class="my-1 d-flex">
      <p class="my-0 mx-1">
        <span>รายการ</span>
        <strong class="text-primary">
          <?php echo ($page * $entries) + 1 ?>
        </strong>
        <span>-</span>
        <strong class="text-primary">
          <?php echo $idx - 1 ?>
        </strong>
      </p>
      <p class="my-0 mx-1">
        <span>จาก</span>
        <strong class="text-danger">
          <?php echo $row_count_all ?>
        </strong>
      </p>
    </section>
    <section class="my-1 d-flex">
      <p class="my-0 mx-1">
        <span>หน้า</span>
        <strong><?php echo $page + 1 ?></strong>
      </p>
      <p class="my-0 mx-1">
        <span>จาก</span>
        <strong><?php echo $page_all ?></strong>
      </p>
    </section>
    <?php
    $first_active = $page == 0 ? 'disabled' : '';
    $last_active = $page == $page_all - 1 ? 'disabled' : ''
    ?>
    <nav class="d-flex justify-content-end m-0">
      <ul class="pagination pagination-sm">
        <li class="page-item <?php echo $first_active  ?>">
          <a class="page-link" href="./<?php echo $route . 0 ?>">
            หน้าแรก
          </a>
        </li>
        <li class="page-item <?php echo $last_active  ?>">
          <a class="page-link" href="./<?php echo $route . $page_all - 1 ?>">
            หน้าสุดท้าย
          </a>
        </li>
      </ul>
    </nav>

    <nav class="d-flex justify-content-end">
      <ul class="pagination pagination-sm">
        <?php if ($page >= 1) {
          $prefix = $page - 1
        ?>
          <li class="page-item">
            <a class="page-link" href="./<?php echo $route . $prefix ?>">
              <i class="fa-solid fa-angle-left"></i>
            </a>
          </li>
        <?php   }  ?>
        <?php
        if ($page_all <= 5) { ?>
          <?php
          for ($i = 0; $i < $page_all; $i++) {
            $page_active = $i == $page ? 'active' : '';
          ?>
            <li class="page-item <?php echo $page_active  ?>">
              <a class="page-link" href="./<?php echo $route . $i ?>">
                <?php echo $i + 1 ?>
              </a>
            </li>
          <?php }  ?>
        <?php  } ?>
        <?php
        if ($page_all > 5) { ?>
          <?php for ($i = $page - 2; $i <= $page; $i++) {
            $page_active = $i == $page ? 'active' : '';
            if ($i >= 0) { ?>
              <li class="page-item <?php echo $page_active  ?>">
                <a class="page-link" href="./<?php echo $route . $i ?>">
                  <?php echo $i + 1  ?>
                </a>
              </li>
            <?php }  ?>
          <?php      }  ?>
          <?php for ($i = $page + 1; $i <= $page + 2; $i++) {
            $page_active = $i == $page ? 'active' : '';
            if ($i < $page_all) { ?>
              <li class="page-item <?php echo $page_active  ?>">
                <a class="page-link" href="./<?php echo $route . $i ?>">
                  <?php echo $i + 1  ?>
                </a>
              </li>
            <?php  }
            ?>
          <?php      }  ?>
        <?php }  ?>
        <?php if ($page < $page_all - 1) {
          $sufix = $page + 1
        ?>
          <li class="page-item">
            <a class="page-link" href="./<?php echo $route . $sufix ?>">
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </li>
        <?php   }  ?>
      </ul>
    </nav>

  <?php } ?>
<?php  } ?>