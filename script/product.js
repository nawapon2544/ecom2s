$('#buy-product').click(function () {
  const login = atob($(this).attr('data-login'))
  const productId = $(this).attr('data-productId')
  const qty = Number.parseInt($('#cart-qty').val())
  if (login == 'true') {
    const route = `./buy-product.php?id=${productId}&qty=${qty}`
    window.location.assign(route)
  }
  if (login == 'false') {
    location.assign(`./signin.php?p=${productId}`)
  }

})
$('.qty-btn').click(function () {
  const elementId = $(this).attr('id')
  const id = elementId.substring(0, elementId.indexOf('-'))
  const qtyEl = $('#cart-qty')
  const max = Number.parseInt(qtyEl.attr('max'))
  let qty = Number.parseInt(qtyEl.val())
  if (id == 'reduce') {
    if (qty >= 2) {
      qty--
    }
  }
  if (id == 'add') {
    qty++
  }

  qtyEl.val(qty)
})

$('#add-cart').click(function () {
  const qty = Number.parseInt($('#cart-qty').val())
  const login = atob($(this).attr('data-login'))
  const product_id = $(this).attr('data-productId')
  if (login == 'false') {
    location.assign(`./signin.php?p=${product_id}`)
  }
  if (login == 'true') {
    $.ajax({
      url: './request/fetch_cart_and_remain_product.php',
      type: 'post',
      data: {
        'product_id': atob(product_id)
      },
      success: function (response) {
        console.log(response)
        const cartToast = $('#addcart-toast')
        if (validateErr(response)) {
          createToastMsg(cartToast, 'เกิดข้อผิดพลาด')
        } else {
          const obj = get_response_object(response)
          const remain = obj.remain
          const cart_qty = qty + obj.cart_count

          if (cart_qty > remain) {
            $('#cart-limit-modal').modal('show')
          }
          if (cart_qty <= remain) {
            $.ajax({
              url: './query/product_add_cart.php',
              type: 'post',
              data: {
                'product_id': product_id,
                'qty': qty,
                'type': 'add'
              },
              success: function (response) {
                if (validateErr(response)) {
                  createToastMsg(cartToast, 'เกิดข้อผิดพลาด')
                } else {
                  const obj = get_response_object(response)
                  createToastMsg(cartToast, 'เพิ่มลงรถเข็นเรียบนร้อย')
                }
              }
            })
          }
        }
      }
    })
  }
 

})

window.addEventListener('load', () => {
  $.ajax({
    url: './query/update_product_view.php',
    type: 'post',
    data: {
      'product_id': atob(get_query_params().get('id'))
    }
  })
})