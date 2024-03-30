$('.emp-edit').click(function () {
  location.assign(`./?p=admin-edit&id=${$(this).attr('data-id')}`)
})
$('.emp-delete').click(function () {
  const id = $(this).attr('data-id')
  dialogConfirm('', 'ต้องการลบผู้ดูแลนี้ใช่ หรือ ไม่').then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: './query/admin_delete.php',
        type: 'post',
        data: {
          'employee_id': id
        },
        success: function (response) {
          if (validateErr(response)) {
            errMessage('เกิดข้อผิดพลาด', response)
          } else {
            const result = get_response_object(response).result
            if (result) {
              displaySuccess('ลบเรียบร้อย')
            }
          }
        }
      })
    }
  })

})