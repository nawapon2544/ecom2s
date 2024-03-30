$('#orderTextId').keyup(function (evt) {
  const id = $(this).val().trim()
  if (evt.keyCode == 13) {
    if (id != '') {
      const r = get_page_url_queryParams([{
        'params': 'id',
        'val': id
      }])
      location.assign(r)
    }
  }

})

$('#ord-prepare-select-confirm').click(function () {
  const ordPrepare = $.map($('[name="ord-prepare-select"]')
    .filter(':checked'), (el) => atob($(el).val()))

  const textId = ordPrepare.map((ord) => `<p class="m-0">${ord}</p>`).join(' ')
  const textIdEl = `<div class="text-start">${textId}</div>`

  if (ordPrepare.length > 0) {
    prepareOrderConfirm('คุณเตรียมสินค้านี้ หมายเลขคำสั่งซื้อนี้ แล้วใช่หรือไม่ ', textIdEl)
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: './ord_prepare_request.php',
            type: 'post',
            data: {
              'order_id': ordPrepare.map((ord) => `'${ord}'`).join(',')
            },
            success: function (response) {

              if (validateErr(response)) {

              } else {
                const obj = get_response_object(response)

                if (obj.result) {
                  displaySuccess('อัพเดตสำเร็จ')
                }
                if (!obj.result) {
                  errMessage('ยืนยันการเตรียมสินค้า', 'เกิดข้อผิดพลาด')
                }
              }
            }
          })
        }
      })
  }

})
$('#ord-prepare-select-all').click(function () {
  const ordPrepareSelect = $('[name="ord-prepare-select"]')
  const countChecked = ordPrepareSelect.filter(':checked').length
  if (countChecked == ordPrepareSelect.length) {
    ordPrepareSelect.prop('checked', false)
  }
  if (countChecked < ordPrepareSelect.length) {
    ordPrepareSelect.prop('checked', true)
  }
})
$('#ord-prepare-print-select').click(function () {
  const ordPrepareSelect = $.map($('[name="ord-prepare-select"]')
    .filter(':checked'), (el, index) => `'${atob($(el).val())}'`)

  if (ordPrepareSelect.length > 0) {
    const textArea = `<textarea name="ord-prepare-print">${JSON.stringify(ordPrepareSelect)}</textarea>`
    const form = `<form style="display:none;" method="post" target="_blank" id="ord-prepare-print-form" action="./ord_prepare_print.php">${textArea}</form>`
    $('body').children('#ord-prepare-print-form').remove()
    $('body').children(':first').before(form)
    $('#ord-prepare-print-form').submit()
  }

})
$('.ord-prepare').click(function () {
  const id = atob($(this).attr('data-id'))
  const textIdEl = `<div class="text-start"><p class="m-0">${id}</p></div>`

  prepareOrderConfirm('คุณเตรียมสินค้านี้ หมายเลขคำสั่งซื้อนี้ แล้วใช่หรือไม่ ', textIdEl)
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './ord_prepare_request.php',
          type: 'post',
          data: {
            'order_id': `'${id}'`
          },
          success: function (response) {
            if (validateErr(response)) {
              if (!obj.result) {
                errMessage('เกิดข้อผิดพลาด', response)
              }
            } else {
              const obj = get_response_object(response)
              if (obj.result) {
                displaySuccess('อัพเดตสำเร็จ')
              }
            }
          }
        })
      }
    })
})