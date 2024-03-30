$('.user-delete').click(function () {
  const id = $(this).attr('data-id')
  dialogConfirm('', 'คุณต้องการผู้ใช้งานนี้ใช่ หรือ ไม่')
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './query/user_delete.php',
          type: 'post',
          data: {
            'user_id': id
          },
          success: function (response) {
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
$('.user-edit-confirm').click(function () {
  const passwordEl = $(this).parent().children(':eq(0)').children(':eq(0)')
  const btnControl = $(this).parent().children('button')
  const password = passwordEl.val().trim()
  const user_id = atob($(this).attr('data-id'))

  $.ajax({
    url: './query/user_change_password.php',
    type: 'post',
    data: {
      'password': password,
      'user_id': user_id
    },
    success: function (response) {
      if (validateErr(response)) {
        errMessage('เกิดข้อผิดพลาด', response)
      } else {
        const result = get_response_object(response)
        if (result.result) {
          passwordEl.val(result.text)
          displaySuccess('แก้ไขสำเร็จ', false)
          btnControl.css('display', 'none')
          passwordEl.prop('disabled', true)
        }
      }
    }
  })
})
$('.user-edit-cancel').click(function () {
  const passwordEl = $(this).parent().children(':eq(0)').children(':eq(0)')
  const btnControl = $(this).parent().children('button')
  const before = $(this).attr('data-before')

  btnControl.css('display', 'none')
  passwordEl.val(before)
  passwordEl.prop('disabled', true)
})
$('.user-edit-pass').click(function () {
  const passwordCol = $(this).parent().parent()
  const controlBtn = passwordCol.children('button')
  const passText = passwordCol.children(':eq(0)').children(':eq(0)')
  const password = passText.val().trim()
  $(controlBtn[1]).attr('data-before', password)
  controlBtn.css('display', 'inline')
  passText.prop('disabled', false)
})
$('.obscure-password').click(function () {
  const el = $(this)
  const passEl = el.prev()
  const obscure = el.attr('data-obscure')
  const status = obscure == 'true' ? 'false' : 'true'
  const type = obscure == 'true' ? 'text' : 'password'

  el.attr('data-obscure', status)
  passEl.attr('type', type)
})