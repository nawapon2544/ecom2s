function get_query_params() {
  const url = new URL(location.href)
  const params = url.searchParams
  return params
}

$('#search-product').click(function () {
  const keyword = getKeyword().val().trim()
  searchProduct(keyword)
})
$('#search-product-reset').click(function () {
  const keyword = get_query_params().get('keyword')
  const pty = get_query_params().get('pty')
  const gty = get_query_params().get('gty')
  let r = `./index.php`
  r += keyword != null ? `?keyword=${keyword}` : ''
  r += gty != null ? `?gty=${gty}` : ''
  r += pty != null ? `?pty=${pty}` : ''
  location.assign(r)
})
function getKeyword() {
  return $('#keyword')
}

function searchProduct(keyword) {
  if (keyword != '') {
    location.assign(`./index.php?keyword=${keyword}`)
  }
}

getKeyword().keyup(function(evt) {
  const keyword = $(this).val().trim().replaceAll(' ', '-')
  if (evt.keyCode == 13) {
    searchProduct(keyword)
  }
})
