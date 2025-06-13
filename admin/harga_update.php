<?php
include '../koneksi.php';
$harga = $_POST['harga'];

//update data
mysqli_query($koneksi, "UPDATE harga set harga_per_kilo='$harga'");

//mengalihkan halaman kembali ke halaman pelanggan
header("location:harga.php");
?>