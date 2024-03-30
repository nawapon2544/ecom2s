function orderStatus() {
  return $('#order-status')
}

orderStatus().val(orderStatus().attr('data-status'))

orderStatus().change(function () {
  const status = $(this).val().trim()
  let r = get_page_url_queryParams()
  if (status != '') {
    r += `&status=${status}`
    location.assign(r)
  }
})

$('#orderTextId').keyup(function (evt) {
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

$('#dateOrderInclude').click(function () {
  const date_start = $('#dateStart').val()
  const date_end = $('#dateEnd').val()
  let query_params = []

  if (date_start != '' && date_end != '') {
    const date_start_stamp = new Date(date_start).valueOf()
    const date_end_stamp = new Date(date_end).valueOf()


    if (date_end_stamp == date_start_stamp) {
      query_params.push(date_start)
    }

    if (date_end_stamp > date_start_stamp) {
      query_params[0] = date_start
      query_params[1] = date_end
    }

    if (date_end_stamp < date_start_stamp) {
      query_params[0] = date_end
      query_params[1] = date_start
    }
  } else if (date_start != '') {
    query_params[0] = date_start
  } else if (date_end != '') {
    query_params[0] = date_end
  }

  const obj_params = query_params.length == 1 ? [{
    'params': 'dt',
    'val': query_params[0]
  }] : [{
    'params': 'date_start',
    'val': query_params[0],

  }, {
    'params': 'date_end',
    'val': query_params[1]
  }]

  if (date_end != '' || date_start != '') {
    let r = get_page_url_queryParams(obj_params)
    const params = get_query_params()
    const entries = params.get('entries') == null ?
      5 : params.get('entries')
    r += `&entries=${entries}`
    location.assign(r)
  }
})
$('#orderTextName').keyup(function (evt) {
  if (evt.keyCode == 13) {
    if ($(this).val().trim() != '') {
      const v = $(this).val().split(' ').filter((t) => t != '').join('-')
      const r = get_page_url_queryParams([{
        'params': 'name',
        'val': v
      }])

      location.assign(r)
    }
  }
})
$('#orderAllEntries').click(function () {
  location.assign(get_page_url_queryParams())
})
$('#order-entries').change(function () {
  const entries = $(this).val()
  const params = get_query_params()
  if (entries != '') {
    let r = get_page_url_queryParams([{
      'params': 'entries',
      'val': entries
    }])
    r += params.get('name') != null ? `&name=${params.get('name')}` : ''
    r += params.get('status') != null ? `&status=${params.get('status')}` : ''
    r += params.get('dt') != null ? `&dt=${params.get('dt')}` : ''
    r += params.get('date_start') != null && params.get('date_end') ?
      `&date_start=${params.get('start')}&date_end=${params.get('date_end')}` :
      ''
    location.assign(r)
  }
})