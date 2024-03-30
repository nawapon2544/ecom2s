function dateYear() {
  return $('#date-year')
}

function dateMonth() {
  return $('#date-month')
}


window.addEventListener('load', () => {
  $('#entriesRow').val($('#entriesRow').attr('data-entries'))
  dateYear().val(dateYear().attr('data-year'))
  const m = dateMonth().attr('data-month')
  const ac = m != '' ? Number.parseInt(m) : ''
  dateMonth().val(ac)
})
$('#date-include-reset').click(function() {
  dateMonth().val('')
  dateYear().val('')
})
$('#date-include').click(function() {
  const date_year = dateYear().val().trim()
  const date_month = dateMonth().val().trim()
  const get_entries = get_query_params().get('entries')
  const entries = get_entries == null ? 5 : get_entries

  let params = [{
    'params': 'entries',
    'val': entries
  }]

  let r = get_page_url_queryParams(params)
  r += date_month != '' ? `&month=${date_month}` : ''
  r += date_year != '' ? `&year=${date_year}` : ''
  location.assign(r)
})

$('#toExcel').click(function() {
  const get_entries = get_query_params().get('entries')
  const entries = get_entries == null ? 5 : get_entries
  const get_page = get_query_params().get('page')
  const page = get_page == null ? 0 : get_page

  const get_month = get_query_params().get('month')
  const month = get_month == null ? '' : get_month

  const get_year = get_query_params().get('year')
  const year = get_year == null ? '' : get_year

  const data = {
    'entries': entries,
    'page': page,
    'month': month,
    'year': year
  }
  $.ajax({
    url: './request/report_to_xlsx.php',
    type: 'post',
    data: data,
    success: function(response) {
      if (validateErr(response)) {
        errMessage('เกิดข้อผิดพลาด', response)
      } else {
        displaySuccess(`สร้างสำเร็จ`, false)
      }
    }
  })
})

$('#toPDF').click(function() {
  const get_entries = get_query_params().get('entries')
  const entries = get_entries == null ? 5 : get_entries
  const get_page = get_query_params().get('page')
  const page = get_page == null ? 0 : get_page

  const get_month = get_query_params().get('month')
  const month = get_month == null ? '' : get_month

  const get_year = get_query_params().get('year')
  const year = get_year == null ? '' : get_year


  const data = {
    'entries': entries,
    'page': page,
    'month': month,
    'year': year
  }
  $.ajax({
    url: './request/report_to_pdf.php',
    type: 'post',
    data: data,
    success: function(response) {
      if (validateErr(response)) {
        errMessage('เกิดข้อผิดพลาด', response)
      } else {
        displaySuccess(`สร้างสำเร็จ`, false)
      }
    }
  })
})