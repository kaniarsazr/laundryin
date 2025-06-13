<?php
include '../koneksi.php';

$id = $_GET['id'];

// Hapus dulu data di log_transaksi yang terkait dengan transaksi ini
mysqli_query($koneksi, "DELETE FROM log_transaksi WHERE log_transaksi_id='$id'");

// Hapus dulu data di pakaian yang terkait dengan transaksi ini
mysqli_query($koneksi, "DELETE FROM pakaian WHERE pakaian_transaksi='$id'");

// Baru hapus data transaksi
mysqli_query($koneksi, "DELETE FROM transaksi WHERE transaksi_id='$id'");

// Redirect kembali ke halaman transaksi
header("location:transaksi.php");
?>
