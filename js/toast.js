function toastRight(msg) {
  const el = `
    <div id="toast" class="toast position-fixed top-0 start-50 translate-middle-x my-3" data-bs-delay="1200">
      <div class="toast-body text-light text-center">
        <strong class="toast-icon text-primary">
        <i class="fa-solid fa-circle-exclamation"></i>
        </strong>
        <h5 class="text-secondary">เกิดข้อผิดพลาด</h5>
      </div>
    </div>
  `
  $('body').append(el)
  new bootstrap.Toast($('#toast')).show()
  const clear = setInterval(() => {
    $('body').children().filter('#toast').remove()
  }, 5000)

}