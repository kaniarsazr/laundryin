<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LaundryIn - Admin</title>

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

  <!-- Bootstrap CSS (untuk ikon Bootstrap & utilitas tambahan) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

</head>

<body class="bg-gray-100 text-gray-800">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-[#0275d8] via-[#1891f5] to-[#5bc0de] shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

            <div class="collapse navbar-collapse" 
            id="#bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">
                    <i class="glyphicon glyphicon-home">
                    </i>Dashboard</a></li><!--HOME-->
                    <li><a href="pelanggan.php">
                    <i class="glyphicon glyphicon-user">
                    </i>Pelanggan</a></li><!--PELANGGAN-->
                    <li><a href="transaksi.php">
                    <i class="glyphicon glyphicon-random">
                    </i>Transaksi</a></li><!--TRANSAKSI-->
                    <li><a href="laporan.php">
                    <i class="glyphicon glyphicon-list-alt">
        
                    
                    <li><a href="logout.php">
                    <i class="glyphicon glyphicon-log-out">
                    </i>Log Out</a></li>
                </ul> <!--nav navbar-nav-->

  <!-- Mulai Konten -->
  <main class="p-6">
