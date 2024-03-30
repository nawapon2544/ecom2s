function xlsxFile() {
  return $('[name="xlsxfile"]')
}

$('#xlsx-file-delete-select').click(function() {
  const files = $.map(xlsxFile().filter(':checked'), (el, index) => {
    return $(el).val().trim()
  })
  if (files.length > 0) {
    dialogConfirm('', 'คุณต้องการลบไฟล์รายงานที่เลือกใช่ หรือ ไม่ ?')
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: './query/xlsx_file_delete_select.php',
            type: 'post',
            data: {
              'xlsx_file': JSON.stringify(files)
            },
            success: function(response) {
              if (validateErr(response)) {
                errMessage('เกิดข้อผิดพลาด', response)
              } else {
                const obj = get_response_object(response)
                if (obj.result) {
                  const _success = obj.success
                  const fail = obj.fail
                  errMessage('', `สำเร็จ ${_success} ล้มเหลว ${fail}`)
                    .then((result) => {
                      if (result.isConfirmed) {
                        location.reload()
                      }
                    })
                }
              }
            }
          })
        }
      })
  }
})
$('#xlsx-file-all').click(function() {
  const filterCheck = xlsxFile().filter(':checked')
  const all = xlsxFile().length

  if (filterCheck.length < all) {
    xlsxFile().prop('checked', true)
  } else {
    xlsxFile().prop('checked', false)
  }
})

$('.xlsx-file-delete').click(function() {
  const filename = $(this).attr('data-filename')
  dialogConfirm('', 'คุณต้องการลบไฟล์รายงานนี้ใช่ หรือ ไม่')
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './query/xlsx_file_delete.php',
          type: 'post',
          data: {
            'xlsx_file': filename
          },
          success: function(response) {
            if (validateErr(response)) {
              errMessage('เกิดข้อผิดพลาด', response)
            } else {
              const result = get_response_object(response).result
              if (result) {
                displaySuccess(`ลบเรียบร้อย`)
              }

            }
          }
        })
      }
    })
})