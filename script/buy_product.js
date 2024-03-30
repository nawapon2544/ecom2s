window.addEventListener('load', () => {
  $.each($('.address-target'), (index, el) => {
    const target = $(el).attr('data-target')
    const display = $(el).attr('data-display') == 'false' ? 'none' : 'block'
    $(`#${target}`).css('display', display)
  })

})

$('.address-target').click(function () {
  const target = $(this).attr('data-target')
  const disabled = $(this).is(':disabled')
  targetActive(target)
  if (!disabled) {
    $.each($('.address'), (index, el) => {
      const id = $(el).attr('id')
      if (target == id) {
        $(el).css('display', 'block')
      }
      if (target != id) {
        $(el).css('display', 'none')
      }
    })
  }
})

$('[name="province"]').click(function () {
  activeCheck($(this), 'province')
  $.ajax({
    url: './request/fetch_district.php',
    type: 'post',
    data: {
      'province': $(this).val()
    },
    success: function (response) {
      if (validateErr(response)) {
        createToastMsg($('#address-toast'), 'เกิดข้อผิดพลาด')
      } else {
        const obj = get_response_object(response)
        if (!obj.result) {
          createToastMsg($('#address-toast'), 'โหลดข้อมูลล้มเหลว')
        }
        if (obj.result) {
          const district = obj.district
          let districtEl = ``
          district.forEach((d, index) => {
            districtEl += `
            <label for="d-${index}" class="check-address text-start d-block btn btn-light  rounded-0">
              <input type="radio" class="d-none" onchange="selectDistrict(event)" name="district" id="d-${index}" value="${d}">
              <span>${d}</span>
            </label>
            `
          })
          $('#district').html(districtEl)
          $('.address-target').filter('[data-target="district"]').prop('disabled', false)
          showAddreesInput('district')
          targetActive('district')
        }
      }
    }
  })
})

function selectDistrict(event) {
  const el = $(event.target)
  activeCheck(el, 'district')
  $.ajax({
    url: './request/fetch_subDistrict.php',
    type: 'post',
    data: {
      'district': el.val()
    },
    success: function (response) {
      if (validateErr(response)) {
        createToastMsg($('#address-toast'), 'เกิดข้อผิดพลาด')
      } else {
        const obj = get_response_object(response)
        if (!obj.result) {
          createToastMsg($('#address-toast'), 'โหลดข้อมูลล้มเหลว')
        }
        if (obj.result) {
          const sub_district = obj.sub_district
          let subDistrictEl = ``
          sub_district.forEach((d, index) => {
            subDistrictEl += `
            <label for="s-${index}" class="check-address check-sub-district text-start btn btn-light  rounded-0">
              <input type="radio" class="d-none" onchange="setAddress(event)"  name="sub-district" id="s-${index}" value="${d.sub_district}-${d.postcode}">
              <span>${d.sub_district}</span>
              <span>${d.postcode}</span>
            </label>
            `
          })
          $('#sub-district').html(subDistrictEl)
          $('.address-target').filter('[data-target="sub-district"]').prop('disabled', false)
          showAddreesInput('sub-district')
          targetActive('sub-district')
        }
      }
    }
  })
}

function selectSubDistrict(event) {
  const el = $(event.target)
  activeCheck(el, 'sub-district')
}

function setAddress(evt) {
  const [subDistrict, postcode] = $(evt.target).val().split('-')
  const province = $('[name="province"]').filter(':checked').val().trim()
  const district = $('[name="district"]').filter(':checked').val().trim()
  $('#address-text').val(`${subDistrict},${district},${province},${postcode}`).css('display', 'block')

  $('#address-area').css('display', 'none')
}


function targetActive(target) {
  $.each($('.address-target'), (index, element) => {
    if (target == $(element).attr('data-target')) {
      $(element).addClass('active')
    } else {
      $(element).removeClass('active')
    }
  })
}

function activeCheck(element, address_type) {
  const check = $(element).val().trim()
  $.each($(`[name="${address_type}"]`), (index, el) => {
    if ($(el).val().trim() == check) {
      $(el).parent().addClass('active')
    } else {
      $(el).parent().removeClass('active')
    }
  })
}

function showAddreesInput(target) {
  $.each($('.address'), (index, el) => {
    const id = $(el).attr('id')
    if (target == id) {
      $(el).css('display', 'block')
    }
    if (target != id) {
      console.log('ไม่')
      $(el).css('display', 'none')
    }
  })
}
$('#address-text').focus(function () {
  $(this).css('display', 'none')
  $('#address-area').css('display', 'block')
})
$('#cancel-address-select').click(function () {
  $.each($('.address-items'), (index, el) => {
    if ($(el).attr('data-default') == 'false') {
      $(el).css('display', 'none')
    } else {
      $(el).css('display', 'block')
    }
  })
  $('.address-check-items').addClass('d-none')
  $(this).css('display', 'none')
})
$('#edit-address-select').click(function () {
  $('.address-check-items').removeClass('d-none')
  $('.address-items').css('display', 'block')
  $('#cancel-address-select').css('display', 'inline')
})

$('[name="address"]').change(function () {
  $('.address-items').css('display', 'none')
  const stateEl = $(this).parent().parent().parent()

  $.each($('.address-items'), (index, el) => {
    $(el).attr('data-default', 'false')
    $('.address-check-items').addClass('d-none')
  })
  $('#cancel-address-select').css('display', 'none')
  stateEl.attr('data-default', 'true')
  stateEl.css('display', 'block')
})

$('#order-buy').click(function () {
  const formData = new FormData()
  const products = atob($(this).attr('data-buy-product'))
  const quantity = JSON.parse(products)
    .map((p) => Number.parseInt(p.quantity))
    .reduce((current, prev) => current + prev, 0)

  const total = JSON.parse(products)
    .map((p) => Number.parseFloat(p.total))
    .reduce((current, prev) => current + prev, 0)

  const delivery_cost = JSON.parse(products)
    .map((p) => Number.parseFloat(p.delivery_cost))
    .reduce((current, prev) => current + prev, 0)
  let validate = 0


  let emptyCount = 0
  const validateAddress = $('[name="address"]').filter(':checked').length
  if (validateAddress == 0) {
    emptyCount++
    new bootstrap.Modal($('#order-modal')).show()
  }
  const statementEl = $('#statement')
  statementEl.parent().parent().children(':eq(1)').remove()
  if (statementEl[0].files.length == 0) {
    validate++
    statementEl.parent().parent().children(':eq(0)').after(createValidate('กรุณาอัพโหลดการชำระเงิน'))
  }
  if (validate == 0) {
    const address = JSON.parse(atob($('[name="address"]')
      .filter(':checked')
      .attr('data-address')))

    const {
      address_detail,
      address_fname,
      address_id,
      address_lname,
      address_phone,
      district,
      postcode,
      province,
      sub_district,
    } = address
    const addressText = `${sub_district} ${district} ${province} ${postcode}`
    formData.append('fname', address_fname)
    formData.append('lname', address_lname)
    formData.append('phone', address_phone)
    formData.append('address', JSON.stringify([address_detail, addressText]))
    formData.append('statement', $('#statement')[0].files[0])
    formData.append('product', products)
    formData.append('quantity', quantity)
    formData.append('delivery_cost', delivery_cost)
    formData.append('total', total)

    $.ajax({
      url: './order-buy.php',
      type: 'POST',
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
      success: function (response) {
        if (validateErr(response)) {
          createToastMsg($('#order-toast'), 'เกิดข้อผิดพลาด')
        } else {
          const obj = get_response_object(response)
          if (!obj.result) {
            createToastMsg($('#order-toast'), 'ไม่สามารถซื้อได้')
          }
          if (obj.result) {
            const order_id = obj.order_id
            const orderForm = `<form class="d-none" id="order-form" method="post" action="./place_order.php">
            <input type="text" name="order-id" value="${order_id}" >
            <input type="text" name="fname" value="${address_fname}" >
            <input type="text" name="lname" value="${address_lname}" >
            <input type="text" name="phone" value="${address_phone}" >
            <textarea name="address-text">${addressText}</textarea>
            <textarea name="address-detail">${address_detail}</textarea>
            <input type="text" name="total" value="${total}">
            </form>`
            $('body').append(orderForm)
            $('#order-form').submit()
          }
        }
      }
    });
  }
})

$('#address-insert').click(function() {
  const addressForm = [{
      'formtype': 'text',
      'input': $('#address-fname'),
      'msg': 'กรุณาป้อนชื่อ'
    },
    {
      'formtype': 'text',
      'input': $('#address-lname'),
      'msg': 'กรุณาป้อนนามสกุล'
    },
    {
      'formtype': 'text',
      'input': $('#address-phone'),
      'msg': 'กรุณาป้อนเบอร์ติดต่อ'
    },
    {
      'formtype': 'text',
      'input': $('#address-text'),
      'msg': 'กรุณาเลือกที่อยู่'
    },
    {
      'formtype': 'text',
      'input': $('#address-detail'),
      'msg': 'กรุณาป้อนที่อยู่'
    }
  ]

  let emptyCount = 0

  addressForm.forEach((fd) => {
    const {
      input,
      msg
    } = fd
    const v = input.val().trim()
    input.next().remove()
    if (v == '') {
      emptyCount++
      $(input).after(createValidate(msg))
    }
  })

  if (emptyCount == 0) {
    const [subDistrict, district, province, postcode] = $('#address-text').val().split(',')
    const data = {
      'address_fname': $('#address-fname').val(),
      'address_lname': $('#address-lname').val(),
      'address_phone': $('#address-phone').val(),
      'address_detail': $('#address-detail').val(),
      'sub_district': subDistrict,
      'district': district,
      'province': province,
      'postcode': postcode

    }
    $.ajax({
      url: './add_address.php',
      type: 'post',
      data: data,
      success: function(response) {
        if (validateErr(response)) {
          createToastMsg($('#address-toast'), 'เกิดข้อผิดพลาด')
        } else {
          const obj = get_response_object(response)
          if (obj.result) {
            location.reload()
          }
        }
      }
    })
  }
})