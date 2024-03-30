window.addEventListener('load', () => {
  const href = location.href
  const query_params = new URL(href).searchParams
  const params = query_params.get('p')

  $.each($('.order-target'), (index, el) => {
    if ($(el).attr('href').includes(params)) {
      $(el).addClass('active')
    } else {
      $(el).removeClass('active')
    }
  })
})