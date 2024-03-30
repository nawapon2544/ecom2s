<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_refund_money_id();
$sql = "SELECT * FROm about_us WHERE row_id='$row_id'";
$row = connect_db()->query($sql);
$refund_money_row = $row->fetch(PDO::FETCH_ASSOC);
$refund_money = $row->rowCount() == 1 ? $refund_money_row['data'] : '';
?>

<div class="container">
  <p class="bg-dark rounded  text-light px-3 py-2 my-1 fw-bold">
  การคืนเงิน
  </p>
  <p class="form-text bg-light fw-bold my-1 border rounded  p-2">
    ป้อนวิธีการคืนเงิน ของร้าน แบรนด์ หรือ ที่เกี่ยวกับ บริษัทของเรา
  </p>
  <div class="my-2" id="form-state" data-val="<?php echo htmlspecialchars($refund_money) ?>">
    <textarea id="refundMoney" class="form-control"></textarea>
  </div>
  <button id="refundMoneySubmit" class="btn btn-success">
    บันทึก
  </button>
</div>
<script>
  CKEDITOR.replace('refundMoney')
  CKEDITOR.instances.refundMoney
    .setData($('#form-state').attr('data-val'))
  $('#refundMoneySubmit').click(function() {
    const text = CKEDITOR.instances.refundMoney.getData().trim()
    $.ajax({
      url: './query/refundMoneySubmit.php',
      type: 'post',
      data: {
        'refund_money': text
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