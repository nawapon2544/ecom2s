<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');

$term_id = ConfigABoutUsID::get_terms_id();
$waranty_id = ConfigABoutUsID::get_warranty_policy_id();
$delivery_id = ConfigABoutUsID::get_delivery_id();
$refund_product_id = ConfigABoutUsID::get_refund_product_id();
$refundd_money_id = ConfigABoutUsID::get_refund_money_id();
$order_cancel_id = ConfigABoutUsID::get_order_cancel_id();
$sql = "SELECT * FROM about_us";
$row = connect_db()->query($sql);
?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
      <div class="bg-light border rounded my-2">
        <h5 class="bg-dark text-light fw-bold p-2 rounded-top">
          ตั้งค่าการเปิด - ปิด สถานะการแสดงผลเกี่ยวกับ
        </h5>
        <div class="p-2">
          <?php while ($about_us = $row->fetch(PDO::FETCH_ASSOC)) { ?>
            <?php $checked = $about_us['status'] == 'on' ? 'checked' : '' ?>
            <?php if ($about_us['row_id'] == $term_id) { ?>
              <div class="my-2 bg-white border p-2 rounded">
                <div class="form-switch">
                  <input class="form-check-input" <?php echo $checked  ?> value="<?php echo $term_id ?>" onchange="switchDisplay(event)" type="checkbox" id="terms-conditions">
                  <label class="form-check-label" for="terms-conditions">
                    ข้อกำหนดและเงื่อนไข
                  </label>
                </div>
              </div>
            <?php } ?>
            <?php if ($about_us['row_id'] == $waranty_id) { ?>
              <div class="my-2 bg-white border p-2 rounded">
                <div class="form-switch">
                  <input class="form-check-input" <?php echo $checked  ?> value="<?php echo $waranty_id ?>" onchange="switchDisplay(event)" type="checkbox" id="warranty-policy">
                  <label class="form-check-label" for="warranty-policy">
                    นโยบายการรับประกันสินค้า
                  </label>
                </div>
              </div>
            <?php } ?>
            <?php if ($about_us['row_id'] == $delivery_id) { ?>
              <div class="my-2 bg-white border p-2 rounded">
                <div class="form-switch">
                  <input class="form-check-input" <?php echo $checked  ?> value="<?php echo $delivery_id ?>" onchange="switchDisplay(event)" type="checkbox" id="delivery">
                  <label class="form-check-label" for="delivery">
                    การจัดส่งสินค้า
                  </label>
                </div>
              </div>
            <?php } ?>
            <?php if ($about_us['row_id'] == $refund_product_id) { ?>
              <div class="my-2 bg-white border p-2 rounded">
                <div class="form-switch">
                  <input class="form-check-input" <?php echo $checked  ?> value="<?php echo $refund_product_id ?>" onchange="switchDisplay(event)" type="checkbox" id="refund-product">
                  <label class="form-check-label" for="refund-product">
                    การคืนสินค้า
                  </label>
                </div>
              </div>
            <?php } ?>
            <?php if ($about_us['row_id'] == $refundd_money_id) { ?>
              <div class="my-2  bg-white border p-2 rounded">
                <div class="form-switch">
                  <input class="form-check-input" <?php echo $checked  ?> value="<?php echo $refundd_money_id ?>" onchange="switchDisplay(event)" type="checkbox" id="refund-meney">
                  <label class="form-check-label" for="refund-meney">
                    การคืนเงิน
                  </label>
                </div>
              </div>
            <?php } ?>
            <?php if ($about_us['row_id'] == $order_cancel_id) { ?>
              <div class="my-2 bg-white border p-2 rounded">
                <div class="form-switch">
                  <input class="form-check-input" <?php echo $checked  ?> value="<?php echo $order_cancel_id ?>" onchange="switchDisplay(event)" type="checkbox" id="cancel-order">
                  <label class="form-check-label" for="cancel-order">
                    การยกเลิกการสั่งซื้อสินค้า
                  </label>
                </div>
              </div>
            <?php } ?>
          <?php   } ?>
        </div>

      </div>
    </div>
  </div>

</div>

<script>
  function switchDisplay(evt) {
    const aboutCheck = $(evt.target)
    const check = $(evt.target).is(':checked')
    const textStatus = check ? 'เปิด' : 'ปิด'
    const status = check ? 'on' : 'off'
    const id = $(evt.target).val().trim()

    $.ajax({
      url: './query/switch_status_about.php',
      type: 'post',
      data: {
        'row_id': id,
        'status': status
      },
      success: function(response) {
        if (validateErr(response)) {
          aboutCheck.prop('checked', !check)
          errMessage('เกิดข้อผิดพลาด', response)
        } else {
          const result = get_response_object(response).result
          if (result) {
            displaySuccess(`${textStatus}สำเร็จ`)
          }
        }
      }
    })
  }
</script>