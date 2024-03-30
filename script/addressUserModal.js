$('.address-modal').click(function() {
  $('.validate-msg').remove()
  const id = atob($(this).attr('data-id'))
  const address = JSON.parse(atob($(this).attr('data-address')))
  const {
    address_detail,
    address_fname,
    address_id,
    address_lname,
    address_phone,
    district,
    postcode,
    province,
    sub_district,
  } = address
  const addressText = `${sub_district},${district},${province},${postcode}`

  enableAddressTarget('province')
  setStateProp($('#cancel-address'), 'data-before', addressText)
  setStateProp($('#no-address'), 'data-before', addressText)
  setStateProp($('#address-section'), 'data-province', 'true')
  addressTabActive(getProvinceEl(), province)
  if (district != '') {
    setStateProp($('#address-section'), 'data-district', 'true')
    loadDistrict(province, district)
  } else {
    disabledAddressTarget('district')
    setStateProp($('#address-section'), 'data-district', 'false')
  }

  if (sub_district != '') {
    setStateProp($('#address-section'), 'data-subdistrict', 'true')
    loadSubDistrict(district, `${sub_district}-${postcode}`)
  } else {
    disabledAddressTarget('subdistrict')
    setStateProp($('#address-section'), 'data-subdistrict', 'false')
  }


  setStateProp($('#address-submit'), 'data-state', 'edit')
  setStateProp($('#address-submit'), 'data-id', address_id)

  setActiveTargetButton()
  addressTabActive(getProvinceEl(), province)
  $('#address-fname').val(address_fname)
  $('#address-lname').val(address_lname)
  $('#address-phone').val(address_phone)
  $('#address-detail').val(address_detail)
  $('#address-text').val(addressText)
  $('#address-user-modal').modal('show')
})