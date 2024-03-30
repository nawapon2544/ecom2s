productTotalChart()
producTypeTotalChart()
proCagoryTotalChart()

$('#order-year').val($('#order-year').attr('data-year'))
$('#order-month').val($('#order-month').attr('data-month'))
$('#date-filter').click(function () {
  const year = $('#order-year').val().trim()
  const month = $('#order-month').val().trim()
  let route = get_page_url_queryParams()

  route += year != '' ? `&year=${year}` : ''
  route += month != '' ? `&month=${month}` : ''

  if (year != '' || month != '') {
    location.assign(route)
  }
})


function totalTable() {
  return $('.total-table')
}

function toProductTotalTable() {
  return $('.to-product-total-table')
}

function productTypeTable() {
  return $('.product-type-table')
}

function toProductTypeTable() {
  return $('.to-product-type-table')
}
toProductTypeTable().click(function () {
  const target = $(this).attr('data-target')

  $.each(toProductTypeTable(), (index, btn) => {
    if ($(btn).attr('data-target') == target) {
      $(btn).parent().addClass('active')
    } else {
      $(btn).parent().removeClass('active')
    }
  })
  $.each(productTypeTable(), (index, table) => {
    const id = $(table).attr('id')
    if (target == id) {
      $(table).removeClass('d-none')
    } else {
      $(table).addClass('d-none')
    }
  })
})
$('.to-product-total-table').click(function () {
  const target = $(this).attr('data-target').trim().toLowerCase()

  $.each(toProductTotalTable(), (idx, btn) => {
    if (target == $(btn).attr('data-target')) {
      $(btn).parent().addClass('active')
    } else {
      $(btn).parent().removeClass('active')
    }
  })
  $.each(totalTable(), (index, table) => {
    const tableId = $(table).attr('id').trim().toLowerCase()
    if (target == tableId) {
      $(table).removeClass('d-none')
    } else {
      $(table).addClass('d-none')
    }
  })
})



function proCagoryTotalChart() {
  const productCategory = $('#productCategory')
  const obj = JSON.parse(atob(productCategory.attr('data-obj')))
  const label = obj.subject.filter((v, i) => i < 5)
  const total = obj.total.filter((v, i) => i < 5)
  const qty = obj.quantity.filter((v, i) => i < 5)

  new Chart(productCategory, {
    type: 'doughnut',
    data: {
      labels: label,
      datasets: [{
        data: total,
        borderWidth: 1
      }]
    }
  });

  new Chart($('#productCategoryQty'), {
    type: 'pie',
    data: {
      labels: label,
      datasets: [{
        data: qty,
        borderWidth: 1
      }]
    }
  });
}


function producTypeTotalChart() {
  const productTypeTotal = $('#productTypeTotal')
  const obj = JSON.parse(atob(productTypeTotal.attr('data-obj')))
  const label = obj.subject.filter((v, i) => i < 5)
  const total = obj.total.filter((v, i) => i < 5)

  new Chart(productTypeTotal, {
    type: 'doughnut',
    data: {
      labels: label,
      datasets: [{
        label: 'รายได้ตามประเภทสินค้า',
        data: total,
        borderWidth: 1,
        backgroundColor: [
          'rgba(0, 102, 255)',
          '#CC0033',
          '#FFCC99',
          '#00CC99',
          '#FF9933',
        ],
      }],
    }
  });
}



function productTotalChart() {
  const productList = $('#productList')
  const obj = JSON.parse(atob(productList.attr('data-obj')))
  const subject = obj.subject.filter((label, i) => i < 5)
  const qty = obj.quantity.filter((qty, i) => i < 5);
  const total = obj.total.filter((v, i) => i < 5);
  new Chart(productList, {
    type: 'polarArea',
    data: {
      labels: subject,
      datasets: [{
        label: 'รายได้ตามสินค้า',
        data: total,
        borderWidth: 1,
        backgroundColor: [
          'rgba(0, 153, 255,0.5)',
          'rgba(233, 30, 99)',
          'rgba(255, 160, 0)',
          'rgba(77, 182, 172)',
          'rgba(144, 164, 174)',
        ],
      }]
    }
  });
}