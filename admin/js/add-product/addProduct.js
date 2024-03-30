$('#add-product').click(function () {
  let emptyCount = 0
  productForm.forEach((fd) => {
    const {
      msg,
      validate,
      formtype,
      input
    } = fd

    if (formtype == 'text') {
      const v = input.val().trim()
      if (v == '') {
        emptyCount++
        formValidate(true, validate, msg)
      } else {
        formValidate(false, validate, '')
      }
    }

    if (formtype == 'number') {
      const n = input.val()
      if (n != '') {
        const is_number = inputTypeNumber(input, 'int')
        if (is_number) {
          formValidate(false, validate, '')
        } else {
          emptyCount++
          formValidate(true, validate, 'ป้อนข้อมูลเป็นตัวเลข')
        }
      } else {
        emptyCount++
        formValidate(true, validate, msg)
      }
    }
    if (formtype == 'file') {
      const file = input[0].files.length
      if (file == 0) {
        emptyCount++
        formValidate(true, validate, msg)
      } else {
        formValidate(false, validate, '')
      }
    }

  })

  const deliveryCostItemsList = $('.delivery-cost-items')
  let deliveryCostItemsEmptyList = []
  let deliveryCostItemsEmpty = 0

  if (deliveryCostItemsList.length == 0) {
    errMessage('ค่าจัดส่ง', 'โปรดป้อนค่าขนส่ง')
    deliveryCostItemsEmpty++
  } else {
    $.each(deliveryCostItemsList, (index, el) => {
      const valid = $(el).attr('data-validate')
      if (valid == 'false') {
        deliveryCostItemsEmpty++
      }
    })
  }

  if (deliveryCostItemsEmpty > 0) {
    emptyCount++
    errMessage('ค่าจัดส่ง', 'โปรดป้อนข้อมูลให้ครบ')
  }
  const minDeliveryCost = $.map($('[name="min-delivery-cost"]'),
    (element, index) => $(element).val())

  const maxDeliveryCost = $.map($('[name="max-delivery-cost"]'),
    (element, index) => $(element).val())

  const singleDeliveryCost = $.map($('[name="single-delivery-cost"]'),
    (element, index) => $(element).val())

  const singleDeliveryCostText = $.map($('[name="single-delivery-cost-text"]'),
    (element, index) => $(element).val())
  const rangeDeliveryCostText = $.map($('[name="range-delivery-cost-text"]'),
    (element, index) => $(element).val())

  let delivery_cost = []
  const delivery_cost_single = []
  const delivery_cost_range = []

  for (let i = 0; i < rangeDeliveryCostText.length; i++) {
    const min = Number.parseInt(minDeliveryCost[i])
    const max = Number.parseInt(maxDeliveryCost[i])
    const cost = Number.parseFloat(rangeDeliveryCostText[i])
    for (let p = min; p <= max; p++) {
      delivery_cost_range.push({
        'count': p,
        'delivery_cost': cost
      })
    }
  }

  for (let i = 0; i < singleDeliveryCost.length; i++) {
    const single = Number.parseInt(singleDeliveryCost[i])
    const cost = Number.parseFloat(singleDeliveryCostText[i])
    delivery_cost_single.push({
      'count': single,
      'delivery_cost': cost
    })
  }
  delivery_cost.push(...delivery_cost_range)
  delivery_cost.push(...delivery_cost_single)
  if (emptyCount == 0) {

    const productKeywordText = $.map($('[name="product-keyword-text"]'),
      (element, index) => $(element).val())

    const productKeywordName = $.map($('[name="product-keyword-name"]'),
      (element, index) => $(element).val())

    const productDetailProp = $.map($('[name="product-detail-prop"]'),
      (element, index) => $(element).val().trim())

    const productDetailText = $.map($('[name="product-detail-text"]'),
      (element, index) => $(element).val().trim())

    const productDetailUnit = $.map($('[name="product-detail-unit"]'),
      (element, index) => $(element).val().trim())
    let productDetailObj = []
    for (let i = 0; i < productDetailProp.length; i++) {
      const prop = productDetailProp[i]
      const value = productDetailText[i]
      const unit = productDetailUnit[i]
      if (prop != '' && value != '') {
        productDetailObj.push({
          'prop_detail': prop,
          'detail_value': value,
          'unit': unit
        })
      }

    }

    let productKeyword = []

    for (let i = 0; i < productKeywordText.length; i++) {
      if (productKeywordText[i] != '') {
        productKeyword.push({
          'keyword': productKeywordText[i],
          'name': productKeywordName[i]
        })
      }
    }

    let dimension = {}
    const productWidth = $('#product-width').val().trim()
    const productWidthUnit = $('#product-width-unit').val().trim()
    const productDepth = $('#product-depth').val().trim()
    const productDepthUnit = $('#product-depth-unit').val().trim()
    const productHeight = $('#product-height').val().trim()
    const productHeightUnit = $('#product-height-unit').val().trim()

    if (productWidth != '') {
      Object.assign(dimension, {
        'width': {
          'size': productWidth,
          'unit': productWidthUnit
        }
      })
    }

    if (productHeight != '') {
      Object.assign(dimension, {
        'height': {
          'size': productHeight,
          'unit': productHeightUnit
        }
      })
    }
    if (productDepth != '') {
      Object.assign(dimension, {
        'depth': {
          'size': productDepth,
          'unit': productDepthUnit
        }
      })
    }
    const formData = new FormData()
    formData.append('product_name', $('#productName').val())
    formData.append('product_cost_price', $('#productCostPrice').val())
    formData.append('product_price', $('#productPrice').val())
    formData.append('product_real_price', $('#productRealPrice').val())
    formData.append('product_remain', $('#productRemain').val())
    formData.append('product_category', $('#inputProductCategory').val())
    formData.append('product_type', $('#inputProductType').val())
    formData.append('product_detail', $('#product-detail').val())
    formData.append('product_data', JSON.stringify(productDetailObj))
    formData.append('product_dimension', JSON.stringify(dimension))
    formData.append('product_keyword', JSON.stringify(productKeyword))
    formData.append('product_delivery_cost', JSON.stringify(delivery_cost))
    const files = $('#product-img')[0].files

    for (let i = 0; i < files.length; i++) {
      formData.append('product_img[]', files[i])
    }


    $.ajax({
      url: './add-product-query.php',
      'type': 'post',
      data: formData,
      processData: false,
      contentType: false,
      enctype: 'multipart/form-data',
      success: function (res) {
        console.log(res)
        const s = res.indexOf('{')
        const obj = JSON.parse(res.substring(s))
        const result = obj.result
        if (!result) {
          const msg = obj.msg
          errMessage('เพิ่มข้อมูลสินค้า', msg, '')
        }

        if (result) {
          displaySuccess('บันทึกข้อมูลเรียบร้อย', true)
        }
      },
    })
  }

})