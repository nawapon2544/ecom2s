function getStateName() {
  return [$('#fname'), $('#lname')]
}
$('#edit-name').click(function () {
  $(this).css('display', 'none')
  const control = $(this).parent().children('.btn-control')
  displayStyle(control, 'inline')
  const [fnameEl, lnameEl] = getStateName()
  setPropElement(fnameEl, 'disabled', false)
  setPropElement(lnameEl, 'disabled', false)
  setStateProp(fnameEl, 'data-before', fnameEl.val())
  setStateProp(lnameEl, 'data-before', lnameEl.val())
})

$('#cancel-edit-name').click(function () {
  const [fnameEl, lnameEl] = getStateName()
  const control = $(this).parent().children('.btn-control')

  fnameEl.val(getStateProp(fnameEl, 'data-before'))
  lnameEl.val(getStateProp(lnameEl, 'data-before'))
  setPropElement(fnameEl, 'disabled', true)
  setPropElement(lnameEl, 'disabled', true)
  displayStyle($('#edit-name'), 'inline')
  displayStyle(control, 'none')
})

$('#confirm-edit-name').click(function () {
  const control = $(this).parent().children('.btn-control')
  const [fnameEl, lnameEl] = getStateName()

  const nameForm = [{
    'name': 'fname',
    'input': fnameEl,
    'msg': 'กรุณาป้อนชื่อ'
  }, {
    'name': 'fname',
    'input': lnameEl,
    'msg': 'กรุณาป้อนนามสกุล'
  }]

  let validate = 0
  nameForm.forEach((fd) => {
    const {
      input,
      msg
    } = fd

    const val = input.val().trim()
    input.parent().parent().children('.validate-msg').remove()
    if (val == '') {
      input.parent().after(createValidate(msg))
    }
  })

  if (validate == 0) {
    const fname = fnameEl.val().trim()
    const lname = lnameEl.val().trim()
    $.ajax({
      url: './query/update_name.php',
      type: 'post',
      data: {
        'fname': fname,
        'lname': lname
      },
      success: function (response) {
        if (validateErr(response)) {
          createToastMsg($('#userToast'), 'เกิดข้อผิดพลาด')
        } else {
          const obj = get_response_object(response)
          if (!obj.result) {
            createToastMsg($('#userToast'), 'เปลี่ยนแปลงข้อมูลไม่สำเร็จ')
          }

          if (obj.result) {
            setPropElement(fnameEl, 'disabled', true)
            setPropElement(lnameEl, 'disabled', true)

            setStateProp(fnameEl, 'data-before', fname)
            setStateProp(lnameEl, 'data-before', lname)
            displayStyle($('#edit-name'), 'inline')
            displayStyle(control, 'none')
          }
        }
      }
    })
  }
})