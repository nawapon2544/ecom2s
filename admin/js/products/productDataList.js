function nameProductCategory() {
  return $('[name="product-category"]')
}

function nameProductType() {
  return $('[name="product-type"]')
}

function inputProductType() {
  return $('#inputProductType')

}

function inputProductCategory() {
  return $('#inputProductCategory')
}


function listProductCategory() {
  return $('#list-productCategory')
}

function listProductType() {
  return $('#list-productType')
}

function setProductType(evt) {
  const type = $(evt.target).val().trim()
  inputProductType().val(type)
  inputProductType().attr('data-focus', 'false')
  listProductType().css('display', 'none')
  listProductType().attr('data-state', 'false')
  inputProductType().attr('data-state', 'false')
}

function setProductCategory(evt) {
  const category = $(evt.target).val().trim()
  inputProductCategory().val(category)
  inputProductCategory().attr('data-focus', 'false')
  listProductCategory().css('display', 'none')
  listProductCategory().attr('data-state', 'false')
  inputProductCategory().attr('data-state', 'false')
}

inputProductType().focus(function () {
  listProductType().css('display', 'block')
  listProductType().attr('data-state', 'true')
  inputProductType().attr('data-state', 'true')
  inputProductType().attr('data-focus', 'true')
})

inputProductCategory().focus(function () {
  listProductCategory().css('display', 'block')
  listProductCategory().attr('data-state', 'true')
  inputProductCategory().attr('data-state', 'true')
  inputProductCategory().attr('data-focus', 'true')
})


window.addEventListener('click', () => {
  const inputTypeState = inputProductType().attr('data-state')
  const inputTypeFocus = inputProductType().attr('data-focus')
  const listTypeState = listProductType().attr('data-state')

  const inputCtyState = inputProductCategory().attr('data-state')
  const inputCtyFocus = inputProductCategory().attr('data-focus')
  const listCtyState = listProductCategory().attr('data-state')
  setStateDataList(inputProductCategory(), listProductCategory(), inputCtyState, inputCtyFocus, listCtyState)
  setStateDataList(inputProductType(), listProductType(), inputTypeState, inputTypeFocus, listTypeState)

})

function setStateDataList(inputEl, listEl, inputState, inputFocus, listState) {
  if (inputState == 'false') {
    inputEl.blur()
  }

  if (listState == 'false') {
    listEl.css('display', 'none')
  }
}


nameProductType().change(function (event) {
  setProductType(event)
})

nameProductCategory().change(function (event) {
  setProductCategory(event)
})

inputProductType().keyup(function () {
  const val = $(this).val().trim()
  $.ajax({
    url: './fetch/fetch_productType.php',
    type: 'post',
    data: {
      'value': val
    },
    success(response) {
      if (validateErr(response)) {
        errMessage('เกิดข้อผิดพลาด', response, footer = '')
      } else {
        const obj = get_response_object(response)
        if (obj.result) {
          const product_type = obj.product_type

          if (product_type.length == 0) {
            listProductType().css('display', 'none')
          }
          if (product_type.length > 0) {
            listProductType().css('display', 'block')
            let productTypeEl = ``
            product_type.forEach((t, index) => {
              productTypeEl += `
            <label for="p-type-${index}" class="list-data-label">
              <input type="radio" onchange="setProductType(event)" class="list-data-check" name="product-type" id="p-type-${index}" value="${t}">
              <span>
                ${t}
              </span>
            </label>`
            })
            listProductType().html(productTypeEl)
          }
        }
      }
    }
  })
})


inputProductCategory().keyup(function () {
  const val = $(this).val().trim()
  $.ajax({
    url: './fetch/fetch_productCategory.php',
    type: 'post',
    data: {
      'value': val
    },
    success(response) {
      if (validateErr(response)) {
        errMessage('เกิดข้อผิดพลาด', response, footer = '')
      } else {
        const obj = get_response_object(response)
        if (obj.result) {
          const product_category = obj.product_category

          if (product_category.length == 0) {
            listProductCategory().css('display', 'none')
          }
          if (product_category.length > 0) {
            listProductCategory().css('display', 'block')
            let productCtyEl = ``
            product_category.forEach((cty, index) => {
              productCtyEl += `
          <label for="p-cty-${index}" class="list-data-label">
            <input type="radio" onchange="setProductCategory(event)" class="list-data-check" name="product-type" id="p-cty-${index}" value="${cty}">
            <span>
              ${cty}
            </span>
          </label>`
            })
            listProductCategory().html(productCtyEl)
          }

        }
      }
    }
  })
})

inputProductType().mouseover(function () {
  inputProductType().attr('data-state', 'true')
  listProductType().attr('data-state', 'true')
})

inputProductType().mouseout(function () {
  inputProductType().attr('data-state', 'false')
  listProductType().attr('data-state', 'false')
})


listProductType().mouseover(function () {
  listProductType().attr('data-state', 'true')
})

listProductType().mouseout(function () {
  listProductType().attr('data-state', 'false')
})


inputProductCategory().mouseover(function () {
  inputProductCategory().attr('data-state', 'true')
  listProductCategory().attr('data-state', 'true')
})

inputProductCategory().mouseout(function () {
  inputProductCategory().attr('data-state', 'false')
  listProductCategory().attr('data-state', 'false')
})


listProductCategory().mouseover(function () {
  listProductCategory().attr('data-state', 'true')
})

listProductCategory().mouseout(function () {
  listProductCategory().attr('data-state', 'false')
})