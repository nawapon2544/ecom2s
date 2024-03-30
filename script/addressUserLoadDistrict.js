function loadDistrict(province, val) {
  $.ajax({
    async: true,
    url: './request/fetch_district.php',
    type: 'post',
    data: {
      'province': province
    },
    success: function (response) {
      if (validateErr(response)) {
        errMessage('', 'เกิดข้อผิดพลาด! ไม่สามารถโหลดข้อมูลอำเภอได้')
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
          addressTabActive(getDistrictEl(), val)
          enableAddressTarget('subdistrict')
        }
      }
    }
  })
}