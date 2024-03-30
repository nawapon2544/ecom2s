$('#login').click(function () {
  const usernameEl = $('#username')
  const passwordEl = $('#password')
  const username = usernameEl.val().trim()
  const password = passwordEl.val().trim()
  usernameEl.parent().next('.validate-msg').remove()
  passwordEl.parent().next('.validate-msg').remove()
  if (username == '') {
    usernameEl.parent().after(createValidate('กรุณาป้อนชื่อผู้ใข้งาน หรือ อีเมล'))
  }
  if (password == '') {
    passwordEl.parent().after(createValidate('กรุณาป้อนรหัสผ่าน'))
  }
  if (username != '' && password != '') {
    $.ajax({
      url: './request/fetch_login.php',
      type: 'post',
      data: {
        'username': username,
        'password': password
      },
      success: function (response) {
        $('#signin').children(':last').prev('.validate-msg').remove()
        const signinToast = new bootstrap.Toast($('#signin-toast'))
        if (response.includes('{')) {
          const obj = get_response_object(response)
          if (obj.result) {
            const url = new URL(location.href)
            const params = url.searchParams
            const product = params.get('p')
            product == null ? location.reload() :
              location.assign(`./product.php?id=${product}`)
          } else {
            $('#signin').children(':last').prev().after(createValidate('ไม่พบผู้ใช้งานนี้ หรือ รหัสผ่านไม่ตรงกัน'))
          }
        } else {
          signinToast.show()
        }
      }
    })
  }

})