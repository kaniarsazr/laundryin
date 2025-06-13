<?php
include 'header.php';
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Transaksi Baru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f7fa;
    }
    .form-container {
      max-width: 650px;
      margin: 50px auto;
      background: white;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .form-label {
      font-weight: 500;
    }
    .form-control {
      font-size: 16px;
      padding: 12px;
      border-radius: 8px;
    }
    .btn-submit {
      padding: 12px 30px;
      font-size: 16px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h3 class="text-center mb-4">🧺 Tambah Transaksi Laundry</h3>
  <form method="post" action="transaksi_aksi.php">

    <!-- Pelanggan -->
    <div class="mb-3">
      <label for="pelanggan" class="form-label">Pelanggan</label>
      <select class="form-select" name="pelanggan" id="pelanggan" required>
        <option value="">- Pilih Pelanggan -</option>
        <?php
        $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($p = mysqli_fetch_array($pelanggan)) {
            echo "<option value='".$p['pelanggan_id']."'>".$p['pelanggan_nama']."</option>";
        }
        ?>
      </select>
    </div>

    <!-- Berat dan Tanggal -->
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="berat" class="form-label">Berat (kg)</label>
        <input type="number" class="form-control" name="berat" id="berat" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="tgl_selesai" class="form-label">Tgl. Selesai</label>
        <input type="date" class="form-control" name="tgl_selesai" id="tgl_selesai" required>
      </div>
    </div>

    <!-- Jenis Pakaian (3 baris) -->
    <div class="mb-3">
      <label class="form-label">Jenis Pakaian</label>
      <div class="row mb-2">
        <div class="col-8">
          <input type="text" class="form-control" name="jenis_pakaian[]" placeholder="Contoh: Kemeja">
        </div>
        <div class="col-4">
          <input type="number" class="form-control" name="jumlah_pakaian[]" placeholder="Jumlah">
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-8">
          <input type="text" class="form-control" name="jenis_pakaian[]" placeholder="Contoh: Celana">
        </div>
        <div class="col-4">
          <input type="number" class="form-control" name="jumlah_pakaian[]" placeholder="Jumlah">
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-8">
          <input type="text" class="form-control" name="jenis_pakaian[]" placeholder="Contoh: Jaket">
        </div>
        <div class="col-4">
          <input type="number" class="form-control" name="jumlah_pakaian[]" placeholder="Jumlah">
        </div>
      </div>
    </div>

    <!-- Tombol Simpan -->
    <div class="d-grid">
      <button type="submit" class="btn btn-success btn-submit">
        💾 Simpan Transaksi
      </button>
    </div>

  </form>
</div>

</body>
</html>
