$('#login').click(function() {
  const username = $('#username').val().trim()
  const password = $('#password').val().trim()
  const data = {
    'username': username,
    'password': password
  }
  if (username != '' && password != '') {
    $.ajax({
      url: './request/auth_login.php',
      type: 'post',
      data: data,
      success: function(response) {
        if (validateErr(response)) {
          errMessage('', 'เข้่าสู้ระบบล้มเหลว')
        } else {
          const result = get_response_object(response).result
          if (result) {
            location.assign('./index.php')
          }
        }
      }
    })
  }

})