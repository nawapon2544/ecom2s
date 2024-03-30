$('#logout').click(function () {
  $.ajax({
    'url': './logout.php',
    type: 'post',
    success: function (response) {
      const addCartToast = $('#navbar-toast')
      if (validateErr(response)) {
        createToastMsg(addCartToast, 'เกิดข้อผิดพลาด')
      } else {
        const obj = get_response_object(response)
        if (obj.result) {
          createToastMsg(addCartToast, 'ออกจากระบบสำเร็จ')
          setInterval(() => {
            window.location.reload()
          }, 1500)
        } else {
          createToastMsg(addCartToast, 'เกิดข้อผิดพลาด')
        }

      }
    }
  })
})