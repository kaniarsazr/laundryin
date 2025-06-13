<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistem Informasi Laundry Ahmad Irfanda - 
    www.fandatekno.com</title>
    <link rel="stylesheet" type="text/css" 
    href="../assets/css/bootstrap.css">
    <script type="text/javascript" 
    src="../assets/js/jquery.js"></script>
    <script type="text/javascript" 
    src="../assets/js/bootstrap.js"></script>

    <link rel="stylesheet" type="text/css" 
    href="../assets/font-awesome/css/all.css">
</head>

<body style="background: #f0f0f0">
    <!--Cek apakah sudah login-->
    <?php
        session_start();
        if($_SESSION['status'] != "login"){
            header("location:../index.php?pesan=belum_login");
        }
    ?>

    <!--Menu Navigasi-->
    <nav class="navbar navbar-inverse" style="border-radius: 0px">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" 
                data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                SI AHMAD IRFANDA</a>
            </div><!--End of "navbar-header"-->

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
                    </i>Laporan</a></li><!--LAPORAN-->

                    <li class="dropdown"><!--DROPDOWN PENGATURAN-->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="glyphicon glyphicon-wrench">
                    </i>Pengaturan<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="harga.php"><i class="glyphicon glyphicon-usd">
                            </i>Pengaturan Harga</a></li>
                            <li><a href="ganti_password.php">
                            <i class="glyphicon glyphicon-lock">
                            </i>Ganti Password</a></li>
                        </ul><!--End of "dropdown-menu"-->
                    </li> <!--End of "DROPDOWN PENGATURAN"-->
                    
                    <li><a href="logout.php">
                    <i class="glyphicon glyphicon-log-out">
                    </i>Log Out</a></li>
                </ul> <!--nav navbar-nav-->

                <ul class="nav navbar-nav navbar-right">
                    <li><p class="navbar-text"><i class="fa fa-user-shield"></i> Halo, <b>
                    <?php echo $_SESSION['username'];?></b>!</p></li>
                </ul>
            </div> <!--End of 'collapse navbar-collapse'-->
        </div><!--End of "Container-fluid"-->
    </nav>
</body>
</html>