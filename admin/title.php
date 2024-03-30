<?php
require_once('../conn.php');
require_once('./lib/config_abouUs_id.php');
$title_id = ConfigABoutUsID::get_title_id();
$sql = "SELECT * FROM about_us WHERE row_id='$title_id'";
$row = connect_db()->query($sql);
$title_row = $row->fetch(PDO::FETCH_ASSOC);
$title = $row->rowCount() == 1 ? $title_row['data'] : '';
?>

<div class="container">
  <div class="my-3 row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
      <div class="bg-light border rounded">
        <h5 class="bg-dark text-light p-2  rounded-top">
          ชื่อเว็บไซต์
        </h5>
        <div class="my-2 p-2">
          <div>
            <div class="input-group">
              <span class="input-group-text">
              <i class="fa-solid fa-tag"></i>
              </span>
              <input type="text" value="<?php echo $title ?>" id="titleWeb" class="form-control" placeholder="ป้อนชื่อเว็บไซต์">
            </div>
          </div>
          <div class="d-flex my-2 justify-content-center">
            <button id="titleSubmit" class="btn btn-success">บันทึก</button>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

<script>
  function titleWeb() {
    return $('#titleWeb')
  }
  $('#titleSubmit').click(function() {
    const title = titleWeb().val().trim()
    titleWeb().parent().next().remove()
    if (title == '') {
      titleWeb().parent().after(createValidate('กรุณาป้อนชื่อเว็บไซต์'))
    }
    if (title != '') {
      $.ajax({
        url: './query/titleSubmit.php',
        type: 'post',
        data: {
          'title': title
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