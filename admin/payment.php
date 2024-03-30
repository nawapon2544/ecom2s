<div class="container">
  <div class="row justify-content-center">
    <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12">
      <div class="bg-white rounded-top my-2">
        <p class="m-0 bg-dark p-2 rounded-top text-light">
          เลือกธนาคาร
        </p>
        <div class="p-2">
          <div>
            <div class="payment-bank-name">
              <input class="form-check-input" type="radio" value="bbl" name="bankname" id="bbl">
              <label class="form-check-label" for="bbl">
                <img src="../icon-bank/bbl.png" class="icon-bank">
                <span>ธนาคารกรุงเทพ</span>
              </label>
            </div>
            <div class="payment-bank-name">
              <input class="form-check-input" type="radio" value="k-bank" name="bankname" id="k-bank">
              <label class="form-check-label" for="k-bank">
                <img src="../icon-bank/k-bank.png" class="icon-bank">
                <span>ธนาคารกสิกรไทย</span>
              </label>
            </div>
            <div class="payment-bank-name">
              <input class="form-check-input" type="radio" value="ktb" name="bankname" id="ktb">
              <label class="form-check-label" for="ktb">
                <img src="../icon-bank/ktb.png" class="icon-bank">
                <span>ธนาคารกรุงไทย</span>
              </label>
            </div>

            <div class="payment-bank-name">
              <input class="form-check-input" type="radio" value="scb" name="bankname" id="scb">
              <label class="form-check-label" for="scb">
                <img src="../icon-bank/scb.png" class="icon-bank">
                <span>ธนาคารไทยพาณิชย์</span>
              </label>
            </div>
            <div class="payment-bank-name">
              <input class="form-check-input" type="radio" value="bay" name="bankname" id="bay">
              <label class="form-check-label" for="bay">
                <img src="../icon-bank/bay.png" class="icon-bank">
                <span>ธนาคารกรุงศรีอยุธยา</span>
              </label>
            </div>
            <div class="payment-bank-name">
              <input class="form-check-input" type="radio" value="ttb" name="bankname" id="ttb">
              <label class="form-check-label" for="ttb">
                <img src="../icon-bank/ttb.png" class="icon-bank">
                <span>ธนาคารทหารไทยธนชาต</span>
              </label>
            </div>
            <div class="payment-bank-name">
              <input class="form-check-input" type="radio" value="cimb" name="bankname" id="cimb">
              <label class="form-check-label" for="cimb">
                <img src="../icon-bank/cimb.png" class="icon-bank">
                <span>ธนาคารซีไอเอ็มบี</span>
              </label>
            </div>
            <div class="payment-bank-name">
              <input class="form-check-input" type="radio" value="uob" name="bankname" id="uob">
              <label class="form-check-label" for="uob">
                <img src="../icon-bank/uob.png" class="icon-bank">
                <span>ธนาคารยูโอบี</span>
              </label>
            </div>
          </div>
          <div class="my-2">
            <label class="form-label">
              ชื่อบัญชี
            </label>
            <input type="text" class="form-control" id="bank-account-name" placeholder="ป้อนชื่อบัญขี">
          </div>
          <div class="my-2">
            <label class="form-label">
              หมายเลขบัญชี
            </label>
            <input type="text" class="form-control" id="bank-number" placeholder="ป้อนหมายเลขบัญชี">
          </div>
          <button id="paymentSubmit" class="btn btn-primary">
            บันทึก
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/payment.js"></script>