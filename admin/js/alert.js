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

function prepareOrderConfirm(text, textId) {
  return Swal.fire({
    text: text,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#009966',
    cancelButtonColor: '#FF0033',
    confirmButtonText: 'ตกลง',
    cancelButtonText: 'ยกเลิก',
    footer: textId,

  })
}