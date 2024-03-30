$('#open-slide-modal').click(function() {
  $('#slide-form')[0].reset()
  $('#slide-modal').modal('show')
})

function slideUpload() {
  return $('#slide-upload')
}

$('.slide-delete').click(function() {
  const id = $(this).attr('data-id')
  const img = $(this).attr('data-img')

  dialogConfirm('ภาพสไลด์', 'คุณต้องการลบภาพสไลด์นี้ใช่หรือไม่ ?')
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './query/slideDelete.php',
          type: 'post',
          data: {
            'slide_id': id,
            'img': img
          },
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
})
$('#slideSubmit').click(function() {
  const file = slideUpload()[0].files
  console.log(file[0])
  let validate = false

  if (file.length == 0) {
    slideUpload().parent().after(createValidate('กรุณาเลือกภาพ'))
  }
  if (file.length == 1) {
    validate = true
  }

  if (validate == true) {
    const formData = new FormData()
    formData.append('slide', file[0])
    formData.append('descript', $('#slide-descript').val().trim())
    $.ajax({
      url: './query/slideSubmit.php',
      type: 'post',
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
      data: formData,
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