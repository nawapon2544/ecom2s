<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once('./head.php') ?>
  <title>Document</title>
  <link rel="stylesheet" href="./css/login.css">
</head>

<body class="bg-light">
  <div class="container">
    <div class="my-4 row justify-content-center">
      <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-8 col-sm-12">
        <div class="bg-white border rounded">
          <h5 class="my-2 text-secondary p-2 rounded-top fw-bold text-center">
            ลงชื่อเข้าสู่ระบบ
          </h5>
          <div class="p-2">
            <div class="my-1">
              <label class="form-label bg-dark px-2 text-light rounded-2">
                Username
              </label>
              <input type="text" id="username" class="form-control" placeholder="username">
            </div>
            <div class="my-1">
              <label class="form-label bg-dark px-2 text-light rounded-2">
                Password
              </label>
              <input type="password" id="password" class="form-control" placeholder="password">
            </div>
          </div>
          <div class="p-2 text-center">
            <button id="login" class="btn btn-none btn-hover">
              เข้าสู่ระบบ
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./js/login.js"></script>
</body>

</html>