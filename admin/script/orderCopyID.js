$('.copy').click(function() {
  const id = $(this).attr('data-id')
  navigator.clipboard.writeText(id);
  const tooltipEl = $(this).next()
  showTooltip(tooltipEl)
})


function showTooltip(tooltipEl) {
  tooltipEl.text('คัดลอกสำเร็จ')
  tooltipEl.css('visibility', 'visible')
  clearTooltip(tooltipEl)
}


function clearTooltip(tooltipEl) {
  setInterval(() => {
    tooltipEl.css('visibility', 'hidden')
  }, 2000)
}