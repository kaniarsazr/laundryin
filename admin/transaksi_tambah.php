<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel panel-default shadow" style="margin-top: 30px; border-radius: 10px;">
        <div class="panel-heading" style="background: linear-gradient(to right, #0275d8, #5bc0de); color: white; border-radius: 10px 10px 0 0;">
            <h3 class="panel-title text-center" style="font-weight: bold;">🧺 Transaksi Laundry Baru</h3>
        </div>

        <div class="panel-body" style="padding: 30px;">
            <div class="col-md-10 col-md-offset-1">
                <a href="transaksi.php" class="btn btn-info btn-sm pull-right" style="margin-bottom: 20px;">
                    <i class="glyphicon glyphicon-arrow-left"></i> Kembali
                </a>

                <form method="post" action="transaksi_aksi.php">
                    <!-- PILIH PELANGGAN -->
                    <div class="form-group">
                        <label><i class="glyphicon glyphicon-user"></i> Pelanggan</label>
                        <select class="form-control" name="pelanggan" required>
                            <option value="">- Pilih Pelanggan -</option>
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                            while($d = mysqli_fetch_array($data)){
                                echo "<option value='$d[pelanggan_id]'>$d[pelanggan_nama]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- BERAT -->
                    <div class="form-group">
                        <label><i class="glyphicon glyphicon-scale"></i> Berat (Kg)</label>
                        <input type="number" min="1" class="form-control" name="berat" placeholder="Masukkan Berat Cucian..." required>
                    </div>

                    <!-- TGL SELESAI -->
                    <div class="form-group">
                        <label><i class="glyphicon glyphicon-calendar"></i> Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tgl_selesai" required>
                    </div>

                    <hr>

                    <!-- TABEL PAKAIAN -->
                    <label><i class="glyphicon glyphicon-list-alt"></i> Jenis Pakaian & Jumlah</label>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="background: #fcfcfc;">
                            <thead style="background-color: #0275d8; color: white;">
                                <tr>
                                    <th>Jenis Pakaian</th>
                                    <th width="20%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 10; $i++) { ?>
                                    <tr>
                                        <td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
                                        <td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- TOMBOL SIMPAN -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="glyphicon glyphicon-floppy-disk"></i> Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
