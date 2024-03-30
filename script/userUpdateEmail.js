function getEmailEl() {
  return $('#email')
}

function emailControl() {
  return $('#edit-email').parent().next().children('.btn-control')
}
$('#edit-email').click(function() {
  displayStyle(emailControl(), 'inline')
  setPropElement(getEmailEl(), 'disabled', false)
  setStateProp(getEmailEl(), 'data-before', getEmailEl().val().trim())
})
$('#cancel-edit-email').click(function() {
  const email = getStateProp(getEmailEl(), 'data-before')
  getEmailEl().val(email)
  setPropElement(getEmailEl(), 'disabled', true)
  displayStyle(emailControl(), 'none')
})

$('#confirm-edit-email').click(function() {
  const mail = getEmailEl().val().trim()

  if (mail == '') {
    getEmailEl().parent().after(createValidate('กรุณาป้อนรหัสผ่าน'))
  } else {
    const state = getStateProp(getEmailEl(), 'data-validate')
    if (state == 'true') {
      getEmailEl().parent().next('.validate-msg').remove()
      $.ajax({
        url: './query/update_email.php',
        type: 'post',
        data: {
          'email': mail
        },
        success: function(response) {
          if (validateErr(response)) {
            createToastMsg($('#userToast'), 'เกิดข้อผิดพลาด ไม่สามารถเปลี่ยนแปลงค่าได้')
          } else {
            const result = get_response_object(response).result

            if (result) {
              setStateProp(getEmailEl(), 'data-before', mail)
              setPropElement(getEmailEl(), 'disabled', true)
              displayStyle(emailControl(), 'none')
            }
          }
        }
      })
    }
  }
})
$('#email').keyup(function() {
  const email = $(this).val()
  const before = getStateProp(getEmailEl(), 'data-before')
  if (email != '') {
    getEmailEl().parent().next('.validate-msg').remove()
    if (!validateEmail(email)) {
      setStateProp(getEmailEl(), 'data-validate', 'false')
      getEmailEl().parent().after(createValidate('รูปแบบไม่ถูกต้อง'))
    } else {
      if(email==before){
        setStateProp(getEmailEl(), 'data-validate', 'true')
      }
      if (email != before) {
        $.ajax({
          url: './request/validate-email.php',
          type: 'post',
          data: {
            'email': email
          },
          success: function(response) {
            if (validateErr(response)) {
              getEmailEl().parent().after(createValidate('มีผู้ใช้งานแล้ว'))
              setStateProp(getEmailEl(), 'data-validate', 'false')
            } else {
              const result = get_response_object(response).result

              if (result) {
                setStateProp(getEmailEl(), 'data-validate', 'true')
              }
            }
          }
        })
      }
    }

  }
})