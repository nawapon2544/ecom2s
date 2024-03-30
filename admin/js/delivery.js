CKEDITOR.replace('delivery');
CKEDITOR.instances.delivery
  .setData($('#form-state').attr('data-val'))
$('#deliverySubmit').click(function () {
  const text = CKEDITOR.instances.delivery.getData().trim()
  $.ajax({
    url: './query/deliverySubmit.php',
    type: 'post',
    data: {
      'delivery': text
    },
    success: function (response) {
      if (validateErr(response)) {
        errMessage('เกิดข้อผิดพลาด', response)
      } else {
        const result = get_response_object(response).result
        console.log(result)
        if (result) {
          displaySuccess('บันทึกสำเร็จ')
        }
      }
    }
  })
})