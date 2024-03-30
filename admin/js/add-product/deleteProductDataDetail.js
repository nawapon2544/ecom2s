function deleteProductDataDetail(event) {
  const tagName = $(event.target).prop('tagName')
  const element = tagName == 'I'
    ? $(event.target).parent().parent().parent().parent()
    : $(event.target).parent().parent().parent()
  element.remove()
}
