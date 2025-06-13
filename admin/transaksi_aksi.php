<?php
include '../koneksi.php';

$pelanggan = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tgl_selesai = $_POST['tgl_selesai'];
$tgl_transaksi = date('Y-m-d');

$jenis = $_POST['jenis_pakaian'];
$jumlah = $_POST['jumlah_pakaian'];

// Mulai Transaction
mysqli_begin_transaction($koneksi);

try {
    // Simpan data transaksi via prosedur
    $query = "CALL tambah_transaksi('$tgl_transaksi', '$pelanggan', '$berat', '$tgl_selesai')";
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        throw new Exception("Gagal menambah transaksi utama: " . mysqli_error($koneksi));
    }

    // Ambil ID transaksi terakhir (tergantung cara kamu menyimpannya)
    $getId = mysqli_query($koneksi, "SELECT MAX(transaksi_id) AS id FROM transaksi");
    $row = mysqli_fetch_assoc($getId);
    $transaksi_id = $row['id'];

    // Simpan pakaian
    for ($i = 0; $i < count($jenis); $i++) {
        $jns = mysqli_real_escape_string($koneksi, $jenis[$i]);
        $jml = intval($jumlah[$i]);

        if (!empty($jns) && $jml > 0) {
            $sql = "INSERT INTO pakaian (pakaian_transaksi, pakaian_jenis, pakaian_jumlah) 
                    VALUES ('$transaksi_id', '$jns', '$jml')";
            if (!mysqli_query($koneksi, $sql)) {
                throw new Exception("Gagal simpan pakaian: " . mysqli_error($koneksi));
            }
        }
    }

    // Commit jika semua berhasil
    mysqli_commit($koneksi);
    header("Location: transaksi.php");

} catch (Exception $e) {
    // Rollback jika ada error
    mysqli_rollback($koneksi);
    echo "Transaksi gagal: " . $e->getMessage();
}
?>
