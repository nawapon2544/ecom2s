<?php
require_once('./lib/config_abouUs_id.php');
require_once('./lib/get_date.php');
require_once('./lib/create_darshboard_func.php');
require_once('../function.php');

$y = isset($_GET['year']) ?
  set_full_month($_GET['year'])
  : set_full_month(get_this_year());
$m = isset($_GET['month']) ?
  set_full_month($_GET['month'])
  : set_full_month(get_this_month());
$today = get_date_now();



$sql  =  "SELECT * FROM orders";
$sql .= " WHERE created LIKE '%$y-$m%' AND pay_status='paid' AND status !='cancel' ";

$dashboard = new CreateDashboard($sql);
$month_text = get_full_month_thai((int)$m);

?>
<script src="./script/get_params_script.js"></script>
<div class="bg-white m-2" id="dashboard-page">
  <p class="px-2 py-2 fw-bold bg-light border rounded">
    Dashboard
  </p>
  <div class="container p-2">
    <div class="row">
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $new_order_sql = "SELECT * FROM orders WHERE pay_status='progress'";
        $new_order_count = connect_db()->query($new_order_sql)->rowCount();
        ?>
        <div class="dashboard-w bg-new">
          <h4 class="dashboard-bar">
            <span>New Order</span>
            <span class="label-bg">คำสั่งซื้อใหม่</span>
          </h4>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-new">
              <i class="fa-solid fa-newspaper"></i>
            </div>
            <h1><?php echo $new_order_count ?></h1>
          </div>
        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $order_prepare_sql = "SELECT * FROM orders WHERE status='prepare' AND pay_status='paid'";
        $order_prepare_count = connect_db()->query($order_prepare_sql)->rowCount();
        ?>
        <div class="dashboard-w bg-prepare">
          <h4 class="dashboard-bar">
            <span>Prepare</span>
            <span class="label-bg">ต้องจัดเตรียม</span>
          </h4>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-prepare">
              <i class="fa-solid fa-toolbox"></i>
            </div>
            <h1><?php echo $order_prepare_count ?></h1>
          </div>

        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $order_send_sql = "SELECT * FROM orders WHERE status='send' AND pay_status='paid'";
        $order_send_count = connect_db()->query($order_send_sql)->rowCount();
        ?>
        <div class="dashboard-w bg-send">
          <h4 class="dashboard-bar">
            <span>To Send</span>
            <span class="label-bg">ต้องจัดจัดส่ง</span>
          </h4>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-send">
              <i class="fa-solid fa-truck-fast"></i>
            </div>
            <h1><?php echo $order_send_count ?></h1>
          </div>

        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $order_progress_sql = "SELECT * FROM orders WHERE status='progress' AND pay_status='paid'";
        $order_progress_count = connect_db()->query($order_progress_sql)->rowCount();
        ?>
        <div class="dashboard-w bg-progress">
          <h5 class="dashboard-bar">
            Success
            <span class="label-bg">ส่งแล้ว</span>
          </h5>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-progress ">
              <i class="fa-regular fa-circle-check"></i>
            </div>
            <h1> <?php echo $order_progress_count ?> </h1>
          </div>

        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $order_cancel_sql = "SELECT * FROM orders WHERE status='cancel'";
        $order_cancel_count = connect_db()->query($order_cancel_sql)->rowCount();
        ?>
        <div class="dashboard-w bg-cancel">
          <h5 class="dashboard-bar">
            Cancel
            <span class="label-bg">ยกเลิก</span>
          </h5>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-cancel ">
              <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h1> <?php echo $order_cancel_count ?> </h1>
          </div>

        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $view_id = ConfigABoutUsID::get_view_id();
        $view_sql = "SELECT data FROM about_us WHERE row_id='$view_id'";
        $view_row = connect_db()->query($view_sql);
        $view_count = $view_row->rowCount() == 1 ?
          $view_row->fetch(PDO::FETCH_ASSOC)['data']
          : '';
        ?>
        <div class="dashboard-w bg-view">
          <h5 class="dashboard-bar">
            View
            <span class="label-bg">ยอดวิว</span>
          </h5>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-view ">
              <i class="fa-solid fa-chart-simple"></i>
            </div>
            <h1> <?php echo $view_count ?> </h1>
          </div>
        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $user_sql = "SELECT COUNT(user_id) as count FROM user";
        $user_count = connect_db()->query($user_sql)->fetch(PDO::FETCH_ASSOC)['count'];
        ?>
        <div class="dashboard-w bg-user">
          <h5 class="dashboard-bar">
            USER
            <span class="label-bg">สมาชิก</span>
          </h5>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-user ">
              <i class="fa-solid fa-user-group"></i>
            </div>
            <h1> <?php echo $user_count ?> </h1>
          </div>
        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $order_all_sql = "SELECT COUNT(order_id) as count FROM orders";
        $order_all_count = connect_db()->query($order_all_sql)->fetch(PDO::FETCH_ASSOC)['count'];
        ?>
        <div class="dashboard-w bg-orders">
          <h5 class="dashboard-bar">
            Orders
            <span class="label-bg">คำสั่งซื้อทั้งหมด</span>
          </h5>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-orders ">
              <i class="fa-solid fa-tag"></i>
            </div>
            <h1> <?php echo $order_all_count ?> </h1>
          </div>
        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $order_progress_sql = "SELECT * FROM orders WHERE status='progress'";
        $order_progress_count = connect_db()->query($order_progress_sql)->rowCount();
        ?>
        <div class="dashboard-w bg-admin">
          <h5 class="dashboard-bar">
            Admin
            <span class="label-bg">ผู้ดูแล</span>
          </h5>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-admin ">
              <i class="fa-solid fa-user-gear"></i>
            </div>
            <h1> <?php echo $order_prepare_count ?> </h1>
          </div>
        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $payment_sql = "SELECT COUNT(payment_id) as count FROM payment";
        $payment_count = connect_db()->query($payment_sql)->fetch(PDO::FETCH_ASSOC)['count'];
        ?>
        <div class="dashboard-w bg-payment">
          <h5 class="dashboard-bar">
            Payment
            <span class="label-bg">ช่องทางการชำระเงิน</span>
          </h5>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-payment ">
              <i class="fa-brands fa-paypal"></i>
            </div>
            <h1> <?php echo $payment_count ?> </h1>
          </div>
        </div>
      </div>
      <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <?php
        $track_sql = "SELECT COUNT(track_chanel_id) as count FROM tracking_chanel";
        $track_count = connect_db()->query($track_sql)->fetch(PDO::FETCH_ASSOC)['count'];
        ?>
        <div class="dashboard-w bg-tracking">
          <h5 class="dashboard-bar">
            Tracking
            <span class="label-bg">ช่องทางการติดตาม</span>
          </h5>
          <div class="dashboard-text-count">
            <div class="dashboard-text-count-icon text-tracking ">
              <i class="fa-brands fa-twitter"></i>
            </div>
            <h1> <?php echo $track_count ?> </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="my-2">
      <p class="fw-bold text-light bg-dark d-inline px-2 rounded">
        สมาชิกล่าสุด
      </p>
      <?php
      $user_table_sql = "SELECT * FROM user ORDER BY created LIMIT 0,5";
      $user_table_result = connect_db()->query($user_table_sql);
      ?>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Username</th>
              <th scope="col">name</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user_table = $user_table_result->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td><?php echo $user_table['username'] ?></td>
                <td><?php echo $user_table['fname'] . ' ' . $user_table['lname'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="my-2 row justify-content-center">
      <?php
      $start_order_sql = "SELECT created FROM orders ORDER BY created LIMIT 0,1";
      $start_order_result = connect_db()->query($start_order_sql);
      $start_order_row = $start_order_result->fetch(PDO::FETCH_ASSOC);
      $start_order = $start_order_result->rowCount() == 1
        ? $start_order_row['created'] : '';

      $start_order_year = $start_order == ''
        ? date('Y', strtotime($today))
        : date('Y', strtotime($start_order));
      $last_year = date('Y');
      ?>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <select class="form-select" id="order-year" data-year="<?php echo $y ?>">
          <option value="" selected>ปี</option>
          <?php for ($_y = $start_order_year; $_y <= $last_year; $_y++) { ?>
            <option value="<?php echo $_y ?>">
              <?php echo $_y ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <select class="form-select" id="order-month" data-month="<?php echo (int)$m ?>">
          <option value="" selected>เดืิอน</option>
          <?php for ($_month = 1; $_month <= 12; $_month++) { ?>
            <option value="<?php echo $_month  ?>">
              <?php echo get_full_month_thai($_month)  ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <button id="date-filter" class="btn btn-dark">
          Filter
        </button>
        <button onclick="location.assign(get_page_url_queryParams())" class="btn btn-dark">
          Reset
        </button>
      </div>
    </div>
    <div class="row">
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="dashboard-w bg-today">
          <h5 class="p-2 dashboard-bar text-white">
            <span>Today</span>
            <span class="badge  bg-dark">รายได้วันนี้</span>
          </h5>
          <h2 class="dashboard-count justify-content-end text-white">
            <div class="dashboard-count-icon">
              <i class="fa-solid fa-chart-line"></i>
            </div>

            <?php
            $_d = date('d', strtotime($today));
            $_m = date('m', strtotime($today));
            $_y = date('Y', strtotime($today));
            $today_total_sql = "SELECT total FROM orders WHERE pay_status='paid' AND ";
            $today_total_sql .= "status !='cancel' AND created LIKE '%$_y-$_m-$_d%' ";
            echo number_format(CreateDashboard::order_total($today_total_sql), 2)
            ?>
          </h2>
        </div>
      </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="dashboard-w bg-month">
          <h5 class="p-2 dashboard-bar text-white">
            <span>Month</span>
            <span class="badge bg-dark">
              รายได้เดือน (<?php echo  $month_text ?>)
            </span>
          </h5>
          <h2 class="dashboard-count justify-content-end text-white">
            <div class="dashboard-count-icon">
              <i class="fa-solid fa-chart-line"></i>
            </div>
            <?php
            echo number_format(CreateDashboard::order_total($sql), 2)
            ?>
          </h2>
        </div>
      </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="dashboard-w bg-year">
          <h5 class="p-2 dashboard-bar text-white">
            <span>Year</span>
            <span class="badge bg-dark">รายได้ปี (<?php echo $y ?>) </span>
          </h5>
          <h2 class="dashboard-count justify-content-end text-white">
            <div class="dashboard-count-icon">
              <i class="fa-solid fa-chart-line"></i>
            </div>
            <?php
            $year_total_sql = "SELECT total FROM orders WHERE status!='cancel' ";
            $year_total_sql .= "AND pay_status='paid' AND created LIKE '%$y-%' ";
            echo number_format(CreateDashboard::order_total($year_total_sql), 2);
            ?>
          </h2>
        </div>
      </div>
    </div>
    <div class="row justity-content-center">
      <?php
      $product_total_list =  $dashboard->product_total_list();
      $page_list = 5;
      $count_product_total_list = count($product_total_list['subject']);
      $page_list_all = ceil($count_product_total_list / $page_list);
      ?>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
        <canvas id="productList" data-obj="<?php echo base64_encode(json_encode($product_total_list)) ?>" data-total="<?php echo $product_total ?>">
        </canvas>
      </div>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12">
        <?php for ($p = 0; $p < $page_list_all; $p++) {
          $table_display = $p == 0 ? '' : 'd-none';
        ?>
          <div class="table-responsive">
            <table class="table table-bordered total-table <?php echo $table_display ?>" id="product-total-table-<?php echo $p ?>">
              <thead class="table-secondary">
                <tr>
                  <th class="text-center" scope="col">ลำดับ</th>
                  <th scope="col">สินค้า</th>
                  <th class="text-center" scope="col">จำนวน</th>
                  <th class="text-end" scope="col">ยอด</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = $p * $page_list; $i < ($p + 1) * $page_list; $i++) { ?>
                  <?php if ($i <  $count_product_total_list) { ?>
                    <tr>
                      <td class="text-center">
                        <?php echo  $i + 1  ?>
                      </td>
                      <td>
                        <?php echo  $product_total_list['subject'][$i]  ?>
                      </td>
                      <td class="text-center">
                        <?php echo  $product_total_list['quantity'][$i]  ?>
                      </td>
                      <td class="text-end">
                        <?php echo  number_format($product_total_list['total'][$i], 2)  ?>
                      </td>
                    </tr>
                  <?php } ?>
                <?php  } ?>
              </tbody>
            </table>
          </div>
        <?php  } ?>
        <nav>
          <ul class="pagination flex-wrap">
            <?php for ($p = 0; $p < $page_list_all; $p++) {
              $page_active = $p == 0 ? 'active' : '';
            ?>
              <li class="page-item m-1 <?php echo $page_active ?>">
                <button class="page-link to-product-total-table" data-target="product-total-table-<?php echo $p ?>">
                  <?php echo $p + 1 ?>
                </button>
              </li>
            <?php  } ?>
          </ul>
        </nav>
      </div>
    </div>
    <div class="my-2 row justify-content-center">
      <?php
      $p_type_total =  $dashboard->producttype_total_list();
      $p_type_entries = 5;
      $count_p_type_total = count($p_type_total['subject']);
      $p_type_page_all = ceil($count_p_type_total / $p_type_entries);
      ?>
      <div class="col-12 col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
        <canvas id="productTypeTotal" data-obj="<?php echo base64_encode(json_encode($p_type_total)) ?>">
        </canvas>
      </div>
      <div class="col-12 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="table-responsive">
          <?php for ($p = 0; $p < $p_type_page_all; $p++) {
            $table_display = $p == 0 ? '' : 'd-none';
          ?>
            <table class="table table-bordered product-type-table <?php echo $table_display ?>" id="product-type-table-<?php echo $p ?>">
              <thead class="table-secondary">
                <tr>
                  <th scope="col">ประเภทสินค้า</th>
                  <th class="text-center" scope="col">จำนวน</th>
                  <th class="text-end" scope="col">ยอด</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = $p * $p_type_entries; $i < ($p + 1) * $p_type_entries; $i++) { ?>
                  <?php if ($i <  $count_p_type_total) { ?>
                    <tr>
                      <td>
                        <?php echo  $p_type_total['subject'][$i]  ?>
                      </td>
                      <td class="text-center">
                        <?php echo  $p_type_total['quantity'][$i]  ?>
                      </td>
                      <td class="text-end">
                        <?php echo  number_format($p_type_total['total'][$i], 2)  ?>
                      </td>
                    </tr>
                  <?php  } ?>
                <?php  } ?>
              </tbody>
            </table>
          <?php  } ?>
        </div>
        <nav>
          <ul class="pagination flex-wrap">
            <?php for ($p = 0; $p < $p_type_page_all; $p++) {
              $page_active = $p == 0 ? 'active' : '';
            ?>
              <li class="page-item m-1 <?php echo $page_active ?>">
                <button class="page-link to-product-type-table" data-target="product-type-table-<?php echo $p ?>">
                  <?php echo $p + 1 ?>
                </button>
              </li>
            <?php  } ?>
          </ul>
        </nav>
      </div>
    </div>
    <div class="my-2 row justify-content-center">
      <?php
      $p_cty_total =  $dashboard->productcategory_total_list();
      $p_cty_entries = 5;
      $count_p_cty_total = count($p_cty_total['subject']);
      $p_cty_page_all = ceil($count_p_cty_total / $p_cty_entries);
      ?>
      <div class="col-12 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="table-responsive">
          <?php for ($p = 0; $p < $p_cty_page_all; $p++) {
            $table_display = $p == 0 ? '' : 'd-none';
          ?>
            <table class="table table-bordered  product-category-table <?php echo $table_display ?>" id="product-category-table-<?php echo $p; ?>">
              <thead class="table-secondary">
                <tr>
                  <th scope="col">หมวดหมู่สินค้า</th>
                  <th class="text-center" scope="col">จำนวน</th>
                  <th class="text-end" scope="col">ยอด</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = $p * $p_cty_entries; $i < ($p + 1) * $p_cty_entries; $i++) { ?>
                  <?php if ($i <  $count_p_cty_total) { ?>
                    <tr>
                      <td>
                        <?php echo  $p_cty_total['subject'][$i]  ?>
                      </td>
                      <td class="text-center">
                        <?php echo  $p_cty_total['quantity'][$i]  ?>
                      </td>
                      <td class="text-end">
                        <?php echo  number_format($p_cty_total['total'][$i], 2)  ?>
                      </td>
                    </tr>
                  <?php  } ?>
                <?php  } ?>
              </tbody>
            </table>
          <?php  } ?>
        </div>
        <nav>
          <ul class="pagination flex-wrap">
            <?php for ($p = 0; $p < $p_cty_page_all; $p++) {
              $page_active = $p == 0 ? 'active' : '';
            ?>
              <li class="page-item m-1 <?php echo $page_active ?>">
                <button class="page-link to-product-category-table" data-target="product-category-table-<?php echo $p ?>">
                  <?php echo $p + 1 ?>
                </button>
              </li>
            <?php  } ?>
          </ul>
        </nav>
        <script>
          function productCategoryTable() {
            return $('.product-category-table')
          }

          function toProductCategoryTable() {
            return $('.to-product-category-table')
          }
          toProductCategoryTable().click(function() {
            const target = $(this).attr('data-target')

            $.each(toProductCategoryTable(), (index, btn) => {
              if ($(btn).attr('data-target') == target) {
                $(btn).parent().addClass('active')
              } else {
                $(btn).parent().removeClass('active')
              }
            })
            $.each(productCategoryTable(), (index, table) => {
              const id = $(table).attr('id')
              if (target == id) {
                $(table).removeClass('d-none')
              } else {
                $(table).addClass('d-none')
              }
            })
          })
        </script>
      </div>
      <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <canvas id="productCategory" data-obj="<?php echo base64_encode(json_encode($p_cty_total)) ?>">
        </canvas>
      </div>
      <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12">
        <canvas id="productCategoryQty">
        </canvas>
      </div>
    </div>
  </div>
</div>
<script src="./script/stringTotArray.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./js/dashboard.js"></script>