<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: ../');
  }else if($_SESSION['id_akses'] != 1){
    if ($_SESSION['id_akses'] == 2) {
      header('Location: ../data_korwil/');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <!-- Icons-->
  <link href="../assets/vendors/css/flag-icon.min.css" rel="stylesheet">
  <link href="../assets/vendors/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/vendors/css/simple-line-icons.css" rel="stylesheet">
  <!-- Main styles for this application-->
  <link rel="stylesheet" href="../assets/css/datatables.min.css"> <!--Data Tables-->
  <link href="../assets/css/style.min.css" rel="stylesheet">
  <link href="../assets/css/costum.css" rel="stylesheet">
  <link href="../assets/css/pace.min.css" rel="stylesheet">

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
  <header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="./">
      <!-- <img class="navbar-brand-full" src="../assets/img/logo.jpg" width="50" height="50" alt="CoreUI Logo"> -->
      <img class="navbar-brand-minimized" src="../assets/img/logo.jpg" width="45" height="45" alt="CoreUI Logo">
    </a>
    <ul class="nav navbar-nav ml-auto">
      <font class="text-value-sm">
        <?=$_SESSION['username']?>
      </font>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="fa fa-angle-down" style="font-size: 35px;"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Pengaturan Akun</strong>
          </div>
          <a class="dropdown-item" href="./ubahpassword.php">
            <i class="fa fa-key"></i> Ubah password
          </a>
          <a class="dropdown-item" href="../logout.php">
            <i class="fa fa-lock"></i> Logout</a>
          </a>
        </div>
      </li>
    </ul>
  </header>