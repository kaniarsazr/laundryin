<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Laundry</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/all.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f0f0f0;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background: linear-gradient(to right, #0275d8, #1891f5, #5bc0de);
            border: none;
            border-radius: 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 600;
            font-size: 22px;
        }

        .navbar-nav > li > a {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-nav > li > a:hover,
        .navbar-nav > .active > a {
            background-color: rgba(255, 255, 255, 0.2) !important;
            border-radius: 5px;
        }

        .navbar-text {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-toggle .icon-bar {
            background-color: #fff;
        }
    </style>
</head>

<body>

<?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../index.php?pesan=belum_login");
    }
?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" 
                    data-toggle="collapse" data-target="#bs-navbar"
                    aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">LaundryIn</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-navbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                <li><a href="pelanggan.php"><i class="glyphicon glyphicon-user"></i> Pelanggan</a></li>
                <li><a href="transaksi.php"><i class="glyphicon glyphicon-random"></i> Transaksi</a></li>
                <li><a href="laporan.php"><i class="glyphicon glyphicon-list-alt"></i> Laporan</a></li>
                <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p class="navbar-text">
                        <i class="fa fa-user-shield"></i> Halo, <b><?php echo $_SESSION['username']; ?></b>!
                    </p>
                </li>
            </ul>
        </div>
    </div>
</nav>
