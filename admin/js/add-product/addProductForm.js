const productForm = [{
  'name': 'product_name',
  'formtype': 'text',
  'input': $('#productName'),
  'validate': $('#validate-product-name'),
  'msg': 'โปรดป้อนชื่อสินค้า'
}, {
  'name': 'product_cost_price',
  'formtype': 'number',
  'input': $('#productCostPrice'),
  'validate': $('#validate-product-cost-price'),
  'msg': 'โปรดป้อนราคาทุน'
}, {
  'name': 'product_price',
  'formtype': 'number',
  'input': $('#productPrice'),
  'validate': $('#validate-product-price'),
  'msg': 'โปรดป้อนราคา'
}, {
  'name': 'product_real_price',
  'formtype': 'number',
  'input': $('#productRealPrice'),
  'validate': $('#validate-product-real-price'),
  'msg': 'โปรดป้อนราคาขายจริง'
}, {
  'name': 'product_remain',
  'formtype': 'number',
  'input': $('#productRemain'),
  'validate': $('#validate-product-remain'),
  'msg': 'โปรดป้อนราคาสินค้า'
}, {
  'name': 'product_category',
  'formtype': 'text',
  'input': $('#inputProductCategory'),
  'validate': $('#validate-product-category'),
  'msg': 'โปรดป้อนหมวดหมู่สินค้า'
}, {
  'name': 'product_type',
  'formtype': 'text',
  'input': $('#inputProductType'),
  'validate': $('#validate-product-type'),
  'msg': 'โปรดป้อนชนิดสินค้า'
},
{
  'name': 'product_detail',
  'formtype': 'text',
  'input': $('#product-detail'),
  'validate': $('#validate-product-detail'),
  'msg': 'โปรดป้อนป้อนรายละเอียดสินค้า'
},
{
  'name': 'product_img',
  'formtype': 'file',
  'input': $('#product-img'),
  'validate': $('#validate-product-img'),
  'msg': 'โปรดเลือกรูปสินค้า'
}]