function bankname() {
  return $('[name="bankname"]')
}

function bankAccountName() {
  return $('#bank-account-name')
}

function bankNumber() {
  return $('#bank-number')
}

$('#paymentSubmit').click(function () {
  const paymentForm = [{
    'formtype': 'radio',
    'input': bankname(),
    'msg': 'กรุณาเลือกธนาคาร'
  },
  {
    'formtype': 'text',
    'input': bankAccountName(),
    'msg': 'กรุณาป้อนขื่อบัญชี'
  },
  {
    'formtype': 'text',
    'input': bankNumber(),
    'msg': 'กรุณาป้อนหมายเลขธนาคาร'
  }
  ]
  let validate = 0
  paymentForm.forEach((fd) => {
    const {
      formtype,
      input,
      msg
    } = fd

    if (formtype == 'radio') {
      input.parent().parent().next('.validate-msg').remove()
      const check = input.filter(':checked')
      if (check.length == 0) {
        validate++
        input.parent().parent().after(createValidate(msg))
      }
    }
    if (formtype == 'text') {
      input.parent().children('.validate-msg').remove()
      const v = input.val().trim()
      if (v == '') {
        validate++
        input.after(createValidate(msg))
      }
    }
  })

  if (validate == 0) {
    const data = {
      'bank': bankname().filter(':checked').val().trim(),
      'account_name': bankAccountName().val().trim(),
      'account_number': bankNumber().val().trim()
    }
    $.ajax({
      url: './query/paymentSubmit.php',
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