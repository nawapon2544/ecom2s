function get_query_params() {
  const url = new URL(location.href)
  const params = url.searchParams
  return params
}

function get_page_url_queryParams(query_params = []) {
  const pathname = location.pathname
  const params = get_query_params()
  const get_p = params.get('p') || 'dashboard'
  let route = `${pathname}?p=${get_p}`

  query_params.forEach((p) => {
    route += `&${p.params}=${p.val}`
  })
  return route
}