<?php 
include 'header.php';
include '../koneksi.php';
?>

<div class="container-content">
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-primary"><i class="glyphicon glyphicon-edit"></i> Edit Transaksi Laundry</h3>
      <hr>
      <a href="transaksi.php" class="btn btn-sm btn-info pull-right"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a><br><br>

      <?php
      $id = $_GET['id'];
      $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_id='$id'");
      while($t = mysqli_fetch_array($transaksi)) {
      ?>
      <form method="post" action="transaksi_update.php">
        <input type="hidden" name="id" value="<?php echo $t['transaksi_id']; ?>">

        <div class="form-group">
          <label for="pelanggan">Pelanggan</label>
          <select name="pelanggan" class="form-control" required>
            <option value="">- Pilih Pelanggan -</option>
            <?php 
            $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
            while($d = mysqli_fetch_array($data)) {
              $selected = ($d['pelanggan_id'] == $t['transaksi_pelanggan']) ? "selected" : "";
              echo "<option value='$d[pelanggan_id]' $selected>$d[pelanggan_nama]</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label>Berat (Kg)</label>
          <input type="number" name="berat" class="form-control" required value="<?php echo $t['transaksi_berat']; ?>">
        </div>

        <div class="form-group">
          <label>Tanggal Selesai</label>
          <input type="date" name="tgl_selesai" class="form-control" required value="<?php echo $t['transaksi_tgl_selesai']; ?>">
        </div>

        <h4>Detail Pakaian</h4>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Jenis Pakaian</th>
              <th width="20%">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $id_transaksi = $t['transaksi_id'];
            $pakaian = mysqli_query($koneksi, "SELECT * FROM pakaian WHERE pakaian_transaksi='$id_transaksi'");
            while($p = mysqli_fetch_array($pakaian)) {
              echo "
              <tr>
                <td><input type='text' name='jenis_pakaian[]' value='$p[pakaian_jenis]' class='form-control'></td>
                <td><input type='number' name='jumlah_pakaian[]' value='$p[pakaian_jumlah]' class='form-control'></td>
              </tr>";
            }
            // Tambahan baris kosong
            for($i=0;$i<4;$i++) {
              echo "
              <tr>
                <td><input type='text' name='jenis_pakaian[]' class='form-control'></td>
                <td><input type='number' name='jumlah_pakaian[]' class='form-control'></td>
              </tr>";
            }
            ?>
          </tbody>
        </table>

        <div class="form-group">
          <label>Status</label>
          <select name="status" class="form-control" required>
            <option value="0" <?= $t['transaksi_status'] == "0" ? "selected" : "" ?>>PROSES</option>
            <option value="1" <?= $t['transaksi_status'] == "1" ? "selected" : "" ?>>DI CUCI</option>
            <option value="2" <?= $t['transaksi_status'] == "2" ? "selected" : "" ?>>SELESAI</option>
          </select>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
        </div>
      </form>
      <?php } ?>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
