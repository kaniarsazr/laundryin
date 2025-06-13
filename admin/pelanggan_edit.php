<?php include 'header.php'; ?>

<style>
    .custom-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 30px;
        margin-top: 60px;
    }

    .custom-card .card-title {
        font-weight: 600;
        font-size: 20px;
        color: #0275d8;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
        margin-bottom: 25px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: 0.3s ease;
    }

    .form-control:focus {
        border-color: #5bc0de;
        box-shadow: 0 0 0 2px rgba(91,192,222,0.2);
    }

    .btn-primary {
        background: linear-gradient(to right, #0275d8, #1891f5, #5bc0de);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 25px;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #1891f5, #0275d8);
    }
</style>

<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="custom-card">
            <div class="card-title">
                <i class="fa fa-user-edit"></i> Edit Data Pelanggan
            </div>

            <?php
                include '../koneksi.php';
                $id = $_GET['id'];
                $data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelanggan_id = '$id'");
                while($d = mysqli_fetch_array($data)) {
            ?>
            <form method="post" action="pelanggan_update.php">
                <input type="hidden" name="id" value="<?php echo $d['pelanggan_id']; ?>">

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama .."
                           value="<?php echo $d['pelanggan_nama']; ?>" required>
                </div>

                <div class="form-group">
                    <label>HP</label>
                    <input type="number" class="form-control" name="hp" placeholder="Masukkan No.HP .."
                           value="<?php echo $d['pelanggan_hp']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat .."
                           value="<?php echo $d['pelanggan_alamat']; ?>" required>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
