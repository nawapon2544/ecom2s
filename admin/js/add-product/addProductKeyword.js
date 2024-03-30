$('#addProductKeyword').click(function () {
  const count = Number.parseInt($('#product-keyword-count').val())
  const length = $('[name="product-keyword-text"]').length
  let keywordProductEl = ``
  for (let i = 1; i <= count; i++) {
    keywordProductEl += `
  <div class="my-2 p-2 border-top mx-3">
    <div class="d-flex justify-content-between flex-wrap">
    <label class="form-label d-flex align-items-center text-primary px-2">คำค้นหา</label>
      <button class="btn btn-light" onclick="deleteKeyword(event)">
          <i class="fa-solid fa-trash-can"></i>
      </button>
    </div>
    <div class="row">
      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <div class="my-1">
          <input type="text" class="form-control" name="product-keyword-text" placeholder="ป้อนคำค้นหา">
        </div>
      </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="my-1">
          <select class="form-select text-secondary" name="product-keyword-name">
            <option value="">เลือก</option>
            <option value="keywords" selected>Keywords</option>
            <option value="description">Description</option>
            <option value="auther">Auther</option>
          </select>
        </div>
      </div>
      <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12">
       
      </div>
    </div>
  </div>
    `
  }

  $('#keywordProduct').append(keywordProductEl)
})

function deleteKeyword(evt) {
  const target = $(evt.target)
  const tagName = target.prop('tagName')
  const el = tagName == 'I' ?
    target.parent().parent().parent() :
    target.parent().parent()
  console.log(el)

  el.remove()
}