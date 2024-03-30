<?php
require_once('./route.php');
require_once('../conn.php');

@session_start();
$admin = isset($_SESSION['username']) ?  $_SESSION['username'] : '';
$emp_name = isset($_SESSION['employee_fname']) ? $_SESSION['employee_fname'] : '';
if (!isset($_SESSION['username']) && !isset($_SESSION['employee_fname'])) {
  header('location:./login.php');
}
$p = empty($_GET['p']) ? 'dashboard' : $_GET['p'];
$routes = routes($p);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $routes['title'] ?></title>
  <?php require_once('./head.php')  ?>
  <link rel="stylesheet" href="./css/sidebar.css">
  <link rel="stylesheet" href="./css/index.css">
  <?php
  foreach ($routes['style'] as $css) { ?>
    <link rel="stylesheet" href="./css/<?php echo $css ?>">
  <?php }
  ?>
</head>

<body>
  <div id="sidebar" data-show="false">
    <div class="user-bar">
      <div class="user-icon-bar">
        <span class="a">
          <i class="fa-regular fa-user"></i>
        </span>
      </div>
      <div class="user-text">
        <h5 class="m-0"><?php echo $admin ?></h5>
        <p class="m-0 bg-dark text-light rounded px-2">
          <?php echo $emp_name  ?>
        </p>
      </div>
    </div>
    <?php require_once('./sidebar.php') ?>
    <div>
      <a href="./logout.php" class="btn btn-dark">
        <i class="fa-solid fa-right-from-bracket"></i>
        ออกจากระบบ
      </a>
    </div>
  </div>
  <div id="main">
    <div id="main-bar" class="bar">
      <div>
        <h5 id="admin-title">Admin</h5>
        <button id="main-toggle" class="menu-toggle">
          <i class="fa-solid fa-bars menu-toggle"></i>
        </button>
      </div>

    </div>
    <div id="main-content">
      <?php require_once($routes['file'] . ".php")  ?>
    </div>
  </div>
</body>
<script src="./js/sidebar.js"></script>
<script>
  const href = new URL(location.href)
  const searchParams = href.searchParams
  const p = searchParams.get('p')

  $.each($('.menu-link'), (index, el) => {
    const href = $(el).attr('href')
    const link = href.substring(href.lastIndexOf('=') + 1)

    if (link == p) {
      $(el).parent().addClass('active')
    }
  })
</script>
</html>