<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_terms_id();
$sql = "SELECT * FROM about_us WHERE row_id='$row_id'";
$row = connect_db()->query($sql);

$tac_row =  $row->fetch(PDO::FETCH_ASSOC);
$terms_and_conditions    = $row->rowCount() == 1
  ? $tac_row['data'] : '';
?>

<div class="container">
  <p class="bg-dark rounded  text-light px-3 py-2 my-1 fw-bold">
    <span>ข้อกำหนดและเงื่อนไข (Terms and Conditions)</span>
  </p>
  <p class="form-text bg-light fw-bold my-1 border rounded  p-2">
    ป้อนข้อกำหนดและเงื่อนไข ของร้าน แบรนด์ หรือ ที่เกี่ยวกับ บริษัทของเรา
  </p>
  <div class="my-2" id="form-state" data-val="<?php echo htmlspecialchars($terms_and_conditions)   ?>">
    <textarea id="TermsAndConditions"></textarea>
  </div>

  <button class="btn btn-success" id="terms-and-conditions-submit">
    บันทึก
  </button>
</div>

<script>
  CKEDITOR.replace('TermsAndConditions');
  CKEDITOR.instances.TermsAndConditions
    .setData($('#form-state').attr('data-val'))

  $('#terms-and-conditions-submit').click(function() {
    const text = CKEDITOR.instances.TermsAndConditions.getData().trim()
    $.ajax({
      url: './query/terms_and_conditions_submit.php',
      type: 'post',
      data: {
        'data': text
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