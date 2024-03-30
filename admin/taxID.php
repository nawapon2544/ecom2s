<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$row_id = ConfigABoutUsID::get_tax_id();
$sql = "SELECT * FROM about_us WHERE row_id='$row_id'";
$row = connect_db()->query($sql);
$tax_row = $row->fetch(PDO::FETCH_ASSOC);
$tax_id = $row->rowCount() == 1 ? $tax_row['data'] : '';
?>

<div class="container">
  <div class="my-3 row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
      <div class="bg-light border rounded">
        <h5 class="bg-dark text-light p-2  rounded-top">
          เลขประจำตัวผู้เสียภาษี
        </h5>
        <div class="my-2 p-2">
          <div>
            <div class="input-group">
              <span class="input-group-text">
                <i class="fa-solid fa-store"></i>
              </span>
              <input type="text" value="<?php echo $tax_id ?>" id="taxID" class="form-control" placeholder="ป้อนเลขประจำตัวผู้เสียภาษี">
            </div>
          </div>
          <div class="d-flex my-2 justify-content-center">
            <button id="taxIDSubmit" class="btn btn-success">บันทึก</button>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

<script>
  function taxID() {
    return $('#taxID')
  }
  $('#taxIDSubmit').click(function() {
    const taxId = taxID().val().trim()
   taxID().parent().next().remove()
    if (taxId == '') {
      taxID().parent().after(createValidate('กรุณาป้อนชื่อเว็บไซต์'))
    }
    if (taxId != '') {
      $.ajax({
        url: './query/taxIDSubmit.php',
        type: 'post',
        data: {
          'tax_id': taxId
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
    }
  })
</script>