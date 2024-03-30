<?php
require_once('../conn.php');
require_once('./lib/order_payStatus.php');
$order_id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE order_id='$order_id'";
$row = connect_db()->query($sql);
$order = $row->fetch(PDO::FETCH_ASSOC);
$address = json_decode($order['address']);
$product = json_decode($order['product']);

$total = 0;
?>


<div class="container">
  <section class="my-2 p-2 d-flex justity-content-center justify-content-end">
    <a target="_blank" href="./order_receipt.php?id=<?php echo $order_id ?>" class="btn btn-primary mx-1">
      ใบเสร็จ
    </a>
    <button class="btn btn-light mx-1" onclick="window.close()">
      ปิด
    </button>
  </section>
  <div id="order-detail">
    <p class="my-1 bg-dark p-2 text-light fw-bold border border-1 rounded">
      <span>หมายเลขคำสั่งซื้อ</span>
      <span><?php echo $order['order_id']  ?></span>
    </p>
  </div>

  <div class="p-2 bg-light">
    <div class="row justify-content-center">
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="my-2 bg-light border border-1 rounded">
          <p class="m-0 p-2 text-light bg-dark fw-bold rounded-top border border-dark">
            สถานะ
          </p>
          <div class="input-group my-2 p-2">
            <select disabled class="form-select form-select-sm" id="order-status" data-status="<?php echo $order['status'] ?>">
              <option value="" selected>สถานะ</option>
              <option value="cancel">ยกเลิก</option>
              <option value="prepare">จัดเตรียม</option>
              <option value="send">จัดส่ง</option>
              <option value="progress">ส่งแล้ว</option>
            </select>
            <button id="edit-order-status" class="input-group-text btn btn-light">
              แก้ไข
            </button>
          </div>
          <div class="d-flex justify-content-center my-2">
            <button id="confirm-edit-order-status" data-id="<?php echo $order['order_id'] ?>" class="d-none btn btn-primary">
              ตกลง
            </button>
            <button id="cancel-edit-order-status" class="d-none btn btn-light">
              ยกเลิก
            </button>
          </div>
        </div>

      </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="my-2 bg-light border border-1 rounded">
          <p class="m-0 p-2 bg-warning fw-bold rounded-top border border-warning">
            การจ่ายเงิน
          </p>
          <div class="input-group my-2 p-2">
            <select disabled class="form-select form-select-sm" id="payStatus" data-status="<?php echo $order['pay_status'] ?>">
              <option value="" selected>เลือก</option>
              <option value="progress">รอยืนยัน</option>
              <option value="unpaid">ไมจ่าย</option>
              <option value="paid">จ่ายแล้ว</option>
            </select>
            <button id="edit-paystatus" class="input-group-text btn btn-light">
              แก้ไข
            </button>
          </div>
          <div class="d-flex justify-content-center my-2">
            <button id="confirm-edit-paystatus" data-id="<?php echo $order['order_id'] ?>" class="d-none btn btn-primary">
              ตกลง
            </button>
            <button id="cancel-edit-paystatus" class="d-none btn btn-light">
              ยกเลิก
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="p-3 my-2 bg-light border border-1 rounded">
          <h5 class="m-0">ที่อยู่</h5>
          <div class="text-secondary">
            <p class="m-0">
              <?php echo $order['fname'] . ' ' . $order['lname'] ?>
            </p>
            <p class="m-0">
              <?php echo $order['phone'] ?>
            </p>
            <p class="m-0"><?php echo $address[0] ?></p>
            <p class="m-0"><?php echo str_ireplace(',', ' ', $address[1]) ?></p>
          </div>

        </div>
      </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <?php
        $delivery_number = !empty($order['delivery_number'])
          ? $order['delivery_number'] : 'ยังไม่มี';

        $delivery_service = !empty($order['delivery_service'])
          ? $order['delivery_service'] : 'ยังไม่มี';
        ?>
        <div class="border bg-light border-1 rounded my-2">
          <p class="p-2 m-0 bg-success text-light rounded-top">การขนส่ง</p>
          <div class="mx-2 p-2 border-bottom">
            <p class="m-0 fw-bold">จัดส่งโดย</p>
            <p class="text-secondary">
              <?php echo $delivery_service  ?>
            </p>
          </div>
          <div class="mx-1 p-2">
            <p class="m-0 fw-bold">หมายเลขขนส่ง</p>
            <p class="fw-bold text-danger">
              <?php echo $delivery_number  ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
      <p class="my-1 bg-light p-2 fw-bold border  border-1 rounded">
        รายละเอียดสินค้า
      </p>
      <div class="bg-white p-3 my-2">
        <?php foreach ($product as $p) { ?>
          <div class="border-1 border-bottom">
            <div class="row p-2 align-items-center">
              <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-4 col-xs-4">
                <div class="text-center">
                  <img style="height:3rem" src="../order-thum/<?php echo $p->thum  ?>">
                </div>
              </div>
              <div class="col-xxl-6 col-xl-6 col-lg-4 col-md-8 col-sm-8 col-xs-8">
                <h5 class="m-0 text-secondary text-center text-xxl-start text-xl-start text-lg-start text-md-start">
                  <?php echo $p->product_name ?>
                </h5>
              </div>
              <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-8 col-sm-8 col-xs-8">
                <div class="text-end p-2">
                  <span class="text-secondary">จำนวน</span>
                  <span class="text-danger fw-bold">
                    x<?php echo $p->quantity ?>
                  </span>
                </div>
              </div>
              <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-4">
                <div class="m-0 text-end p-3">
                  <?php
                  $prodcut_price = (float) $p->product_price;

                  $prodcut_real_price = (float)  $p->product_real_price;
                  $total += ($prodcut_real_price) * (int) $p->quantity;
                  ?>
                  <?php
                  if ($prodcut_real_price < $prodcut_price) { ?>
                    <span class="fw-bold product-price">
                      <span class="product-price-discount"></span>
                      <?php echo number_format($prodcut_price, 2)  ?>
                    </span>
                  <?php    }
                  ?>
                  <span class="fw-bold text-danger">
                    <?php echo number_format($prodcut_real_price, 2)  ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <p class="m-0 text-end p-1">
          <span>ค่าสินค้า</span>
          <strong class="text-danger">
            <?php echo number_format($total, 2)  ?>
          </strong>
        </p>
        <p class="m-0 text-end p-1">
          <span>ค่าขนส่ง</span>
          <strong class="text-danger">
            <?php echo number_format($order['delivery_cost'], 2)  ?>
          </strong>
        </p>
        <p class="m-0 text-end p-1">
          <span>รวมทั้งสิ้น</span>
          <strong class="text-danger"> <?php echo number_format($order['total'], 2)  ?></strong>
        </p>
      </div>
    </div>
  </div>
</div>
</div>
<script src="./js/order_list_detail.js"></script>