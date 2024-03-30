$('#product-img').change(function() {
  const files = $(this)[0].files

  let productPreviewsEl = ``
  for (let i = 0; i < files.length; i++) {
    const src = URL.createObjectURL(files[i])
    productPreviewsEl += `<img src="${src}">`
  }
  $('#product-previews').html(productPreviewsEl)
})