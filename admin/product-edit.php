<?php
$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE product_id='$product_id'";
$product_list = connect_db()->query($sql);
$product = $product_list->fetch(PDO::FETCH_ASSOC);
?>

<div class="container my-3 bg-light p-2">

  <div class="my-2">
    <label class="form-label text-light bg-primary px-3">
      ชื่อสินค้า
    </label>
    <input type="text" value="<?php echo $product['product_name'] ?>" class="form-control" id="productName">
    <p class="validate-text" id="validate-product-name"></p>
  </div>
  <div class="row">
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="my-2">
        <label class="form-label">ราคาต้นทุน</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-tags"></i>
          </span>
          <input type="number" min="1" value="<?php echo $product['product_cost_price'] ?>" class="form-control" id="productCostPrice" placeholder="ป้อนราคาต้นทุน">
        </div>
        <p class="validate-text" id="validate-product-cost-price"></p>
      </div>
    </div>
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="my-2">
        <label class="form-label">ราคา</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-hand-holding-dollar"></i>
          </span>
          <input type="number" min="1" value="<?php echo $product['product_price'] ?>" class="form-control" id="productPrice" placeholder="ป้อนราคาขาย">
        </div>
        <p class="validate-text" id="validate-product-price"></p>
      </div>
    </div>
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="my-2">
        <label class="form-label">ราคาขาย</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-money-bill-wave"></i>
          </span>
          <input type="number" min="1" value="<?php echo $product['product_real_price'] ?>" class="form-control" id="productRealPrice" placeholder="ป้อนราคาขายจริง">
        </div>
        <p class="validate-text" id="validate-product-real-price"></p>
      </div>
    </div>
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="my-2">
        <label class="form-label">คงเหลือ</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-cubes"></i>
          </span>
          <input type="number" min="1" value="<?php echo $product['product_remain'] ?>" class="form-control" id="productRemain" placeholder="ป้อนจำนวนสินค้าคงเหลือ">
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
        <input type="text" value="<?php echo $product['product_category'] ?>" data-focus="false" data-state="false" placeholder="ป้อนหมวดหมู่สินค้า เช่น อุปกรณ์คอมพิวเตอร์ หนังสือ เครื่องใช้ไฟฟ้่า" id="inputProductCategory" class="form-control">
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
        <input type="text" value="<?php echo $product['product_type'] ?>" data-focus="false" data-state="false" placeholder="ป้อนชนิดสินค้า เช่น โทรศัพท์มือถือ จอแสดงผล การ์ดจอ แรม พัดลม" id="inputProductType" class="form-control">
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
  <?php

  $product_dimension = json_decode($product['product_dimension']);


  $dimension = $product_dimension;

  $product_width =  isset($dimension->width) ? $dimension->width : '';
  $width_size =  isset($product_width->size) ? $product_width->size : '';
  $width_unit =  isset($product_width->unit) ? $product_width->unit : '';

  $product_height =  isset($dimension->height) ? $dimension->height : '';
  $height_size =  isset($product_height->size) ? $product_height->size : '';
  $height_unit =  isset($product_height->unit) ? $product_height->unit : '';

  $product_depth =  isset($dimension->depth) ? $dimension->depth :  '';
  $depth_size =  isset($product_depth->size) ? $product_depth->size : '';
  $depth_unit =  isset($product_depth->unit) ? $product_depth->unit : '';

  ?>
  <div class="row">
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">กว้าง (W)</label>
        <div class="input-group">
          <span class="input-group-text">ขนาด</span>
          <input type="text" value="<?php echo $width_size  ?>" placeholder="ป้อนความกว้่าง" id="product-width" class="form-control">
          <span class="input-group-text">หน่วย</span>
          <input type="text" placeholder="เช่น cm kg ms m " value="<?php echo $width_unit  ?>" id="product-width-unit" class="form-control">
        </div>
      </div>
    </div>
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">ยาว (H)</label>
        <div class="input-group">
          <span class="input-group-text">ขนาด</span>
          <input type="text" value="<?php echo $height_size ?>" placeholder="ป้อนความยาว" id="product-height" class="form-control">
          <span class="input-group-text">หน่วย</span>
          <input type="text" value="<?php echo $height_unit  ?>" placeholder="เช่น m cm kg ms " id="product-height-unit" class="form-control">
        </div>
      </div>
    </div>
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
      <div class="my-2">
        <label class="form-label">ลึก (D)</label>
        <div class="input-group">
          <span class="input-group-text">ขนาด</span>
          <input type="text" value="<?php echo $depth_size  ?>" placeholder="ป้อนความลึก" class="form-control" id="product-depth">
          <span class="input-group-text">หน่วย</span>
          <input type="text" value="<?php echo $depth_unit  ?>" placeholder="เช่น m cm kg ms " class="form-control" id="product-depth-unit">
        </div>
      </div>
    </div>
  </div>
  <div class="my-2">
    <label class="form-label">รายละเอียด</label>
    <textarea class="form-control" id="product-detail" cols="30" rows="10">
      <?php echo $product['product_detail']  ?>
      </textarea>
  </div>
  <p class="validate-text" id="validate-product-detail"></p>
  <div>
    <label class="form-lable bg-primary px-2 text-light">รูปภาพเดิม</label>
    <div id="product-before-img" class="product-previews" data-img="<?php echo  $product['img']  ?>" data-remove-img="">
      <?php foreach (explode(',', $product['img']) as $img) { ?>
        <div class="product-previews-img" data-img="<?php echo $img  ?>">
          <button class="product-img-remove">
            <i class="fa-solid fa-xmark"></i>
          </button>
          <img src="../product-img/<?php echo $img ?>">
        </div>
      <?php } ?>
    </div>


    <p class="my-1 form-label ">รูปภาพสินค้า</p>
    <label class="label-file fw-bold text-primary bg-light p-2 border" for="product-img">
      <i class="fa-regular fa-images"></i>
      เลือกภาพสินค้า
      <input type="file" id="product-img" multiple accept="image/*">
    </label>
    <div id="product-previews" class="product-previews">
    </div>
    <p class="validate-text" id="validate-product-img"></p>
  </div>

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
    <div id="detailProduct">
      <?php $product_data = json_decode($product['product_data']); ?>
      <?php
      foreach ($product_data as $p) {
        $prop_detail = $p->prop_detail;
        $detail_value = $p->detail_value;
        $unit = $p->unit;
      ?>

        <div class="row  border-top p-2 align-items-center m-1">
          <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="my-1">
              <label class="form-label text-light bg-success px-2">
                คุณสมบัติ
              </label>
              <input type="text" placeholder="คุณสมบัติ เช่น สี น้ำหนัก ความจุ" value="<?php echo $prop_detail ?>" class="form-control" name="product-detail-prop">
            </div>
          </div>
          <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="my-1">
              <label class="form-label">ข้อมูล</label>
              <input type="text" placeholder="ป้อนข้อมูล" value="<?php echo $detail_value ?>" class="form-control" name="product-detail-text">
            </div>
          </div>
          <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="my-1">
              <label class="form-label">หน่วย</label>
              <input type="text" placeholder="ป้อนหน่วย เช่น cm kg" value="<?php echo $unit ?>" class="form-control" name="product-detail-unit">
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
      <?php  } ?>
    </div>
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
    <div id="keywordProduct">
      <?php $product_keyword = json_decode($product['product_keyword'])  ?>
      <?php if (count($product) > 0) {
        foreach ($product_keyword as $index => $k) {
          $keyword_text = $k->keyword;
          $keyword_name = $k->name;
      ?>
          <div class="my-2 p-2 border-top mx-3">
            <div class="d-flex justify-content-between flex-wrap align-items-center">
              <label class="form-label d-flex align-items-center text-primary px-2">คำค้นหา</label>
              <button class="btn btn-light" onclick="deleteKeyword(event)">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div>
            <div class="row">
              <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="my-1">
                  <input type="text" value="<?php echo $keyword_text ?>" class="form-control" name="product-keyword-text" placeholder="ป้อนคำค้นหา">
                </div>
              </div>
              <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="my-1">
                  <select class="form-select text-secondary" name="product-keyword-name">
                    <option value="">เลือก</option>
                    <option value="keywords" selected>Keywords</option>
                    <option value="description">Description</option>
                    <option value="auther">Auther</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        <?php }     ?>
      <?php }     ?>
    </div>
  </div>

  <div class="my-2 border">
    <p class="form-label text-light bg-primary bg-opacity-75 p-2">
      <i class="fa-solid fa-sack-dollar"></i>
      <span>ค่าขนส่ง</span>
    </p>
    <div class="row p-2">
      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-10 col-sm-12 col-xs-12">
        <div class="input-group my-3">
          <input type="number" id="delivery-cost-count" class="form-control" value="1" min="1">

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
    <?php $delivery_cost  = json_decode($product['delivery_cost']); ?>

    <div id="product-delivery-cost">
      <?php foreach ($delivery_cost as $dvr) {
        $dvr_count = $dvr->count;
        $dvr_cost = $dvr->delivery_cost;
      ?>
        <div class="row p-1 m-1 delivery-cost-items" data-pattern="single" data-cost="<?php echo $dvr_count ?>" data-validate="true">
          <div class="col-xxl-6 col-xl-8 col-lg-10 col-md-12 col-sm-12 col-xs-12">
            <div class="input-group">
              <span class="fw-bold input-group-text text-secondary">จำนวน</span>
              <input type="number" value="<?php echo $dvr_count ?>" disabled data-pattern="single" data-validate="true" class="form-control" name="single-delivery-cost">
              <span class="fw-bold input-group-text text-secondary">ค่าขนส่ง</span>
              <input type="number" value="<?php echo $dvr_cost ?>" disabled class="form-control" name="single-delivery-cost-text">
            </div>
            <p class="validate-text"></p>
          </div>
          <div class="col-xxl-6 col-xl-4 col-lg-2 col-md-12 col-sm-12 col-xs-12">
            <div class="my-1">
              <button class="btn btn-primary" style="display:none;" onclick="addDeliveryCost(event)">
                ตกลง
              </button>
              <button class="btn btn-light text-primary" onclick="updateDeliveryCost(event)">
                แก้ไข
              </button>
              <button class="btn btn-light" onclick="deleteDeliveryCost(event)">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <button class="my-3 btn btn-dark" id="update-product" data-productId="<?php echo  $product['product_id'] ?>">
    บันทึก
  </button>
</div>
<script src="./js/products/productImgRemove.js"></script>
<script src="./js/products/productDataList.js"></script>
<script src="./js/productImg.js"></script>
<script src="./js/products/productEditForm.js"></script>
<script src="./js/add-product/deleteProductDataDetail.js"></script>
<script src="./js/add-product/addProductDetail.js"></script>
<script src="./js/add-product/addProductKeyword.js"></script>
<script src="./js/products/addDeliveryCost.js"></script>
<script src="./js/products/deleteDeliverCost.js"></script>
<script src="./js/products/productEdit.js"></script>