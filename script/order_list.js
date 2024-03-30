function createValidate(msg) {
  return `<h6 class="validate-msg">${msg}</h6>`
}
$('#order-buy').click(function () {
  let emptyCount = 0
  const validateAddress = $('[name="address"]').filter(':checked').length
  if (validateAddress == 0) {
    emptyCount++
    new bootstrap.Modal($('#order-modal')).show()
  }
  const statementEl = $('#statement')
  statementEl.parent().parent().children(':eq(1)').remove()
  if (statementEl[0].files.length == 0) {
    emptyCount++
    statementEl.parent().parent().children(':eq(0)').after(createValidate('กรุณาอัพโหลดการชำระเงิน'))
  }

  if (emptyCount == 0) {
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


    const addressText = `${sub_district} ${district} ${province} ${postcode}`
    const formData = new FormData()
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