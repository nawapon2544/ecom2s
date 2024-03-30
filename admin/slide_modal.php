<div class="modal fade" id="slide-modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-secondary">ภาพสไลด์</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="slide-form">
          <label for="slide-upload" class="fw-bold text-light bg-dark p-2 rounded label-file">
            <input type="file" id="slide-upload" class="d-none">
            <i class="fa-regular fa-images"></i>
            <span>เพิ่มภาพสไลด์</span>
          </label>
          <div class="my-3">
            <label class="form-label">
              เพิ่มคำอธิบาย
            </label>
            <textarea id="slide-descript" placeholder="เพิ่มคำอธิบายที่เกี่ยวกับภาพนี้" class="form-control" rows="6"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="slideSubmit" type="button" class="btn btn-light">
          บันทึก
        </button>
      </div>
    </div>
  </div>
</div>