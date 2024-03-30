<?php
require_once('../conn.php');
$order_id = $_GET['order_id'];
$sql = "SELECT * FROM orders WHERE status='prepare' AND order_id='$order_id'";
$row = connect_db()->query($sql);
$order = $row->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>พิมพ์คำสั่งซื้อ (<?php echo $order_id ?>)</title>
  <?php require_once('./head.php') ?>
  <style>
    @media print {
      #order-print {
        display: none;
      }

      #close-window {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <table class="table">
      <tbody>

      </tbody>
    </table>

    <?php $product = json_decode($order['product']); ?>

    <h6>รายการสินค้า</h6>
    <table class="table align-middle">

      <?php $sum_total = 0; ?>

      <tr>
        <th class="border-0" scope="row">คำสั่งซื้อ</th>
        <td class="border-0"><?php echo $order['order_id'] ?></td>
      </tr>
      <tr>
        <th class="border-0">วันสั่งซื้อ</th>
        <td class="border-0"><?php echo $order['created'] ?></td>
      </tr>
      <?php foreach ($product as $p) {


        $total = (int)$p->quantity * (float)$p->product_real_price;
        $sum_total += $total;

      ?>

        <tr>
          <td style="width:15%">
            <img src="../order-thum/<?php echo  $p->thum ?>" style="height:3rem;">
          </td>
          <td>
            <?php echo  $p->product_name ?>
          </td>

          <td class="text-end">
            <?php echo  number_format($p->product_real_price, 2) ?>
          </td>
          <td>
            <?php echo  $p->quantity ?>
          </td>
          <td class="text-end text-danger">
            <?php echo  number_format($total, 2) ?>
          </td>
        </tr>

      <?php } ?>
      <tr class="border-0">
        <td colspan="4" class="text-end border-0">
          ค่าขนส่ง
        </td>
        <td class="text-end border-0"><?php echo $order['delivery_cost'] ?></td>
      </tr>
      <tr class="border-0">
        <td colspan="4" class="text-end border-0">
          รวมสินค้า
        </td>
        <td class="text-end border-0"><?php echo number_format($sum_total, 2) ?></td>
      </tr>
    </table>

    <div>
      <?php $address = json_decode($order['address']) ?>
      <h5>ที่อยู่ในการจัดส่ง</h5>
      <p class="m-0"><?php echo $order['fname'] . ' ' . $order['lname']   ?></p>
      <p class="m-0"><?php echo $address[0]   ?></p>
      <p class="m-0"><?php echo $address[1]   ?></p>
    </div>

    <button class="btn btn-primary" id="order-print">
      พิมพ์
    </button>
    <button class="btn btn-dark" id="close-window" onclick="window.close()">
      ปิด
    </button>
  </div>
  <script>
    window.addEventListener('load', orderPrinter)
    document.getElementById('order-print').addEventListener('click', orderPrinter)

    function orderPrinter() {
      window.print()
    }
  </script>
</body>

</html>