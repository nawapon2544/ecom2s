function sidebarEl() {
  return document.getElementById('sidebar')
}


sidebarEl().addEventListener('mouseover', () => {
  sidebarEl().setAttribute('data-show', 'true')
})
sidebarEl().addEventListener('mouseout', () => {
  sidebarEl().setAttribute('data-show', 'false')
})


document.querySelector('body').addEventListener('click', (event) => {
  setSidebar(event)
})

function setSidebar(event) {
  const className = $(event.target).prop('class')
  const show = sidebarEl().getAttribute('data-show')

  if (className.includes('menu-toggle')) {
    sidebarEl().setAttribute('data-show', 'true')
    sidebarEl().classList.toggle('active')
  } else {
    if (show == 'false') {
      sidebarEl().classList.remove('active')
    }
  }
}

