<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$warranty_policy_id =    ConfigABoutUsID::get_warranty_policy_id();

$sql  = "SELECT * FROM about_us WHERE row_id='$warranty_policy_id'";

$row = connect_db()->query($sql);
$warranty_policy_row = $row->fetch(PDO::FETCH_ASSOC);
$warranty_policy = $row->rowCount() == 1
  ? $warranty_policy_row['data'] : '';


?>

<div class="container">
  <p class="bg-dark rounded  text-light px-3 py-2 my-1 fw-bold">
    นโยบายการรับประกันสินค้า (Warranty Policy)
  </p>
  <p class="form-text bg-light fw-bold my-1 border rounded  p-2">
    ป้อนนโยบายการรับประกันสินค้า ของร้าน แบรนด์ หรือ นโยบายการรับประกันสินค้าบริษัทของเรา
  </p>
  <div class="my-2" id="form-state" data-val="<?php echo  htmlspecialchars($warranty_policy) ?>">
    <textarea id="warrantyPolicy" class="form-control" placeholder="ป้อนข้อมูล นโยบายการรับประกันสินค้าของร้านค้า บริษัท แบรนด์ ของเรา"></textarea>
  </div>
  <button id="warrantyPolicySubmit" class="btn btn-success">
    บันทึก
  </button>
</div>

<script>
  CKEDITOR.replace('warrantyPolicy');
  CKEDITOR.instances.warrantyPolicy
    .setData($('#form-state').attr('data-val'))
  $('#warrantyPolicySubmit').click(function() {
    const text = CKEDITOR.instances.warrantyPolicy.getData().trim();
    $.ajax({
      url: './query/warrantyPolicySubmit.php',
      type: 'post',
      data: {
        'warranty_policy': text
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