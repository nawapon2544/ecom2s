$('#orderTextId').keyup(function(evt) {
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


$('.product-delete').click(function() {
  const data = {
    'product_id': $(this).attr('data-productId'),
    'img': $(this).attr('data-img')
  }
  dialogConfirm('ลบข้อมูลสินค้า', 'คุณต้องการลบข้อมูลสินค้านี้ ใช่หรือไม่')
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: './product-delete.php',
          type: 'post',
          data: data,
          success: function(res) {
            if (res.includes('Failed') || res.includes('Failed')) {
              errMessage('ลบข้อมูลสินค้าล้มเหลว', res)
            } else {
              const s = res.lastIndexOf('{')
              if (s >= 0) {
                const obj = JSON.parse(res.substring(s))
                const result = obj.result
                if (!result) {
                  errMessage('ลบข้อมูลสินค้าล้มเหลว', obj.msg)
                }

                if (result) {
                  displaySuccess('ลบข้อมูลสินค้าเรียบร้อย', true)
                }
              }
            }
          }
        })
      }
    })
})