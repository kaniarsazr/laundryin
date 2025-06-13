<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice | LaundryIn</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        .invoice-box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-top: 40px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-header h2 {
            font-weight: 700;
            color: #007bff;
        }
        .badge {
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 20px;
        }
        .btn-print {
            float: right;
            margin-bottom: 20px;
        }
        .table th {
            width: 30%;
        }
    </style>
</head>
<body>

<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
}
include '../koneksi.php';
?>

<div class="container">
    <div class="col-md-10 offset-md-1">
        <div class="invoice-box">

        <?php 
        $id = $_GET['id'];
        $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi, pelanggan WHERE transaksi_id='$id' and transaksi_pelanggan=pelanggan_id");

        while($t = mysqli_fetch_array($transaksi)) {
        ?>
            <div class="invoice-header">
                <h2>LAUNDRYIN</h2>
                <p class="text-muted">Invoice Transaksi</p>
            </div>

            <a href="transaksi_invoice_cetak.php?id=<?php echo $id;?>" target="_self" class="btn btn-primary btn-sm btn-print">
                <i class="glyphicon glyphicon-print"></i> CETAK
            </a>

            <table class="table table-borderless">
                <tr><th>No. Invoice</th><td>: Invoice-<?php echo $t['transaksi_id'];?></td></tr>
                <tr><th>Tgl. Laundry</th><td>: <?php echo $t['transaksi_tgl'];?></td></tr>
                <tr><th>Nama Pelanggan</th><td>: <?php echo $t['pelanggan_nama'];?></td></tr>
                <tr><th>No. HP</th><td>: <?php echo $t['pelanggan_hp'];?></td></tr>
                <tr><th>Alamat</th><td>: <?php echo $t['pelanggan_alamat'];?></td></tr>
                <tr><th>Berat Cucian</th><td>: <?php echo $t['transaksi_berat']; ?> Kg</td></tr>
                <tr><th>Tgl. Selesai</th><td>: <?php echo $t['transaksi_tgl_selesai'];?></td></tr>
                <tr><th>Status</th>
                    <td>:
                        <?php 
                        if($t['transaksi_status'] == "0"){
                            echo "<span class='badge badge-warning'>PROSES</span>";
                        } else if($t['transaksi_status'] == "1"){
                            echo "<span class='badge badge-info'>DICUCI</span>";
                        } else if($t['transaksi_status'] == "2"){
                            echo "<span class='badge badge-success'>SELESAI</span>";
                        }
                        ?>
                    </td>
                </tr>
                <tr><th>Total Harga</th><td>: Rp. <?php echo number_format($t['transaksi_harga'], 0, ',', '.'); ?> ,-</td></tr>
            </table>

            <hr>

            <h5 class="text-center font-weight-bold mb-3">Daftar Cucian</h5>
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Jenis Pakaian</th>
                        <th class="text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $id = $t['transaksi_id'];
                    $pakaian = mysqli_query($koneksi, "SELECT * FROM pakaian WHERE pakaian_transaksi='$id'");
                    while($p = mysqli_fetch_array($pakaian)) {
                    ?>
                    <tr>
                        <td><?php echo $p['pakaian_jenis']; ?></td>
                        <td class="text-center"><?php echo $p['pakaian_jumlah']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <p class="text-center mt-4"><i>"Terima kasih telah mempercayakan cucian Anda kepada kami."</i></p>

        <?php } ?>
        </div>
    </div>
</div>

</body>
</html>
