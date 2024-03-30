$('#employee-submit').click(function () {
  const employeeForm = [{
    'formtype': 'text',
    'input': $('#username'),
    'msg': 'กรุณาป้อนชื่อผู้งานในระบบ'
  },
  {
    'formtype': 'text',
    'input': $('#password'),
    'msg': 'กรุณาป้อนรหัสผ่าน'
  },
  {
    'formtype': 'text',
    'input': $('#fname'),
    'msg': 'กรุณาป้อนชื่อพนักงาน'
  },
  {
    'formtype': 'text',
    'input': $('#lname'),
    'msg': 'กรุณาป้อนนามสกุล'
  },
  {
    'formtype': 'radio',
    'input': $('[name="private-role"]'),
    'msg': 'กรุณาเลือกระดับการเข้าถึง'
  }
  ]
  let validate = 0
  employeeForm.forEach((fd) => {
    const {
      input,
      formtype,
      msg
    } = fd

    if (formtype == 'text') {
      input.next().remove()
      const v = input.val().trim()
      if (v == '') {
        validate++
        input.after(createValidate(msg))
      }
    }

    if (formtype == 'radio') {
      input.parent().parent().children('.validate-msg').remove()
      const check = input.filter(':checked')
      console.log(check.length)
      if (check.length == 0) {
        validate++
        input.parent().parent().append(createValidate(msg))
      }
    }
  })
  if (validate == 0) {
    const data = {
      'username': $('#username').val(),
      'password': $('#password').val(),
      'fname': $('#fname').val(),
      'lname': $('#lname').val(),
      'private_role': $('[name="private-role"]').filter(':checked').val()
    }
    $.ajax({
      url: './query/admin_submit.php',
      type: 'post',
      data: data,
      success: function (response) {
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