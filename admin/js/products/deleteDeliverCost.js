function deleteDeliveryCost(event) {
  $('#addDeliveryCost').prop('disabled', false)
  const target = $(event.target)
  const tagName = target.prop('tagName')
  const element = tagName == 'I'
    ? target.parent().parent().parent().parent()
    : target.parent().parent().parent()
  element.remove()
}