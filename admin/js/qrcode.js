function qrcodeUpload() {
  return $('#qrcode-upload')
}
qrcodeUpload().change(function () {
  const file = $(this)[0].files

  if (file.length == 0) {
    $('#qrcode-wrapper').html('')
  }
  if (file.length == 1) {
    const src = URL.createObjectURL(file[0])
    $('#qrcode-wrapper').html(`<img src="${src}">`)
  }
})

$('#qrcodeSubmit').click(function () {
  const file = qrcodeUpload()[0].files
  qrcodeUpload().parent().next('.validate-msg').remove()
  if (file.length == 0) {
    qrcodeUpload().parent().next().before(createValidate('กรุณาเลือกรูปภาพ qrcode'))
  }
  if (file.length == 1) {
    const formData = new FormData()
    formData.append('qrcode', file[0])
    $.ajax({
      url: './query/qrcodeSubmit.php',
      type: 'POST',
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
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
    });
  }

})