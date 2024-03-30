<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_refund_product_id();
$sql = "SELECT * FROM about_us WHERE row_id='$row_id'";
$row = connect_db()->query($sql);
$refund_product_row = $row->fetch(PDO::FETCH_ASSOC);
$refund_product = $row->rowCount() == 1 ? $refund_product_row['data'] : '';
?>

<div class="container">
  <p class="bg-dark rounded  text-light px-3 py-2 my-1 fw-bold">
  การคืนสินค้า
  </p>
  <p class="form-text bg-light fw-bold my-1 border rounded  p-2">
    ป้อนวิธีการคืนสินค้า ของร้าน แบรนด์ หรือ บริษัทของเรา
  </p>
  <div class="my-2" id="form-state" data-val="<?php echo htmlspecialchars($refund_product) ?>">
    <textarea id="refundProduct" class="form-control"></textarea>
  </div>

  <button id="refundProductSubmit" class="btn btn-success">
    บันทึก
  </button>
</div>

<script>
  CKEDITOR.replace('refundProduct')
  CKEDITOR.instances.refundProduct
    .setData($('#form-state').attr('data-val'))
  $('#refundProductSubmit').click(function() {
    const text = CKEDITOR.instances.refundProduct.getData().trim()


    $.ajax({
      url: './query/refundProductSubmit.php',
      type: 'post',
      data: {
        'refund_product': text
      },
      success: function(response) {
        if (validateErr(response)) {
          errMessage('เกิดข้อผิดพลาด', response)
        } else {
          const result = get_response_object(response).result
          if (result) {
            displaySuccess('บันทึกสำเร็จ')
          }
        }
      }
    })
  })
</script>