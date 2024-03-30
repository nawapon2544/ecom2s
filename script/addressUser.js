function toggleAddressTab(id) {
  $.each($('.address-tab'), (index, el) => {

    if ($(el).attr('id') == id) {
      $(el).css('display', 'block')
      console.log($(el))
    } else {
      $(el).css('display', 'none')
      console.log('none', $(el))
    }
  })
}

function enableAddressTarget(target) {
  $('.address-user-target')
    .filter(`[data-target=${target}]`)
    .prop('disabled', false)
}
function disabledAddressTarget(target) {
  $('.address-user-target')
    .filter(`[data-target=${target}]`)
    .prop('disabled', true)
}
function getProvinceEl() {
  return $('[name="province"]')
}

function getDistrictEl() {
  return $('[name="district"]')
}

function getAddressSectionEl() {
  return $('#address-section')
}

function getAddressControlEl() {
  return $('#address-control')
}

function getTargetControlEl() {
  return $('#target-control')
}

function getSubDistrictEl() {
  return $('[name="subdistrict"]')
}

function getAddressFilter(el) {
  return $(el).filter(':checked').length > 0 ?
    $(el).filter(':checked').val().trim() : ''
}

function getAddressTextEl() {
  return $('#address-text')
}

$('#address-text').focus(function () {
  displayStyle(getTargetControlEl(), 'block')
  displayStyle(getAddressSectionEl(), 'block')
  displayStyle(getAddressControlEl(), 'flex')
  setActiveTargetButton()
})

$('.address-user-target').click(function() {
  const target = getStateProp($(this), 'data-target')
  const id = `address-${target}`
  getTargetControlEl().attr('data-state', id)
  toggleAddressTab(id)
  activeTabSwitchToggle()
})
$('#cancel-address').click(function() {
  const before = $(this).attr('data-before')
  getAddressTextEl().val(before)
  displayStyle(getAddressSectionEl(), 'none')
  displayStyle(getAddressControlEl(), 'none')
  displayStyle(getTargetControlEl(), 'none')
})

$('#no-address').click(function() {
  const before = $(this).attr('data-before')
  const provinceState = getStateProp(getAddressSectionEl(), 'data-province')
  const districtState = getStateProp(getAddressSectionEl(), 'data-district')
  const subDistrictState = getStateProp(getAddressSectionEl(), 'data-subdistrict')

  const province = provinceState == 'true' ?
    getAddressFilter(getProvinceEl()) : ''

  const district = districtState == 'true' ?
    getAddressFilter(getDistrictEl()) : ''

  const [sub_district, postcode] = districtState == 'true' ?
    getAddressFilter(getSubDistrictEl()).split('-') : ''

  const addressText = [
    sub_district, district, province, postcode
  ].join(',')

  getAddressTextEl().val(addressText)
  displayStyle(getAddressSectionEl(), 'none')
  displayStyle(getAddressControlEl(), 'none')
  displayStyle(getTargetControlEl(), 'none')

})
function setAddress(evt) {
  enableAddressTarget('subdistrict')
  const subDistrictEl = $(evt.target)
  const [sub_district, postcode] = subDistrictEl.val().trim().split('-')

  const province = getAddressFilter(getProvinceEl())
  const district = getAddressFilter(getDistrictEl())
  const addressText = [
    sub_district, district, province, postcode
  ].join(',')

  setStateProp(getAddressSectionEl(), 'data-subdistrict', 'true')
  getAddressTextEl().val(addressText)
  displayStyle(getAddressSectionEl(), 'none')
  displayStyle(getAddressControlEl(), 'none')
  displayStyle(getTargetControlEl(), 'none')
  addressTabActive(getSubDistrictEl(), `${district}-${postcode}`)
}


$('[name="province"]').change(function() {
  setStateProp(getAddressSectionEl(), 'data-province', 'true')
  setStateProp(getAddressSectionEl(), 'data-district', 'false')
  setStateProp(getAddressSectionEl(), 'data-subdistrict', 'false')
  enableAddressTarget('district')
  disabledAddressTarget('subdistrict')
  const province = $(this).val().trim()

  $.ajax({
    url: './request/fetch_district.php',
    type: 'post',
    data: {
      'province': province
    },
    success: function(response) {
      if (validateErr(response)) {
        errMessage('', 'เกิดข้อผิดพลาด! ไม่สามารถโหลดข้อมูลได้')
      } else {
        const obj = get_response_object(response)
        if (obj.result) {
          const district = obj.district
          let districtEl = ``
          district.forEach((d, index) => {
            districtEl += `
             <label for="district-${index}" class="address-label">
                <input type="radio" class="d-none" onchange="changeDistrict(event)" name="district" id="district-${index}" value="${d}">
                <span>${d}</span>
              </label>`
          })
          $('#address-district').html(districtEl)
          toggleAddressTab('address-district')
          addressTabActive(getProvinceEl(), province)
          getTargetControlEl().attr('data-state', 'address-district')
          activeTabSwitchToggle()
        }
      }
    }
  })
})

function addressTabActive(address, val) {
  $.each($(address), (index, el) => {
    if ($(el).val().trim() == val.trim()) {
      $(el).prop('checked', true)
      $(el).parent().addClass('active')

    } else {
      $(el).prop('checked', false)
      $(el).parent().removeClass('active')
    }
  })

}

function setActiveTargetButton() {
  const addressUserTarget = $('.address-user-target')
  const filter = $.map(addressUserTarget, (el, index) => {
    if (!$(el).is(':disabled')) {
      return $(el)
    }
  })
  const last = $(filter)[filter.length - 1]
  const id = $(last).attr('data-target')

  $.each($('.address-user-target'), (index, el) => {
    $(el).removeClass('active')
  })

  getTargetControlEl().attr('data-state', `address-${id}`)
  activeTabSwitchToggle()
}

function activeTabSwitchToggle() {
  const state = getStateProp(getTargetControlEl(), 'data-state')
  $.each($('.address-user-target'), (index, el) => {
    const target = `address-${$(el).attr('data-target')}`
    if (target == state) {
      $(el).addClass('active')
    } else {
      $(el).removeClass('active')
    }
  })

}
