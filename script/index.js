function productPriceList() {
  return $('#product-price-list')
}


window.addEventListener('load', () => {
  productPriceList().val(productPriceList().attr('data-price'))
})

productPriceList().change(function () {
  const keyword = get_query_params().get('keyword')
  const pty = get_query_params().get('pty')
  const gty = get_query_params().get('gty')
  const p = $(this).val().trim().split('-')
  let r = `./index.php`

  r += keyword != null ? `?keyword=${keyword}` : ''
  r += gty != null ? `?gty=${gty}` : ''
  r += pty != null ? `?pty=${pty}` : ''
  if (p.length == 1) {
    r += `&price=${p[0]}`
  }
  if (p.length == 2) {
    r += `&min_price=${p[0]}&max_price=${p[1]}`
  }
  location.assign(r)
})


$('.buy-product').click(function() {
  const productId = $(this).attr('data-productId')
  const route = `./buy-product.php?id=${productId}&qty=1`
  window.location.assign(route)
})
$('.add-cart').click(function() {
  const product_id = $(this).attr('data-productId')
  const qty = 1
  $.ajax({
    url: './request/fetch_cart_and_remain_product.php',
    type: 'post',
    data: {
      'product_id': atob(product_id)
    },
    success: function(response) {
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
            success: function(response) {
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
})