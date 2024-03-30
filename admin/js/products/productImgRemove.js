$('.product-img-remove').click(function() {

  const imgRemove = $(this).parent()
  const productBeforeImg = $('#product-before-img')
  const beforeImg = productBeforeImg.attr('data-img').split(',')
  const img = imgRemove.attr('data-img')
  const removeImg = productBeforeImg.attr('data-remove-img').trim()
  let beforeEditImg = removeImg == '' ? [] : removeImg.split(',')
  const afterImg = beforeImg.filter((e) => e != img)

  beforeEditImg.push(img)
  productBeforeImg.attr('data-remove-img', beforeEditImg.length > 0 ? beforeEditImg.join(',') : '')
  productBeforeImg.attr('data-img', afterImg.length > 0 ? afterImg.join(',') : '')
  imgRemove.remove()
})