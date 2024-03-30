function displayStyle(element, display) {
  element.css('display', display)
}

function setPropElement(element, prop, val) {
  element.prop(prop, val)
}

function setStateProp(element, prop, val) {
  element.attr(prop, val)
}

function getStateProp(element, prop) {
  return element.attr(prop)
}
