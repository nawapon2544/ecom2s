$('#add-register').click(function() {
  const registerForm = [{
      'input': $('#email'),
      'msg': 'กรุณาป้อนอีเมลก่อน',
      'formtype': 'email'
    },
    {
      'input': $('#username'),
      'msg': 'กรุณาป้อนผู้ใช้งาน',
      'formtype': 'username'
    },
    {
      'input': $('#password'),
      'msg': 'กรุณาป้อนรหัสผ่าน',
      'formtype': 'password'
    },
    {
      'input': $('#fname'),
      'msg': 'กรุณาป้อนเบอร์ติดต่อ',
      'formtype': 'text'
    },
    {
      'input': $('#lname'),
      'msg': 'กรุณาป้อนเบอร์ติดต่อ',
      'formtype': 'text'
    }, {
      'input': $('#phone'),
      'msg': 'กรุณาป้อนเบอร์ติดต่อ',
      'formtype': 'text'
    }
  ]

  let emptyCount = 0
  registerForm.forEach((fd) => {
    const {
      input,
      msg,
      formtype
    } = fd
    input.parent().parent().children('.validate-msg').remove()
    const v = input.val()

    if (formtype == 'email') {
      if (v == '') {
        emptyCount++
        input.parent().after(createValidate(msg))
      } else {
        if (!validateEmail(v)) {
          emptyCount++
          input.parent().after(createValidate('รูปแบบไม่ถูกต้อง'))
        } else {
          if (input.attr('data-register') == 'false') {
            emptyCount++
            input.parent().after(createValidate('มีผู้ใช้งานแล้ว'))
          }
        }
      }
    }

    if (formtype == 'username') {
      if (v == '') {
        emptyCount++
        input.parent().after(createValidate(msg))
      } else {
        if (input.attr('data-register') == 'false') {
          emptyCount++
          input.parent().after(createValidate('มีผู้ใช้งานแล้ว'))
        }
      }
    }
    if (formtype == 'password') {
      if (v == '') {
        emptyCount++
        input.parent().after(createValidate(msg))
      } else {
        const {
          validate,
          alert
        } = validatePassword(v)
        if (!validate) {
          emptyCount++
          input.parent().after(createValidate(alert))
        }
      }
    }
    if (formtype == 'text') {
      if (v == '') {
        emptyCount++
        input.parent().after(createValidate(msg))
      }
    }
  })


  if (emptyCount == 0) {
    const data = {
      'email': $('#email').val(),
      'username': $('#username').val(),
      'password': $('#password').val(),
      'fname': $('#fname').val(),
      'lname': $('#lname').val(),
      'phone': $('#phone').val()
    }

    $.ajax({
      url: './query/register_submit.php',
      type: 'post',
      data: data,
      success: function(response) {
        if (validateErr(response)) {
          createToastMsg($('#register-toast'), 'เกิดข้อผิดพลาด')
        } else {
          const obj = get_response_object(response)
          if (obj.result) {
            window.location.assign('./signin.php')
          }
        }
      }
    })
  }
})

$('#username').keyup(function() {
  const userEl = $(this)
  const username = userEl.val()
  userEl.parent().parent().children('.validate-msg').remove()
  if (username != '') {
    $.ajax({
      url: './request/validate-username.php',
      type: 'post',
      data: {
        'username': username
      },
      success: function(response) {
        console.log(response)
        if (response.includes('{')) {
          const obj = JSON.parse(response.substring(response.indexOf('{')))
          const {
            result,
            register
          } = obj
          if (register) {
            userEl.parent().after(createValidate('มีผู้ใช้งานแล้ว'))
            userEl.attr('data-register', 'false')
          } else {
            userEl.attr('data-register', 'true')
          }
        } else {
          alert('เกิดข้อผิดพลาด')
        }
      }
    })
  }
})

$('#email').keyup(function() {
  const emailEl = $(this)
  const email = emailEl.val()
  emailEl.parent().parent().children('.validate-msg').remove()
  if (email != '') {
    if (!validateEmail(email)) {
      emailEl.parent().after(createValidate('รูปแบบไม่ถูกต้อง'))
    } else {
      $.ajax({
        url: './request/validate-email.php',
        type: 'post',
        data: {
          'email': email
        },
        success: function(response) {
          if (validateErr(response)) {
            emailEl.parent().after(createValidate('มีผู้ใช้งานแล้ว'))
            emailEl.attr('data-register', 'false')
          } else {
            const result = get_response_object(response).result
            if (result) {
              emailEl.attr('data-register', 'true')
            }
          }
        }
      })
    }
  }
})