$('#defaultEntries').click(function() {
  location.assign(get_page_url_queryParams())
})
$('#entriesRow').change(function() {
  const entries = $(this).val()
  const params = get_query_params()
  if (entries != '') {
    let r = get_page_url_queryParams([{
      'params': 'entries',
      'val': entries
    }])
    location.assign(r)
  }
})