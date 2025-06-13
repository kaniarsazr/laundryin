<?php
//mengaktifkan session php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($koneksi, "SELECT * FROM admin where username='$username' and
password='$password'");
//menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
if($cek>0){
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:admin/index.php");
}else{
    header("location:index.php?pesan=gagal");
}
?>