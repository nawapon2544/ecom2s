function setFormatNumber(num) {
  const number_format = new Intl.NumberFormat().format(num)
  return number_format.includes('.') ? number_format : number_format + '.00'
}