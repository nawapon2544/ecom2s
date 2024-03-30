function createCartEl(carts) {
  let cartEl = ``
  carts.forEach((c) => {
    const total = Number.parseInt(c.quantity) * Number.parseFloat(c.product_real_price)
    cartEl += `
        <div class="cart-items d-flex p-2 align-items-center border-1 border-bottom">
          <div class="d-flex justify-content-center" style="width: 10%;">
            <div class="form-check">
              <input class="form-check-input" name="cart-order" type="checkbox" value="${btoa(JSON.stringify(c))}">
            </div>
          </div>
          <div style="width: 90%;">
            <div class="row align-items-center">
              <div class="col-xxl-4 col-xl-4 col-lg-3 col-md-8 col-sm-12 col-xs-12">
                <div class="row align-items-center">
                  <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <img class="table-img" src="./product-img/${c.img}">
                  </div>
                  <div class="col-xxl-10 col-xl-10 col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="text-xl-start text-lg-start text-md-center text-sm-center">
                      ${c.product_name}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-12 col-xs-12 text-end my-1">
                <div>
                  <span class="fw-bold" id="product-price">
                  <span id="product-price-discount"></span>
                    ${c.product_price}
                  </span>
                  <span class="fw-bold text-danger">
                    ${c.product_real_price}
                  </span>
                </div>
              </div>
              <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-12 col-sm-12 col-xs-12 my-1">
                <div class="d-flex justify-content-end">
                  <button class="btn btn-light btn-qty" data-target="reduce-qty" data-price="${btoa(c.product_real_price)}" data-productId="${btoa(c.product_id)}">
                    <i class="fa-solid fa-minus"></i>
                  </button>
                  <input type="text" class="cart-qty" name="cart-qty" value=" ${c.quantity}" min="1" max="${c.product_remai}">
                  <button class="btn btn-light btn-qty" data-target="add-qty" data-price="${btoa(c.product_real_price)}" data-productId="${btoa(c.product_id)}">
                    <i class="fa-solid fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-8 col-sm-8 col-xs-8 my-1">
                <input disabled class="border-0 bg-transparent w-100 text-end" type="text" value="${total}">
              </div>
              <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-4 col-sm-4 col-xs-4 text-end">
                <button class="btn btn-light delete-cart" data-cartId="${btoa(c.cart_id)}">
                  <i class="fa-solid fa-trash-can"></i>
                </button>
              </div>
            </div>
          </div>
        </div>`

  })
  const cartItemsCount = $('#carts').children().children().length
  console.log(cartItemsCount)
  $('#carts').attr('data-last', cartItemsCount + carts.length)
  $('#carts').children().append(cartEl)
}
