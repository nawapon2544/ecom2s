window.addEventListener('load', () => {
  const ordPrepareItem = $('.ord-prepare-items')
  const screenHeight = screen.height
  $.each(ordPrepareItem, (index, el) => {
    const h = $(el).innerHeight()
    if (h > screenHeight) {
      const addPageCount = (Math.ceil((h - screenHeight) / screenHeight))
      const pageHeight = (addPageCount + 1) * 100
      $(el).css('height', `${pageHeight}vh`)
    }
  })
  orderPrinter()
})

document.getElementById('order-print').addEventListener('click', orderPrinter)
function orderPrinter() {
  window.print()
}