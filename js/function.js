function validateEmail(email) {
  return email.includes('@') && email.includes('.')
}

function validatePassword(pass) {
  let upper = 0
  let lower = 0
  let num = 0
  let thaiLang = 0
  let alert = ''
  let validate = true

  if (pass.length < 8) {
    validate = false
    alert = 'รหัสผ่านต้องมีอักขระอย่างน้อย 8 ตัว'
  } else {
    for (let i = 0; i < pass.length; i++) {
      const text = pass[i]
      const char = /[a-zA-Z]/.test(text)
      const n = /\d/.test(text)
      const thai_letter = /[ก-ฮะ-์]/.test(text)
      if (char) {
        if (text.toUpperCase() == text) {
          console.log('A')
          upper++
        }
        if (text.toUpperCase() != text) {
          console.log('a')
          lower++
        }
      }
      if (n) {
        num++
      }
      if (thai_letter) {
        thaiLang++
      }
    }
    if (thaiLang > 0) {
      validate = false
      alert = 'รหัสผ่านต้องใช้เป็นภาษาอังกฤษเท่านั้น'
    } else {
      if (upper < 1 || lower < 1 || num < 1) {
        validate = false
        alert = 'รหัสผ่านต้องประกอบ อักขระตัวพิมพ์เล็ก พิมพ์ใหญ่'
      }
    }
  }
  return { validate, alert }
}

function get_response_object(response) {
  return JSON.parse(response.substring(response.indexOf('{')))
}

function validateErr(response) {
  const msg = response.toLowerCase()
  const err_list = [
    'Uncaught',
    'error',
    'Warning',
    '"result":false'
  ]
  let errCount = 0
  err_list.forEach((err) => {

    if (msg.includes(err.toLowerCase())) {
      errCount++
    }
  })
  return errCount == 0 ? false : true
}
function addCart(product_id, qty, type, qtyEl, total = 0) {
  $.ajax({
    url: './product-add-cart.php',
    type: 'post',
    data: {
      'product_id': atob(product_id),
      'qty': qty,
      'type': type,
    },
    success: function (res) {
      const addCartToast = $('#addcart-toast')
      if (validateErr(res)) {
        createToastMsg(addCartToast, 'เกิดข้อผิดพลาด')
      } else {
        const index = res.indexOf('{')
        if (index >= 0) {
          const obj = get_response_object(res)
          if (obj.signin == false) {
            window.location.assign('./signin.php')
          }

          if (obj.add_cart == false) {
            createToastMsg(addCartToast, 'เกิดข้อผิดพลาด')
          } else {
            if (type == 'set') {
              const total_format = new Intl.NumberFormat().format(total)
              qtyEl.parent().parent().next().children().val(total_format.includes('.') ? total_format : total_format + '.00')
              qtyEl.val(qty)
            }
            createToastMsg(addCartToast, 'เพิ่มลงตะกร้าสำเร็จ')
          }
        }
      }
    }
  })

}

function fetch_cart_and_remain_product(productId, qty, type, qtyEl, total = 0) {
  $.ajax({
    url: './request/fetch_cart_and_remain_product.php',
    type: 'post',
    data: {
      'product_id': atob(productId),
    },
    success: function (response) {
      if (validateErr(response)) {
        createToastMsg($('#addcart-toast'), 'เกิดข้อผิดพลาดไม่สามารถโหลดข้อมูลได้')
      } else {
        const obj = get_response_object(response)
        if (!obj.result) {
          createToastMsg($('#addcart-toast'), 'เกิดข้อผิดพลาดไม่สามารถโหลดข้อมูลได้')
        } else {
          const { remain } = obj
          const cart_count = type == 'set' ? obj.cart_count : obj.cart_count + 1
          if ((cart_count) <= remain) {
            addCart(productId, qty, type, qtyEl, total)
          } else {
            new bootstrap.Modal($('#cart-modal')).show()
          }
        }
      }
    }
  })

}