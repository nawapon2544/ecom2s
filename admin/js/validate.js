function formValidate(isValue, validate, msg) {
  if (isValue) {
    validate.text(msg)
    validate.css('display', 'block')
  } else {
    validate.text('')
    validate.css('display', 'none')
  }
}

function inputTypeNumber(input, type) {
  let is_number = false
  const num = type == 'int'
    ? Number.parseInt(input.val())
    : Number.parseFloat(input.val())
  if (isNaN(num)) {
    console.log('res')
    $(input).val('')
  }

  if (!isNaN(num)) {
    is_number = true
  }

  return is_number
}

function inputValidateEmpty(empty, input) {
  if (empty) {
    input.addClass('text-err-alert')
  }
  if (!empty) {
    input.removeClass('text-err-alert')
  }
}