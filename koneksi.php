<?php
$koneksi = mysqli_connect("localhost", "root", "", "laundry");

//check connection
if(mysqli_connect_errno()){
    echo "Koneksi Database Gagal: ".mysqli_connect_error();
}
?>