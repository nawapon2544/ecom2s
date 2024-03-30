function phoneEditControl() {
  return $('#edit-phone').parent().next().children('.btn-control')
}

function getPhoneEl() {
  return $('#phone')
}
$('#edit-phone').click(function () {
  displayStyle(phoneEditControl(), 'inline')
  setStateProp($(this), 'data-before', getPhoneEl().val())
  setPropElement(getPhoneEl(), 'disabled', false)
})

$('#confirm-edit-phone').click(function () {
  const phone = getPhoneEl().val().trim()
  $(this).parent().prev('.validate-msg').remove()
  if (phone == '') {
    $(this).parent().prev().after(createValidate('กรุณาป้อนเบอร์ติดต่อ'))
  }
  $.ajax({
    url: './query/update_phone.php',
    type: 'post',
    data: {
      'phone': phone
    },
    success: function (response) {
      console.log(response)

      if (validateErr(response)) {
        createToastMsg($('#userToast'), 'เกิดข้อผิดพลาด ไม่สามารถเปลี่ยนค่าได้')
      } else {
        const obj = get_response_object(response)

        if (obj.result) {
          setStateProp(getPhoneEl(), 'date-before', phone)
          setPropElement(getPhoneEl(), 'disabled', true)
          displayStyle(phoneEditControl(), 'none')
        }
      }
    }
  })

})

$('#cancel-edit-phone').click(function () {

  const val = getStateProp($('#edit-phone'), 'data-before')
  getPhoneEl().val(val)
  displayStyle(phoneEditControl(), 'none')
  setPropElement(getPhoneEl(), 'disabled', true)
})