$('.payment-switch').click(function() {
  const el = $(this)
  const id = el.val().trim()
  const check = el.is(':checked')
  const status = check ? 'on' : 'off'
  const textStatus = check ? 'เปิด' : 'ปิด'
  const data = {
    'payment_id': id,
    'status': status
  }
  $.ajax({
    url: './query/paymentStatus.php',
    type: 'post',
    data: data,
    success: function(response) {
      if (validateErr(response)) {
        el.prop('checked', !check)
        errMessage('เกิดข้อผิดพลาด', response)
      } else {
        const result = get_response_object(response).result
        if (result) {
          displaySuccess(`${textStatus}สำเร็จ`, false)
        }
      }
    }
  })
})
$('.payment-edit').click(function() {
  location.assign(`./?p=payment-edit&id=${$(this).attr('data-id')}`)
})
$('.payment-delete').click(function() {
  const data = {
    'payment_id': $(this).attr('data-id')
  }
  dialogConfirm('', 'คุณต้องการลบบัญชีนี้ใช่ หรือไม่ ?')
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './query/paymentDelete.php',
          type: 'post',
          data: data,
          success: function(response) {
            if (validateErr(response)) {
              errMessage('เกิดข้อผิดพลาด', response)
            } else {
              const result = get_response_object(response).result
              if (result) {
                displaySuccess('ลบเรียบร้อย')
              }
            }
          }
        })
      }
    })

})