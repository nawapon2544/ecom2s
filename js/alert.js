function errMessage(title, msg, footer = '') {
  return Swal.fire({
    icon: 'error',
    title: title,
    text: msg,
    footer: footer
  })
}

function displaySuccess(title, reload = true) {
  Swal.fire({
    position: 'top',
    icon: 'success',
    title: title,
    showConfirmButton: false,
    timer: 1000
  })

  if (reload) {
    setInterval(() => {
      window.location.reload()
    }, 1000)
  }
}

function dialogConfirm(title, text) {
  return Swal.fire({
    title: title,
    text: text,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#009966',
    cancelButtonColor: '#FF0033',
    confirmButtonText: 'ตกลง',
    cancelButtonText: 'ยกเลิก'
  })
}

function createValidate(msg) {
  return `<p class="validate-msg">${msg}</p>`
}

function createToastMsg(toast, text) {
  const Toast = new bootstrap.Toast(toast)
  $('.toast-icon').next().remove()
  $('.toast-icon').after(`<h6 class="fw-bold">${text}</h6>`)
  Toast.show()
}

function createModalMsg(modal, text) {

}

function createSpinner() {
  const spinnerEl =
    `
    <div class="dialog-spinner p-3">
      <div class="text-center">
        <div class="spinner-border spinner-border-sm" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow spinner-grow-sm" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
    `
  $('.dialog-spinner').remove()
  $('body').children(':eq(0)').before(spinnerEl)
}

function removeSpinner(time = 2000) {
  setInterval(() => {
    $('.dialog-spinner').remove()
  }, time)
}