<?php
require_once('../conn.php');
require_once('./lib/bath_format.php');
require_once('./lib/config_abouUs_id.php');
$order_id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE order_id='$order_id'";
$row = connect_db()->query($sql);
$order = $row->fetch(PDO::FETCH_ASSOC);
$address = json_decode($order['address']);
$product = json_decode($order['product']);

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ใบเสร็จ (<?php echo $order_id ?>)</title>
  <?php require_once('./head.php') ?>
  <link rel="stylesheet" href="./css/order_receipt.css">
</head>

<body class="container">
  <?php require_once('./printer_section.php') ?>
  <div>
    <div class="text-end my-3">
      <span class=" fw-bold p-2 bg-dark text-white rounded">
        ใบเสร็จ
      </span>
    </div>
    <div class="row justify-content-end">
      <div class="col-6">
        <p class="m-0">
          <strong>เลขที่ (No) : </strong>
          <span><?php echo $order_id ?></span>
        </p>
        <p class="m-0">
          <strong>วันที่ (Date) : </strong>
          <span><?php echo date("Y-m-d", strtotime($order['created'])) ?></span>
        </p>
        <p></p>
      </div>
    </div>
    <div class="border-top p-2">

      <div class="row">
        <div class="col-3">
          <strong>ลูกค้า | Customer</strong>
        </div>
        <div class="col-9">
          <p class="m-0">
            <?php echo $order['fname'] . ' ' . $order['lname'] ?>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <strong>ที่ิอยู่ | Address</strong>
        </div>
        <div class="col-9">
          <p class="m-0"><?php echo $address[0] ?></p>
          <p class="m-0"><?php echo str_ireplace(',', ' ', $address[1]) ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <strong>เลขผู้เสียภาษี | TaxID</strong>
        </div>
        <div class="col-9">
          <p class="m-0"></p>
        </div>
      </div>
    </div>

    <div class="border-top p-2">
      <?php
      $about_id = ConfigABoutUsID::get_contact_id();
      $sql = "SELECT * FROM about_us WHERE row_id='$about_id'";
      $about_row = connect_db()->query($sql);
      $about = $about_row->fetch(PDO::FETCH_ASSOC);
      $about_data = $row->rowCount() == 1
        ? json_decode($about['data']) : [];
      $brand = $about_row->rowCount() == 1 ? $about_data->brand : '';
      $location = $about_row->rowCount() == 1 ? $about_data->location : '';
      $sub_district = $about_row->rowCount() == 1 ? $about_data->sub_district : '';
      $district = $about_row->rowCount() == 1 ? $about_data->district : '';
      $province = $about_row->rowCount() == 1 ? $about_data->province : '';
      $postcode = $about_row->rowCount() == 1 ? $about_data->postcode : '';
      $business_hours = $about_row->rowCount() == 1 ? $about_data->business_hours : '';
      $about_us = $about_row->rowCount() == 1 ? $about_data->about_us : '';
      $email = $about_row->rowCount() == 1 ? $about_data->email : '';
      $contact_phone = $about_row->rowCount() == 1 ? $about_data->contact_phone : '';
      ?>
      <div class="row">
        <div class="col-3">
          <strong>ผู้ออก</strong>
        </div>
        <div class="col-9">
          <p class="m-0">
            <?php echo $brand ?>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <strong>ที่อยู่</strong>
        </div>
        <div class="col-9">
          <p class="m-0">
            <span class="m-0"><?php echo $location ?></span>
            <span class="m-0"><?php echo $sub_district ?></span>
            <span class="m-0"><?php echo $district ?></span>
            <span class="m-0"><?php echo $province ?></span>
            <span class="m-0"><?php echo $postcode ?></span>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <strong>โทร | Tel.</strong>
        </div>
        <div class="col-9">
          <p class="m-0">
            <?php echo $contact_phone  ?>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <strong>อีเมล</strong>
        </div>
        <div class="col-9">
          <p class="m-0">
            <?php echo $email  ?>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <strong>เลขผู้เสียภาษี | TaxID</strong>
        </div>
        <div class="col-9">
          <?php
          $_tax_id = ConfigABoutUsID::get_tax_id();
          $sql = "SELECT * FROM about_us WHERE row_id='$_tax_id' ";

          $tax =  connect_db()->query($sql);
          $tax_row = $tax->fetch(PDO::FETCH_ASSOC);
          $tax_id = $tax->rowCount() == 1 ? $tax_row['data'] : ''
          ?>
          <?php if (!empty($tax_id)) { ?>
            <p class="m-0"><?php echo $tax_id ?></p>
          <?php } ?>
        </div>
      </div>
    </div>
    <table class="table align-middle ">
      <thead class="table-dark">
        <tr class="text-center">
          <th scope="col">
            <span>ลำดับ</span>
            <p class="m-0">No.</p>
          </th>
          <th scope="col">
            <span>รายการ</span>
            <p class="m-0">Description</p>
          </th>
          <th scope="col">
            <span>ราคา | หน่วย</span>
            <p class="m-0">Unit Price</p>
          </th>
          <th scope="col">
            <span>จำนวน</span>
            <p class="m-0">Quantity</p>
          </th>
          <th scope="col">
            <span>จำนวนเงิน</span>
            <p class="m-0">Amount</p>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($product as $p) {  ?>
          <?php
          $prodcut_real_price = (float)  $p->product_real_price;
          $quantity = (int) $p->quantity;
          $sub_total = $prodcut_real_price * $quantity;
          $total += ($prodcut_real_price) * (int) $p->quantity;
          ?>
          <tr>
            <td scope="row" class="text-center">
              <?php echo $no++ ?>
            </td>
            <td>
              <img style="height:2rem" src="../order-thum/<?php echo $p->thum  ?>">
              <?php echo $p->product_name ?>
            </td>
            <td class="text-end">
              <?php echo number_format($prodcut_real_price, 2)  ?>
            </td>
            <td class="text-center"><?php echo $quantity  ?></td>
            <td class="text-end">
              <?php echo number_format($sub_total, 2)  ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="row p-3">
      <div class="col-7">
        <div class="row bg-dark text-light p-2 align-items-center">
          <div class="col-3">
            <span>จำนวนเงิน</span>
            <p class="m-0">Amount</p>
          </div>
          <div class="col-9">
            <p class="m-0"><?php echo ConvertToBathFormat($total)  ?> </p>
          </div>
        </div>
        <div class="my-2">
          <h5 class="m-0">การชำระเงิน (Conditions of Payments)</h5>
          <div class="d-flex">
            <div class="form-check me-1">
              <input class="form-check-input" type="checkbox" value="">
              <label class="form-check-label">
                <span>เงินสด</span>
                <p class="m-0">Cash</p>
              </label>
            </div>
            <div class="form-check mx-1">
              <input class="form-check-input" type="checkbox" checked>
              <label class="form-check-label">
                <span>เงินโอน</span>
                <p class="m-0">Bank Transfer</p>
              </label>
            </div>
            <div class="form-check mx-1">
              <input class="form-check-input" type="checkbox" value="">
              <label class="form-check-label">
                <span>เช็ค</span>
                <p class="m-0">Cheque</p>
              </label>
            </div>
            <div class="form-check ms-1">
              <input class="form-check-input" type="checkbox" value="">
              <label class="form-check-label">
                <span>อื่น ๆ</span>
                <p class="m-0">Other</p>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-5">
        <div class="bg-white p-2">
          <div class="row align-items-center">
            <div class="col-6">
              <h6 class="m-0 fw-bold">จำนวนเงิน</h6>
              <p class="m-0 text-secondary">SubTotal</p>
            </div>
            <div class="col-6">
              <h6 class="fw-bold m-0 text-end p-2">
                <?php echo number_format($total, 2)  ?>
              </h6>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-6">
              <h6 class="m-0 fw-bold">ค่าขนส่ง</h6>
              <p class="m-0 text-secondary">DeliveryCost</p>
            </div>
            <div class="col-6">
              <h6 class="fw-bold m-0 text-end p-2">
                <?php echo number_format($order['delivery_cost'], 2)  ?>
              </h6>
            </div>
          </div>
          <div class="row align-items-center h-100">
            <div class="col-6">
              <h6 class="m-0 fw-bold">รวมทั้งสิ้น</h6>
              <p class="m-0 text-secondary">Total</p>
            </div>
            <div class="col-6">
              <h6 class="p-2 fw-bold m-0 text-end">
                <?php echo number_format($order['total'], 2)  ?>
              </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./lib/Button.js"></script>
</body>
</html>