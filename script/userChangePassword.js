$('#change-password').click(function () {
  $('.validate-msg').remove()
  $('#user-change-password-form')[0].reset()
  $('#user-password-modal').modal('show')
})

function getStatePassword() {
  return {
    'before_password': $('#before-password'),
    'after_password': $('#after-password'),
    'confirm_password': $('#confirm-password')
  }

}

$('.obscure-text').click(function () {
  const inputText = $(this).prev()
  const state = getStateProp($(this), 'data-obscure')
  const obscure = state == 'true' ? 'text' : 'password'
  const v = state == 'true' ? 'false' : 'true'
  inputText.attr('type', obscure)
  setStateProp($(this), 'data-obscure', v)
})
$('#confirm-password').keyup(function () {
  const confirmPassEl = $(this)
  const passwordEl = $('#after-password')
  const password = passwordEl.val().trim()
  const confirmPass = confirmPassEl.val().trim()
  confirmPassEl.parent().next().remove()
  if (password != confirmPass) {
    setStateProp(confirmPassEl, 'data-validate', 'false')
    confirmPassEl.parent().after(createValidate('รหัสผ่านไม่ตรงกัน'))
  }
  if (password == confirmPass) {
    setStateProp(confirmPassEl, 'data-validate', 'true')
  }

})
$('#after-password').keyup(function () {
  const passwordEl = $(this)
  const password = passwordEl.val().trim()
  passwordEl.parent().next('.validate-msg').remove()
  const {
    before_password,
    confirm_password,
    after_password
  } = getStatePassword()



  if (after_password.val().trim() == confirm_password.val().trim()) {
    setStateProp(confirm_password, 'data-validate', 'true')
  } else {
    setStateProp(confirm_password, 'data-validate', 'false')
  }

  if (password != '') {

    if (password == before_password.val().trim()) {
      setStateProp(after_password, 'data-validate', 'false')
      passwordEl.parent().after(createValidate('โปรดป้อนรหัสใหม่ไม่ซ้ำกับรหัสเดิม'))
    } else {
      const {
        validate,
        alert
      } = validatePassword(password)

      if (!validate) {
        setStateProp(passwordEl, 'data-validate', 'false')
        passwordEl.parent().after(createValidate(alert))
      }
      if (validate) {
        setStateProp(passwordEl, 'data-validate', 'true')
      }
    }

  }
})
$('#before-password').keyup(function () {
  const passEl = $(this)
  const pass = passEl.val().trim()


  $.ajax({
    url: './request/validate_password.php',
    type: 'post',
    data: {
      'password': pass
    },
    success: function (response) {
      passEl.parent().next('.validate-msg').remove()
      if (validateErr(response)) {
        passEl.parent().after(createValidate('รหัสผ่านไม่ถูกต้อง'))
        setStateProp(passEl, 'data-validate', 'false')
      } else {
        const obj = get_response_object(response)
        if (obj.result) {
          setStateProp(passEl, 'data-validate', 'true')
        }
      }
    }
  })
})
$('#password-update').click(function () {
  const {
    before_password,
    confirm_password,
    after_password
  } = getStatePassword()
  const passwordForm = [{
    'input': before_password,
    'msg': 'กรุณาป้อนรหัสเดิมก่อน'
  },
  {
    'input': after_password,
    'msg': 'กรุณาป้อนรหัสใหม่'
  },
  {
    'input': confirm_password,
    'msg': 'กรุณาป้อนยืนยันรหัสผ่านอีกครั้ง'
  }
  ]
  let validate = 0
  passwordForm.forEach((fd) => {
    const {
      input,
      msg
    } = fd

    const v = input.val().trim()

    if (v == '') {
      input.parent().next().remove()
      validate++
      setStateProp(input, 'data-validate', 'false')
      input.parent().after(createValidate(msg))
    }
    if (v != '') {
      const state = getStateProp(input, 'data-validate')
      if (state == 'false') {
        validate++
      }
      if (state == 'true') {
        input.parent().next('.validate-msg').remove()
      }
    }
  })

  const validateConfirmPass = getStateProp(confirm_password, 'data-validate')
  confirm_password.parent().next('.validate-msg').remove()
  if (validateConfirmPass == 'false') {
    confirm_password.parent().after(createValidate('รหัสผ่านไม่ตรงกัน'))
  }

  if (validate == 0) {
    $.ajax({
      url: './query/update_password.php',
      type: 'post',
      data: {
        'password': after_password.val().trim()
      },
      success: function (response) {
        if (validateErr(response)) {
          $('#user-change-password-form')[0].reset()
          $('#user-password-modal').modal('hide')
          createToastMsg($('#userToast'), 'เกิดข้อผิดพลาด บันทึกล้มเหลว')

        } else {
          const obj = get_response_object(response)
          if (obj.result) {
            $('#user-change-password-form')[0].reset()
            $('#user-password-modal').modal('hide')
            createToastMsg($('#userToast'), 'เปลี่ยนแปลงเรียบร้อย')
          }
        }
      }
    })
  }
})