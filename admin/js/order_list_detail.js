function orderStatus() {
  return $('#order-status')
}

function confirmEditOrderStatus() {
  return $('#confirm-edit-order-status')
}

function cancelEditOrderStatus() {
  return $('#cancel-edit-order-status')
}

function confirmEditpayStatus() {
  return $('#confirm-edit-paystatus')
}

function cancelEditpayStatus() {
  return $('#cancel-edit-paystatus')
}

function payStatus() {
  return $('#payStatus')
}
orderStatus().val(orderStatus().attr('data-status'))
payStatus().val(payStatus().attr('data-status'))

$('#edit-paystatus').click(function () {
  payStatus().prop('disabled', false)
  cancelEditpayStatus().removeClass('d-none')
  confirmEditpayStatus().removeClass('d-none')
})

cancelEditpayStatus().click(function () {
  payStatus().val(payStatus().attr('data-status'))
  payStatus().prop('disabled', true)
  cancelEditpayStatus().addClass('d-none')
  confirmEditpayStatus().addClass('d-none')
})


confirmEditpayStatus().click(function () {
  const status = payStatus().val().trim()
  const order_id = $(this).attr('data-id')
  const data = {
    'status': status,
    'order_id': order_id
  }
  if (status != '') {
    $.ajax({
      url: './query/update_pay_status.php',
      type: 'post',
      data: data,
      success: function (response) {
        if (validateErr(response)) {
          errMessage('', response)
        } else {
          const result = get_response_object(response).result
          if (result) {
            displaySuccess('อัพเดตสำเร็จ')
          }
        }
      }

    })
  }
})

$('#edit-order-status').click(function () {
  orderStatus().prop('disabled', false)
  cancelEditOrderStatus().removeClass('d-none')
  confirmEditOrderStatus().removeClass('d-none')
})


function closeOrderEdit(status) {
  orderStatus().val(status)
  orderStatus().prop('disabled', true)
  cancelEditOrderStatus().addClass('d-none')
  confirmEditOrderStatus().addClass('d-none')
}
cancelEditOrderStatus().click(function () {
  closeOrderEdit(orderStatus().attr('data-status'))
})

confirmEditOrderStatus().click(function () {
  const status = orderStatus().val().trim()
  const order_id = $(this).attr('data-id')
  const data = {
    'status': status,
    'order_id': order_id
  }
  if (status != '') {
    $.ajax({
      url: './query/update_order_status.php',
      type: 'post',
      data: data,
      success: function (response) {
        if (validateErr(response)) {
          errMessage('', response)
        } else {
          const result = get_response_object(response).result
          if (result) {
            displaySuccess('อัพเดตสำเร็จ')
          }
        }
      }

    })
  }
})