$('#orderTextID').keyup(function (evt) {
  const id = $(this).val().trim()
  if (evt.keyCode == 13) {
    if (id != '') {
      const r = get_page_url_queryParams() + `&id=${id}`
      location.assign(r)
    }
  }
})
$('.show-slip').click(function () {
  const slip = $(this).attr('data-slip')
  $('#slip-section').html(`<img src="../order-statement-img/${slip}">`)
  $('#confirm-order-modal').modal('show')
})

$('.confirm-order').click(function () {
  const id = $(this).attr('data-id')
  dialogConfirm('ยืนยันคำสั่งซื้อ', 'คุณต้องยืนคำสั่งซื้อนี้ใช่ หรือ ไม่ ? ')
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './query/confirm_order_submit.php',
          type: 'post',
          data: {
            'order_id': id
          },
          success: function (response) {
            if (validateErr(response)) {
              errMessage('เกิดข้อผิดพลาด', response)
            } else {
              const result = get_response_object(response).result
              if (result) {
                displaySuccess('ยืนยันสำเร็จ')
              }
            }
          }
        })
      }
    })
})
$('.cancel-order').click(function () {
  const id = $(this).attr('data-id')
  dialogConfirm('ยกเลิกคำสั่งซื้อ', 'คุณต้องการยกเลิกคำสั่งซื้อนี้ใช่ หรือ ไม่ ? ')
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './query/cancel_order_submit.php',
          type: 'post',
          data: {
            'order_id': id
          },
          success: function (response) {
            if (validateErr(response)) {
              errMessage('เกิดข้อผิดพลาด', response)
            } else {
              const result = get_response_object(response).result
              if (result) {
                displaySuccess('ยกเลิกเรียบร้อย')
              }
            }
          }
        })
      }
    })
})
