let isDeloveryCost = true
let deliveryCostGlobal = []
let deliveryCost = []
let m = 0


$('#addDeliveryCost').click(function () {
  const deliveryCostElCount = $('.delivery-cost-items').length
  const deliveryCostId = deliveryCostElCount + 1
  const deliveryCostPattern = $('#deliveryCostPattern').val()
  const deliveryCostCount = Number.parseInt($('#delivery-cost-count').val())
  let productDeliveryCostEl = ``
  for (let i = 0; i < deliveryCostCount; i++) {
    const deleteDeliveryCostEl = `
        <div class="col-xxl-6 col-xl-4 col-lg-2 col-md-12 col-sm-12 col-xs-12">
          <div class="my-1">
          <button class="btn btn-primary" onclick="addDeliveryCost(event)">
           ตกลง
          </button>
          <button class="btn btn-light text-primary" style="display:none;" onclick="updateDeliveryCost(event)">
            แก้ไข
          </button>
          <button class="btn btn-light"  onclick="deleteDeliveryCost(event)">
            <i class="fa-solid fa-trash-can"></i>
          </button>
          </div>
        </div>
  `
    if (deliveryCostPattern == 'single') {
      productDeliveryCostEl +=
        `
      <div class="row p-1 m-1 delivery-cost-items" id="delivery-cost-${deliveryCostId}" data-pattern="single"  data-cost="" data-validate="false">
        <div class="col-xxl-6 col-xl-8 col-lg-10 col-md-12 col-sm-12 col-xs-12">
            <div class="input-group my-1">
              <span class="fw-bold input-group-text text-secondary">จำนวน</span>
              <input type="number" data-pattern="single" data-validate="true"  class="form-control" name="single-delivery-cost">
              <span class="fw-bold input-group-text text-secondary" >ค่าขนส่ง</span>
              <input type="number" class="form-control" name="single-delivery-cost-text">
            </div>
            <p class="validate-text"></p>
        </div>
        ${deleteDeliveryCostEl}
      </div>
    `
    }
    if (deliveryCostPattern == 'range') {
      productDeliveryCostEl +=
        `
        <div class="row p-1 m-1 delivery-cost-items" id="delivery-cost-${deliveryCostId}"  data-pattern="range" data-cost="" data-validate="false">
          <div class="col-xxl-6 col-xl-8 col-lg-10 col-md-12 col-sm-12 col-xs-12">
            <div class="input-group my-1">
                <input type="number" data-pattern="range" data-validate="true" name="min-delivery-cost" class="form-control" placeholder="เริ่มต้น">
                <span class="fw-bold input-group-text text-secondary">ถึง</span>
                <input type="number" data-pattern="range" data-validate="true" name="max-delivery-cost" class="form-control" placeholder="จำนวนสูงสุด">
                <span class="fw-bold input-group-text text-secondary">ค่าขนส่ง</span>
                <input type="number" name="range-delivery-cost-text" class="form-control">
            </div>
            <p class="validate-text" id="validate-product-name"></p>
          </div>
          ${deleteDeliveryCostEl}
        </div>
    `
    }
  }
  $(this).prop('disabled', true)
  $('#product-delivery-cost').append(productDeliveryCostEl)
})

function updateDeliveryCost(event) {
  const element = $(event.target)
  const elState = $(event.target).parent().parent().parent()
  const pattern = elState.attr('data-pattern')
  const costEl = elState.children(':eq(0)').children(':eq(0)')
  elState.attr('data-validate', 'false')
  elState.attr('data-cost', '')
  element.css('display', 'none')
  element.prev().css('display', 'inline')


  if (pattern == 'range') {
    costEl.children(':eq(0)').prop('disabled', false)
    costEl.children(':eq(2)').prop('disabled', false)
    costEl.children(':eq(4)').prop('disabled', false)
  }

  if (pattern == 'single') {
    costEl.children(':eq(1)').prop('disabled', false)
    costEl.children(':eq(3)').prop('disabled', false)
  }
}

function addDeliveryCost(event) {
  const element = $(event.target)

  const elState = $(event.target).parent().parent().parent()
  const pattern = elState.attr('data-pattern')
  const validateEl = elState.children(':eq(0)').children(':eq(1)')
  const costState = elState.children(':eq(0)').children(':eq(0)')

  let cost_value = ''
  let deliveryCostList = []
  const deliveryCostItems = $('.delivery-cost-items')
  $.each(deliveryCostItems, (index, el) => {
    if ($(el).attr('data-cost').trim() != '') {
      const itemsCost = $(el).attr('data-cost').split(',')
      deliveryCostList.push(...itemsCost)
    }
  })
  let costDuplicate = 0
  if (pattern == 'range') {
    const minEl = costState.children(':eq(0)')
    const maxEl = costState.children(':eq(2)')
    const costEl = costState.children(':eq(4)')
    if (minEl.val() == '' || maxEl.val() == '' || costEl.val() == '') {
      elState.attr('data-validate', 'false')
      formValidate(true, validateEl, 'โปรดป้อนข้อมูลให้ครบ')
    }
    if (minEl.val() != '' && maxEl.val() != '' && costEl.val() != '') {
      const min = Number.parseInt(minEl.val())
      const max = Number.parseInt(maxEl.val())

      if (min >= max) {
        elState.attr('data-validate', 'false')
        formValidate(true, validateEl, 'โปรดป้อนข้อมูลให้ถูกต้อง')
      }

      if (max > min) {
        const countList = []
        for (let cost = min; cost <= max; cost++) {
          const itemsCostInclude = deliveryCostList.includes(cost.toString())
          countList.push(cost)
          if (itemsCostInclude) {
            costDuplicate++
          }
        }
        if (costDuplicate > 0) {
          elState.attr('data-validate', 'false')
          formValidate(true, validateEl, 'มีจำนวนซ้ำ โปรดป้อนค่าใหม่')
        }
        if (costDuplicate == 0) {
          elState.attr('data-validate', 'true')
          closeDeliveryCost(element, elState, countList.join(','), validateEl, [minEl, maxEl, costEl])
        }
      }
    }
  }

  if (pattern == 'single') {
    const singleEl = costState.children(':eq(1)')
    const costEl = costState.children(':eq(3)')
    if (singleEl.val() == '' || costEl.val() == '') {
      elState.attr('data-validate', 'false')
      formValidate(true, validateEl, 'โปรดป้อนข้อมูลให้ครบ')
    }
    if (singleEl.val() != '' && costEl.val() != '') {
      if (deliveryCostList.includes(singleEl.val())) {
        costDuplicate++
      }
      if (costDuplicate > 0) {
        elState.attr('data-validate', 'false')
        formValidate(true, validateEl, 'มีจำนวนซ้ำ โปรดป้อนค่าใหม่')
      }
      if (costDuplicate == 0) {
        elState.attr('data-validate', 'true')
        closeDeliveryCost(element, elState, singleEl.val(), validateEl, [singleEl, costEl])
      }
    }
  }
}


function closeDeliveryCost(element, elState, cost, validateEl, [...inputEl]) {
  inputEl.forEach((el) => {
    el.prop('disabled', true)
  })
  element.css('display', 'none')
  element.next().css('display', 'inline')
  elState.attr('data-validate', 'true')
  elState.attr('data-cost', cost)
  formValidate(false, validateEl, '')
  $('#addDeliveryCost').prop('disabled', false)
}