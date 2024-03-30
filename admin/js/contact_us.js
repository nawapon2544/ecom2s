$('#contactUsSubmit').click(function () {
  const formData = {
    'brand': $('#brand').val().trim(),
    'location': $('#location').val().trim(),
    'sub_district': $('#subDistrict').val().trim(),
    'district': $('#district').val().trim(),
    'province': $('#province').val().trim(),
    'postcode': $('#postcode').val().trim(),
    'business_hours': $('#businessHours').val().trim(),
    'about_us': $('#aboutUs').val().trim(),
    'email': $('#email').val().trim(),
    'contact_phone': $('#contactPhone').val().trim(),
  }
  const v = Object.values(formData)
  const filterVal = v.filter((t) => t.trim() != '').length

  function contactUsSubmit() {
    $.ajax({
      url: './query/contactUs_submit.php',
      type: 'post',
      data: {
        'data': JSON.stringify(formData)
      },
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

  if (filterVal < v.length) {
    dialogConfirm('เกี่ยวกับเรา', 'ป้อนข้อมูลยังไม่ครบ ! คุณต้องการบันทึก หรือ ไม่ ?')
      .then((result) => {
        if (result.isConfirmed) {
          contactUsSubmit()
        }
      })
  } else {
    contactUsSubmit()
  }
})