CKEDITOR.replace('orderCancel')
CKEDITOR.instances.orderCancel
  .setData($('#form-state').attr('data-val'))
$('#orderCancelSubmit').click(function () {
  const text = CKEDITOR.instances.orderCancel.getData().trim();
  $.ajax({
    url: './query/orderCancelSubmit.php',
    type: 'post',
    data: {
      'order_cancel': text
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