<?php
//menghubungkan dengan database
include '../koneksi.php';

//menangkap data yang dikirim dari form
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];

//input data ke tabel pelanggan
mysqli_query($koneksi, "INSERT INTO pelanggan 
(pelanggan_nama, pelanggan_hp, pelanggan_alamat, pelanggan_status) 
VALUES('$nama', '$hp', '$alamat', 'Nonaktif')");

header("location:pelanggan.php");
?>
