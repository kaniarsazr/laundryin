<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sistem Informasi Laundry - LaundryIn</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- Remixicon (ikon tambahan jika diperlukan) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />

  <!-- Custom Styling -->
  <style>
    body {
      background: #f0f0f0;
      font-family: 'Arial', sans-serif;
    }

    .navbar {
      background: linear-gradient(to right, #0275d8, #1891f5, #5bc0de);
      border: none;
      border-radius: 0;
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: bold !important;
      font-size: 20px;
    }

    .navbar-nav > li > a,
    .navbar-text {
      color: #fff !important;
      font-weight: 500;
    }

    .navbar-nav > li > a:hover,
    .navbar-nav > .active > a {
      background-color: rgba(255, 255, 255, 0.2) !important;
      border-radius: 5px;
    }

    .navbar-nav > li.logout > a {
      background-color: #d9534f !important;
      color: white !important;
      font-weight: bold;
      border-radius: 4px;
      transition: 0.3s;
    }

    .navbar-nav > li.logout > a:hover {
      background-color: #c9302c !important;
    }

    .container-content {
      max-width: 1000px;
      margin: 30px auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
    }

    /* Warna baris tabel sesuai status */
    .status-proses {
      background-color: #fcf8e3 !important;
    }

    .status-dicuci {
      background-color: #d9edf7 !important;
    }

    .status-selesai {
      background-color: #dff0d8 !important;
    }

    /* Tabel Header dan Hover */
    .table thead {
      background-color: #0275d8;
      color: white;
      text-align: center;
    }

    .table td, .table th {
      text-align: center;
      vertical-align: middle !important;
    }

    .table-hover tbody tr:hover {
      background-color: #eaf3fc;
    }
  </style>

  <!-- jQuery dan Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed"
              data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1"
              aria-expanded="false">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">LaundryIn</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
        <li class="<?= ($currentPage == 'pelanggan.php') ? 'active' : '' ?>"><a href="pelanggan.php"><i class="glyphicon glyphicon-user"></i> Pelanggan</a></li>
        <li class="<?= ($currentPage == 'transaksi.php') ? 'active' : '' ?>"><a href="transaksi.php"><i class="glyphicon glyphicon-random"></i> Transaksi</a></li>
        <li class="logout"><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text"><i class="glyphicon glyphicon-user"></i> Halo, <b><?php echo $_SESSION['username']; ?></b>!</p></li>
      </ul>
    </div>
  </div>
</nav>
