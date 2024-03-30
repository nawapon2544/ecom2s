$('.delete-address-user').click(function () {
  const id = atob($(this).attr('data-id'))
  $.ajax({
    url: './address_user_delete.php',
    type: 'post',
    data: {
      'address_id': id
    },
    success: function (response) {
      if (validateErr(response)) {
        createToastMsg($('#address-user-toast'), 'เกิดข้อผิดพลาด')
      } else {
        const result = get_response_object(response).result
        if (result) {
          location.reload()
        }
      }
    }
  })
})