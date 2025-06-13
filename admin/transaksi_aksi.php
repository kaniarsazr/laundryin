<?php
include '../koneksi.php';

$pelanggan_id = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tgl_selesai = $_POST['tgl_selesai'];
$tgl = date('Y-m-d');
$status = 0;
$harga = $berat * 5000;

// Cek apakah pelanggan valid
$cek = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelanggan_id='$pelanggan_id'");
if(mysqli_num_rows($cek) == 0){
    die("Pelanggan tidak ditemukan!");
}

// Simpan transaksi ke tabel 'transaksi'
mysqli_query($koneksi, "INSERT INTO transaksi (
    transaksi_pelanggan, transaksi_tgl, transaksi_berat, transaksi_tgl_selesai, transaksi_harga, transaksi_status
) VALUES (
    '$pelanggan_id', '$tgl', '$berat', '$tgl_selesai', '$harga', '$status'
)");

$last_id = mysqli_insert_id($koneksi); // ID dari transaksi terakhir

// Simpan log ke tabel 'log_transaksi' (tidak pakai jenis & jumlah pakaian)
mysqli_query($koneksi, "INSERT INTO log_transaksi (
    log_transaksi_id, log_pelanggan_id, log_tanggal
) VALUES (
    '$last_id', '$pelanggan_id', NOW()
)");

// Arahkan kembali ke halaman transaksi
header("Location: transaksi.php");
?>
