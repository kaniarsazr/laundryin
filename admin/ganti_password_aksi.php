<?php
//Menghubungkan dengan koneksi
include '../koneksi.php';

//menangkap data yang dikirim dari form
$password_baru = md5($_POST['password_baru']);

//mengupdate data password pada table admin
mysqli_query($koneksi, "update admin set password='$password_baru'");

header("location:ganti_password.php?pesan=oke");
?>