$('#orderTextId').keyup(function (evt) {
  const id = $(this).val().trim()
  if (evt.keyCode == 13) {
    if (id != '') {
      const r = get_page_url_queryParams([{
        'params': 'id',
        'val': id
      }])
      location.assign(r)
    }
  }

})

$('#order-send-submit').click(function () {
  const id = $.map($('[name="ord-send-id"]'), (el, index) => $(el).val().trim())
  const num = $.map($('[name="ord-send-number"]'), (el, index) => $(el).val().trim())
  const service = $.map($('[name="ord-send-service"]'), (el, index) => $(el).val().trim())
  let deliveryNumber = []

  for (let i = 0; i < id.length; i++) {
    if (num[i] != '' && service[i] != '') {
      deliveryNumber.push({
        'order_id': id[i],
        'delivery_number': num[i],
        'delivery_service': service[i]
      })
    }
  }

  if (deliveryNumber.length > 0) {
    $.ajax({
      url: './request/ord_send_request.php',
      type: 'post',
      data: {
        'order_id': deliveryNumber
      },
      success: function (response) {
        if (validateErr(response)) {
          errMessage('เกิดข้อผิดพลาด', response)
        } else {
          const obj = get_response_object(response)

          if (obj.result) {
            displaySuccess('อัพเดตสำเร็จ')
          }
        }
      }
    })
  }
})

function getDeliveryList(index) {
  const dry = [{
    'name': 'Kerry Express',
    'key': 'kerry'
  },
  {
    'name': 'Flash Express',
    'key': 'flash'
  },
  {
    'name': 'DHL Express',
    'key': 'dhl'
  },
  {
    'name': 'J&T Express',
    'key': 'jt'
  },
  {
    'name': 'Best Express',
    'key': 'dhl'
  },
  {
    'name': 'ไปรษณีย์ไทย',
    'key': 'thpost'
  },
  {
    'name': 'Ninja Van',
    'key': 'nvan'
  }
  ]
  let dryEl = ``

  dry.forEach((d) => {
    dryEl += `
 <label class="delivery-label p-2 delivery-check-items" for="${d.key}-${index}">
   <span>${d.name}</span>
   <input class="d-none" name="delivery-number-${index}" onchange="setDelivery(event)"  type="radio" value="${d.name}" id="${d.key}-${index}">
 </label>`
  })
  return `<div class="delivery-list">${dryEl}</div>`
}

$('#ord-send-select-add-number').click(function () {
  const ordSendChecked = $('[name="ord-send-select"]').filter(':checked')
  const ordSendId = $.map(ordSendChecked, (el, index) => atob($(el).val()))
  let ordSendEl = ``

  if (ordSendId.length == 0) {
    errMessage('', 'ไม่มีรายการที่เลือก')
  }
  if (ordSendId.length > 0) {
    $.each(ordSendId, (index, id) => {
      ordSendEl +=
        `
  <div class="row">
    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">
          หมายเลขคำสั่งซื้อ
        </label>
        <div class="input-group">
          <span class="input-group-text">
            ID
          </span>
          <input type="text"  class="fw-bold text-secondary form-control form-border-none" disabled value="${id}" name="ord-send-id">
        </div>
      </div>
    </div>
    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">
          หมายเลขส่ง
        </label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-n"></i>
          </span>
          <input type="text" placeholder="ป้อนหมายเลขขนส่ง" class="form-control" name="ord-send-number">
        </div>
      </div>
    </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="my-2">
          <label class="form-label">
            บริการขนส่ง
          </label>
            <input type="text" placeholder="ป้อนหมาย หรือ เลือกบริการขนส่ง" id="${index}" class="form-control" onkeyup="enterDelivery(event)"  onfocus="selectDeliveryService(event)" name="ord-send-service">
            ${getDeliveryList(index)}
        </div>
      </div>
  </div>
`
    })

    $('.modal-dialog').addClass('modal-xl')
      .addClass('modal-dialog-scrollable')
    $('#order-el').html(ordSendEl)
    new bootstrap.Modal($('#order-send-modal')).show()
  }
})


function setDelivery(evt) {
  const el = evt.target
  const v = $(el).val()
  const name = $(el).attr('name')
  const formInput = $(el).parent().parent().prev()
  formInput.val(v)
  $(`[name="${name}"]`).prop('checked', false)
  $(el).parent().parent().css('display', 'none')
}

function enterDelivery(evt) {
  const v = $(evt.target).val()
  const keyCode = evt.keyCode
  console.log(keyCode)
  if (keyCode == 13) {
    $(evt.target).next().css('display', 'none')
  }

}

function selectDeliveryService(evt) {
  $(evt.target).next().css('display', 'block')
}

function disabledDelivery(evt) {
  $(evt.target).next().css('display', 'none')
}
$('#ord-send-select-all').click(function () {
  const ordSend = $('[name="ord-send-select"]')
  const ordSendChecked = ordSend.filter(':checked').length

  if (ordSendChecked < ordSend.length) {
    ordSend.prop('checked', true)
  }
  if (ordSendChecked == ordSend.length) {
    ordSend.prop('checked', false)
  }
})
$('.ord-send').click(function () {
  const id = atob($(this).attr('data-id'))
  $('#order-send-submit').attr('data-id', id)
  $('.modal-dialog').removeClass('modal-xl')
    .removeClass('modal-dialog-scrollable')


  const el = `
              <div>
                <div class="my-2">
                  <label class="form-label">หมายเลขคำสั่งซื้อ</label>
                  <input type="text" class="form-control" disabled value="${id}" name="ord-send-id">
                </div>
                <div class="my-2">
                  <label class="form-label">หมายเลขขนส่ง</label>
                  <input type="text" class="form-control" name="ord-send-number">
                </div>
                <div class="my-2">
                  <label class="form-label">บริการขนส่ง</label>
                  <input type="text" class="form-control" onkeyup="enterDelivery(event)"  onfocus="selectDeliveryService(event)" name="ord-send-service">
                  ${getDeliveryList(0)}
                </div>
              </div>
  
            `
  $('#order-el').html(el)
  new bootstrap.Modal($('#order-send-modal')).show()
})

$('#ord-prepare-select-confirm').click(function () {
  const ordPrepare = $.map($('[name="ord-prepare-select"]')
    .filter(':checked'), (el) => atob($(el).val()))

  const textId = ordPrepare.map((ord) => `<p class="m-0">คำสั่งซื้อ ${ord}</p>`).join(' ')
  const textIdEl = `<div class="text-start">${textId}</div>`


  if (ordPrepare.length > 0) {
    prepareOrderConfirm('คุณเตรียมสินค้านี้ หมายเลขคำสั่งซื้อนี้ แล้วใช่หรือไม่ ', textIdEl)
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: './ord_prepare_request.php',
            type: 'post',
            data: {
              'order_id': ordPrepare.map((ord) => `'${ord}'`).join(',')
            },
            success: function (response) {

              if (validateErr(response)) {
                errMessage('ยืนยันการเตรียมสินค้า', 'เกิดข้อผิดพลาด')
              } else {
                const obj = get_response_object(response)
                if (obj.result) {
                  displaySuccess('อัพเดตสำเร็จ')
                }
              }
            }
          })
        }
      })
  }

})