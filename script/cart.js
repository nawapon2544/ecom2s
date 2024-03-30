
$('#order-product').click(function () {
  const cartOrder = $.map($('[name="cart-order"]').filter(':checked'),
    (element, index) => {
      const qtyEl = $(element).parent().
        parent().parent().
        children(':eq(1)').
        children().children(':eq(2)').
        children().children(':eq(1)')
      const qty = qtyEl.val()
      const obj = JSON.parse(atob($(element).val()))
      return {
        'cart_id': obj.cart_id,
        'product_id': obj.product_id,
        'qty': qty
      }
    }
  )

  $('body').children().filter((index, element) => {
    if ($(element).prop('tagName') == 'FORM') {
      $(element).remove()
    }
  })
  if (cartOrder.length > 0) {
    const input = `<textarea rows="4" name="order" style="display:none">${JSON.stringify(cartOrder)}</textarea>`
    const form = `<form method="post" id="order-form" action="./order_list.php">${input}</form>`
    $('body').append(form)
    $('#order-form').submit()
  }
})
$('.delete-cart').click(function () {
  const btn = $(this)
  $.ajax({
    url: './delete_cart.php',
    type: 'post',
    data: {
      'cart_id': atob($(this).attr('data-cartId'))
    },
    success: function (response) {
      if (validateErr(response)) {
        createToastMsg($('#addcart-toast'), 'เกิดข้อผิดพลาด')
      } else {
        const obj = get_response_object(response)
        if (obj.result) {
          btn.parent().parent().parent().parent().remove()
        } else {
          createToastMsg($('#addcart-toast'), 'ไม่สามารถลบได้')
        }
      }
    }
  })
})

$('.btn-qty').click(function () {
  const row = $(this).parent().parent()
  const totalCol = row.next().children()
  const product_id = $(this).attr('data-productId')
  const target = $(this).attr('data-target')
  const price = atob($(this).attr('data-price'))
  const qtyEl = target == 'add-qty' ? $(this).prev() : $(this).next()
  let qty = Number.parseInt(qtyEl.val())

  if (target == 'reduce-qty') {
    qtyEl.next().next().remove()
    if (qty > 1) {
      qty--
    }
  }
  if (target == 'add-qty') {
    $(this).next().remove()
    qty++
  }
  $.ajax({
    url: './request/fetch_cart_and_remain_product.php',
    type: 'post',
    data: {
      'product_id': atob(product_id)
    },
    success: function (response) {
      const cartToast = $('#addcart-toast')
      if (validateErr(response)) {
        createToastMsg(cartToast, 'เกิดข้อผิดพลาด')
      } else {
        const obj = get_response_object(response)
        const remain = obj.remain
        const cart_qty = qty + obj.cart_count

        if (qty > remain) {
          $('#cart-limit-modal').modal('show')
        }
        if (qty <= remain) {
          $.ajax({
            url: './query/product_add_cart.php',
            type: 'post',
            data: {
              'product_id': product_id,
              'qty': qty,
              'type': 'update'
            },
            success: function (response) {
              if (validateErr(response)) {
                createToastMsg(cartToast, 'เกิดข้อผิดพลาด')
              } else {
                const obj = get_response_object(response)
                let total = new Intl.NumberFormat().format(price * qty)
                const total_format = total += total.includes('.00') ? '' : '.00'
                qtyEl.val(qty)
                totalCol.val(total_format)
              }
            }
          })
        }
      }
    }
  })
})

$('#select-orders').click(function() {
  $('[name="cart-order"]').prop('checked', true)
})

$('#delete-orders').click(function() {
  const orderDelete = $.map($('[name="cart-order"]'), (el) => {
    if ($(el).is(':checked')) {
      return `'${JSON.parse(atob($(el).val())).cart_id}'`
    }
  })

  if (orderDelete.length > 0) {
    $.ajax({
      url: './delete_cart_select.php',
      type: 'post',
      data: {
        'cart_id': orderDelete.join(',')
      },
      success: function(response) {
        console.log(response)
        if (validateErr(response)) {
          createToastMsg($('#cart-toast'), 'เกิดข้อผิดพลาด')
        } else {
          const obj = get_response_object(response)
          if (!obj.result) {
            createToastMsg($('#cart-toast'), 'ไม่สามารถลบได้')
          }
          if (obj.result) {
            location.reload()
          }
        }
      }
    })
  }
})