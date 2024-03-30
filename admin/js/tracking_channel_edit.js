function get_social() {
  return $('[name="social"]')
}

function get_social_account_name() {
  return $('#social-account-name')
}

function get_social_link() {
  return $('#social-link')
}

$.each(get_social(), (index, el) => {
  const social = $('#tracking-social').attr('data-tracking-social')
  if ($(el).val().trim() == social) {
    $(el).prop('checked', true)
  }
})

$('#trackingChanelSubmit').click(function() {
  const trackingChanelForm = [{
      'formtype': 'radio',
      'input': get_social(),
      'msg': 'กรุณาเลืิอกช่องทางการติดตาม'
    },
    {
      'formtype': 'text',
      'input': get_social_account_name(),
      'msg': 'กรุณาป้อนชื่อแอคเคาท์'
    },
    {
      'formtype': 'text',
      'input': get_social_link(),
      'msg': 'กรุณาป้อนลิงค์การเข้าถึง'
    }
  ]
  let validate = 0

  trackingChanelForm.forEach((fd) => {
    const {
      formtype,
      input,
      msg
    } = fd

    if (formtype == 'radio') {
      input.parent().parent().children('.validate-msg').remove()
      const check = input.filter(':checked')
      if (check.length == 0) {
        input.parent().parent().children(':last').after(createValidate(msg))
        validate++
      }
    }

    if (formtype == 'text') {
      const val = input.val().trim()
      input.parent().parent().children('.validate-msg').remove()
      if (val == '') {
        validate++
        input.parent().parent().children(':last').after(createValidate(msg))
      }
    }

  })

  if (validate == 0) {
    const data = {
      'track_chanel_id': $(this).attr('data-id').trim(),
      'social': get_social().filter(':checked').val().trim(),
      'account_name': get_social_account_name().val().trim(),
      'social_link': get_social_link().val().trim()
    }
    $.ajax({
      url: './query/trackingChanelUpdate.php',
      type: 'post',
      data: data,
      success: function(response) {
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