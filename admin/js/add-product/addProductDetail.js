$('#addProductDetail').click(function () {
  const count = Number.parseInt($('#product-detail-count').val())
  if (!isNaN(count)) {
    let productDetailEl = ``
    for (let i = 1; i <= count; i++) {

      productDetailEl += `
      <div class="row  border-top p-2 align-items-center m-1" >
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="my-1">
            <label class="form-label text-light bg-success px-2">คุณสมบัติ</label>
            <input type="text" placeholder="คุณสมบัติ เช่น สี น้ำหนัก ความจุ" class="form-control" name="product-detail-prop">
          </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="my-1">
            <label class="form-label">ข้อมูล</label>
            <input type="text" placeholder="ป้อนข้อมูล" class="form-control" name="product-detail-text">
          </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="my-1">
            <label class="form-label">หน่วย</label>
            <input type="text" placeholder="ป้อนหน่วย เช่น cm kg"  class="form-control" name="product-detail-unit">
          </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="my-1">
            <button class="input-group-text btn btn-light" onclick="deleteProductDataDetail(event)">
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </div>
      </div>
    </div>
    `
    }
    $('#detailProduct').append(productDetailEl)
  }
})

