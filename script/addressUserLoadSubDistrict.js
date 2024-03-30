function loadSubDistrict(district, val) {
  $.ajax({
    url: './request/fetch_subDistrict.php',
    type: 'post',
    data: {
      'district': district
    },
    success: function (response) {
      if (validateErr(response)) {
        errMessage('', 'เกิดข้อผิดพลาด! ไม่สามารถโหลดข้อมูลตำบลได้')
      } else {
        const obj = get_response_object(response)
        if (obj.result) {
          const sub_district = obj.sub_district
          let subDistrictEl = ``
          sub_district.forEach((d, index) => {
            subDistrictEl += `
            <label for="s-${index}" class="address-label address-label-subDistrict">
              <input type="radio" class="d-none" onchange="setAddress(event)"  name="subdistrict" id="s-${index}" value="${d.sub_district}-${d.postcode}">
              <span>${d.sub_district}</span>
              <span>${d.postcode}</span>
            </label>
            `
          })
          $('#address-subdistrict').html(subDistrictEl)
          toggleAddressTab('address-subdistrict')
          addressTabActive(getSubDistrictEl(), val)
          enableAddressTarget('district')
        }
      }
    }
  })
}