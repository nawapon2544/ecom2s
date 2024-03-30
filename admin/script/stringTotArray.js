function stringToArray(string,op) {
  console.log(string)
  return string.split(op)
    .filter((d, index) => index < 5)
}

function mapNumber(arr) {
  return arr.map((n) => Number.parseFloat(n))
}