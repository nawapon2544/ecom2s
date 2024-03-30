function logoImgUpload() {
  return $('#logo-img-upload')
}

function textLogoInput() {
  return $('#text-logo-input')
}

function logoEdit() {
  return $('#logoEdit')
}

function logoEditCancel() {
  return $('#logoEditCancel')
}

function logoPlattern() {
  return $('[name="logo-plattern"]')
}
logoPlattern().change(function () {
  const p = $(this).val().trim()
  if (p == 'logoImg') {
    logoImgUpload().prop('disabled', false)
    textLogoInput().prop('disabled', true)
  }

  if (p == 'logoText') {
    textLogoInput().prop('disabled', false)
    logoImgUpload().prop('disabled', true)
  }
})

function logoSubmit() {
  return $('#logoSubmit')
}

logoImgUpload().change(function () {
  const file = $(this)[0].files
  if (file.length == 1) {
    const src = URL.createObjectURL(file[0])
    $('.logo-section').html(`<img src="${src}">`)
  }
})


logoEditCancel().click(function () {
  location.reload()
})
logoEdit().click(function () {
  logoPlattern().prop('checked', false)
  logoPlattern().prop('disabled', false)
  logoEdit().addClass('d-none')
  logoSubmit().removeClass('d-none')
  logoEditCancel().removeClass('d-none')
})
$('#logoSubmit').click(function () {
  $('.validate-msg').remove()
  const check = logoPlattern().filter(':checked').length
  let formData = new FormData()
  let validate = false
  if (check == 0) {
    errMessage('', 'โปรดเลือกรูปแบบ')
  }
  if (check == 1) {
    const p = logoPlattern().filter(':checked').val().trim()
    const el = p == 'logoText' ? textLogoInput() : logoImgUpload()

    formData.append('plattern', p)

    if (p == 'logoText') {
      const v = el.val().trim()

      if (v == '') {
        el.parent().after(createValidate('กรุณาป้อนโลโก้'))
      } else {
        validate = true
        formData.append('logo_text', v)
      }
    }

    if (p == 'logoImg') {
      const f = el[0].files
      if (f.length == 0) {
        el.parent().after(createValidate('กรุณาเลือกรูปโลโก้'))
      } else {
        validate = true
        formData.append('logo_img', f[0])
      }
    }
  }

  if (validate) {
    $.ajax({
      url: './query/logoSubmit.php',
      type: 'post',
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
      data: formData,
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
