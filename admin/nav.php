<nav class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="#">
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">รายงาน</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            คำสั่งซื้อ
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./add-product.php">
            เพิ่มสินค้า
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            สินค้า
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./add-product.php">เพิ่ม</a></li>
            <li><a class="dropdown-item" href="#">จัดการ</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>