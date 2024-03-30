function iconUpload() {
  return $('#icon-upload')
}
iconUpload().change(function () {
  const file = $(this)[0].files
  if (file.length > 0) {
    const src = URL.createObjectURL(file[0])
    $('#icon-section').html(`<img src="${src}">`)
  }
})

$('#iconSubmit').click(function () {
  const file = iconUpload()[0].files
  iconUpload().parent().next().remove()
  if (file.length == 0) {
    iconUpload().parent().after(createValidate('กรุณาเลือกไฟล์'))
  }

  if (file.length == 1) {
    const formData = new FormData()
    formData.append('icon', file[0])
    $.ajax({
      url: './query/iconSubmit.php',
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