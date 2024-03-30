$('.tracking-set-default').change(function() {
  const trackingCheck = $(this)
  const id = $(this).attr('data-id')
  const social = $(this).attr('data-social')
  const check = $(this).is(':checked')
  const set_default = check ? 'on' : 'off'
  const data = {
    'track_chanel_id': id,
    'set_default': set_default,
    'social': social
  }
  $.ajax({
    url: './query/trackingChanelDefault.php',
    type: 'post',
    data: data,
    success: function(response) {
      if (validateErr(response)) {
        errMessage('เกิดข้อผิดพลาด', response)
        trackingCheck.prop('checked', !check)
      } else {
        const result = get_response_object(response).result
        if (result) {
          displaySuccess(`ตั้งค่าสำเร็จ`)
        }
      }
    }
  })
})

$('.tracking-edit').click(function() {
  location.assign(`./?p=tracking-chanel-edit&id=${$(this).attr('data-id')}`)
})

$('.tracking-switch').change(function() {
  const trackingCheck = $(this)
  const check = $(this).is(':checked')
  const status = check ? 'on' : 'off'
  const textStatus = status == 'on' ? 'เปิด' : 'ปิด'
  const data = {
    'track_chanel_id': $(this).attr('data-id'),
    'status': status
  }
  $.ajax({
    url: './query/trackingChanelSwitch.php',
    type: 'post',
    data: data,
    success: function(response) {
      if (validateErr(response)) {
        errMessage('เกิดข้อผิดพลาด', response)
        trackingCheck.prop('checked', !check)
      } else {
        const result = get_response_object(response).result
        if (result) {
          displaySuccess(`${textStatus}สำเร็จ`, false)
        }
      }
    }
  })
})
$('.tracking-delete').click(function() {
  dialogConfirm('ลบช่องทางการติดตาม', 'คุณต้องการลบช่องการติดตามนี้ใข่ หรือ ไม่')
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './query/trackingChanelDelete.php',
          type: 'post',
          data: {
            'track_chanel_id': $(this).attr('data-id')
          },
          success: function(response) {
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