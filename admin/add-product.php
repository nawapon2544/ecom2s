<div class="container my-3 bg-light p-2">
  <div class="my-2">
    <label class="form-label text-light bg-primary px-3">
      ชื่อสินค้า
    </label>
    <input type="text" placeholder="ป้อนชื่อสินค้า" class="form-control" id="productName">
    <p class="validate-text" id="validate-product-name"></p>
  </div>
  <div class="row">
    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">ราคาต้นทุน</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-tags"></i>
          </span>
          <input type="number" min="1" placeholder="ป้อนราคาต้นทุน" class="form-control" id="productCostPrice">
        </div>

        <p class="validate-text" id="validate-product-cost-price"></p>
      </div>
    </div>
    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">ราคา</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-hand-holding-dollar"></i>
          </span>
          <input type="number" min="1" placeholder="ป้อนราคาขาย" class="form-control" id="productPrice">
        </div>
        <p class="validate-text" id="validate-product-price"></p>
      </div>
    </div>
    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">ราคาขาย</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-money-bill-wave"></i>
          </span>
          <input type="number" min="1" placeholder="ป้อนราคาขายจริง" class="form-control" id="productRealPrice">
        </div>
        <p class="validate-text" id="validate-product-real-price"></p>
      </div>
    </div>
    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">คงเหลือ</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-cubes"></i>
          </span>
          <input type="number" min="1" placeholder="ป้อนจำนวนสินค้าคงเหลือ" class="form-control" id="productRemain">
        </div>
        <p class="validate-text" id="validate-product-remain"></p>
      </div>
    </div>
  </div>
  <div class="my-2">
    <label class="form-label bg-primary text-light px-3">
      หมวดหมู่สินค้า
      <i class="fa-solid fa-layer-group"></i>
    </label>
    <?php
    $sql = "SELECT DISTINCT product_category FROM products";
    $p_category_list = connect_db()->query($sql);

    ?>
    <div class="row">
      <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <input type="text" data-focus="false" data-state="false" placeholder="ป้อนหมวดหมู่สินค้า เช่น อุปกรณ์คอมพิวเตอร์ หนังสือ เครื่องใช้ไฟฟ้่า" id="inputProductCategory" class="form-control">
        <div class="data-list-section">
          <div class="list-data" id="list-productCategory" data-state="true">
            <?php
            $c_index = 0;
            while ($p_category = $p_category_list->fetch(PDO::FETCH_ASSOC)) {
              $c_index++;
            ?>
              <label for="p-cty-<?php echo $c_index  ?>" class="list-data-label">
                <input type="radio" class="list-data-check" name="product-category" id="p-cty-<?php echo $c_index ?>" value="<?php echo $p_category['product_category']  ?>">
                <span>
                  <?php echo $p_category['product_category']  ?>
                </span>
              </label>
            <?php  } ?>
          </div>
        </div>
      </div>
    </div>
    <p class="validate-text" id="validate-product-category"></p>
  </div>
  <div class="my-2">
    <label class="form-label bg-primary text-light px-3">
      ชนิดสินค้า
      <i class="fa-solid fa-layer-group"></i>
    </label>
    <?php
    $sql = "SELECT DISTINCT product_type FROM products";
    $p_type_list = connect_db()->query($sql);

    ?>

    <div class="row">
      <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <input type="text" data-focus="false" data-state="false" placeholder="ป้อนชนิดสินค้า เช่น โทรศัพท์มือถือ จอแสดงผล การ์ดจอ แรม พัดลม" id="inputProductType" class="form-control">
        <div class="data-list-section">
          <div class="list-data" id="list-productType" data-state="true">
            <?php
            $t_index = 0;
            while ($p_type = $p_type_list->fetch(PDO::FETCH_ASSOC)) {
              $t_index++;
            ?>
              <label for="p-type-<?php echo $t_index  ?>" class="list-data-label">
                <input type="radio" class="list-data-check" name="product-type" id="p-type-<?php echo $t_index  ?>" value="<?php echo $p_type['product_type']  ?>">
                <span>
                  <?php echo $p_type['product_type']  ?>
                </span>
              </label>
            <?php  } ?>
          </div>
        </div>
      </div>
    </div>
    <p class="validate-text" id="validate-product-type"></p>
  </div>
  <div class="row">
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">กว้าง (W)</label>
        <div class="input-group">
          <span class="input-group-text">ขนาด</span>
          <input placeholder="ป้อนความกว้่าง" type="text" id="product-width" class="form-control">
          <span class="input-group-text">หน่วย</span>
          <input type="text" placeholder="เช่น cm kg ms m " id="product-width-unit" class="form-control">
        </div>
      </div>
    </div>
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">ยาว (H)</label>
        <div class="input-group">
          <span class="input-group-text">ขนาด</span>
          <input placeholder="ป้อนความยาว" type="text" id="product-height" class="form-control">
          <span class="input-group-text">หน่วย</span>
          <input type="text" placeholder="เช่น m cm kg ms " id="product-height-unit" class="form-control">
        </div>
      </div>
    </div>
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">ลึก (D)</label>
        <div class="input-group">
          <span class="input-group-text">ขนาด</span>
          <input placeholder="ป้อนความลึก" type="text" class="form-control" id="product-depth">
          <span class="input-group-text">หน่วย</span>
          <input placeholder="เช่น m cm kg ms " type="text" class="form-control" id="product-depth-unit">
        </div>
      </div>
    </div>
  </div>

  <div class="my-2">
    <label class="form-label">รายละเอียด</label>
    <textarea class="form-control" id="product-detail" cols="30" rows="10"></textarea>
  </div>
  <p class="validate-text" id="validate-product-detail"></p>
  <div>
    <p class="my-1 form-label ">รูปภาพสินค้า</p>
    <label class="label-file fw-bold text-primary bg-light p-2 border" for="product-img">
      <i class="fa-regular fa-images"></i>
      เลือกภาพสินค้า
      <input type="file" id="product-img" multiple accept="image/*">
    </label>
    <div id="product-previews" class="product-previews"></div>
  </div>
  <p class="validate-text" id="validate-product-img"></p>

  <div class="my-2 border">
    <p class="form-label text-light bg-primary bg-opacity-75 p-2 ">
      เพิ่มข้อมูลเพิ่มเติม
    </p>
    <div class="row p-3">
      <label for="" class="form-label">
        ป้อนจำนวนคุณสมบัติ
      </label>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-8 col-sm-12 col-xs-12">
        <div class="my-3">
          <div class="input-group">
            <span class="input-group-text">
              จำนวน
            </span>
            <input type="number" id="product-detail-count" class="form-control" value="1" min="1">
            <button class="btn btn-dark" id="addProductDetail">
              <i class="fa-solid fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div id="detailProduct"></div>
  </div>

  <div class="my-2 border">
    <p class="form-label text-light bg-primary bg-opacity-75 p-2">
      <i class="fa-solid fa-key"></i>
      <span>เพิ่มคำค้นหา</span>
    </p>
    <div class="row p-2">
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-8 col-sm-12 col-xs-12">
        <div class="input-group my-2">
          <span class="input-group-text">
            จำนวน
          </span>
          <input type="number" id="product-keyword-count" class="form-control" value="1" min="1">
          <button class="btn btn-dark" id="addProductKeyword">
            <i class="fa-solid fa-plus"></i>
          </button>
        </div>
      </div>
    </div>

    <div id="keywordProduct"></div>
  </div>
  <div class="my-2 border">
    <p class="form-label text-light bg-primary bg-opacity-75 p-2">
      <i class="fa-solid fa-sack-dollar"></i>
      <span>ค่าขนส่ง</span>
    </p>
    <div class="row p-2">
      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-10 col-sm-12 col-xs-12">
        <div class="input-group my-3">
          <span class="input-group-text">
            จำนวน
          </span>
          <input type="number" id="delivery-cost-count" class="form-control" value="1" min="1">
          <span class="input-group-text">
            เลือกรูปแบบ
          </span>
          <select class="form-select" id="deliveryCostPattern">
            <option value="">เลือกแบบ</option>
            <option value="range" selected>ช่วง</option>
            <option value="single">ค่าเดียว</option>
          </select>
          <button class="btn btn-dark" id="addDeliveryCost">
            <i class="fa-solid fa-plus"></i>
          </button>
        </div>
      </div>
    </div>
    <div id="product-delivery-cost"></div>
  </div>

  <button class="my-3 btn btn-dark" id="add-product">
    บันทึก
  </button>

  <script>
    $('#product-img').change(function() {
      const files = $(this)[0].files

      let productPreviewsEl = ``
      for (let i = 0; i < files.length; i++) {
        const src = URL.createObjectURL(files[i])
        productPreviewsEl += `<img src="${src}">`
      }
      $('#product-previews')
        .css('height', '200px')
        .css('overflow-y', 'scroll')
      $('#product-previews').html(productPreviewsEl)
    })
  </script>
</div>
<script src="./js/productImg.js"></script>
<script src="./js/products/productDataList.js"></script>
<script src="./js/add-product/addProductForm.js"></script>
<script src="./js/add-product/addProduct.js"></script>
<script src="./js/add-product/deleteProductDataDetail.js"></script>
<script src="./js/add-product/addProductDetail.js"></script>
<script src="./js/products/addDeliveryCost.js"></script>
<script src="./js/products/deleteDeliverCost.js"></script>
<script src="./js/add-product/addProductKeyword.js"></script>