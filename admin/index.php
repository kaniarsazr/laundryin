<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<!-- Pesan Selamat Datang -->
<div class="container-content text-center">
  <h2 class="text-primary"><i class="glyphicon glyphicon-home"></i> Selamat Datang di <b>LaundryIn</b></h2>
  <p class="text-muted">Kelola Cucian Anda dengan Mudah & Cepat.</p>
</div>

<div class="container">

  <!-- Panel Statistik -->
  <div class="panel mt-3">
    <div class="panel-heading">
      <h4>Dashboard</h4>
    </div>
    <div class="panel-body">
      <div class="row">

        <!-- Jumlah Pelanggan -->
        <div class="col-md-3">
          <div class="panel panel-primary">
            <div class="panel-heading text-center">
              <h1>
                <i class="glyphicon glyphicon-user"></i><br>
                <span>
                  <?php 
                    $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                    echo mysqli_num_rows($pelanggan);
                  ?>
                </span>
              </h1>
              <div>Jumlah Pelanggan</div>
            </div>
          </div>
        </div>

        <!-- Cucian Di Proses -->
        <div class="col-md-3">
          <div class="panel panel-warning">
            <div class="panel-heading text-center">
              <h1>
                <i class="glyphicon glyphicon-retweet"></i><br>
                <span>
                  <?php
                    $proses = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_status='0'");
                    echo mysqli_num_rows($proses);
                  ?>
                </span>
              </h1>
              <div>Cucian Diproses</div>
            </div>
          </div>
        </div>

        <!-- Cucian Siap Ambil -->
        <div class="col-md-3">
          <div class="panel panel-info">
            <div class="panel-heading text-center">
              <h1>
                <i class="glyphicon glyphicon-info-sign"></i><br>
                <span>
                  <?php
                    $siap = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_status='1'");
                    echo mysqli_num_rows($siap);
                  ?>
                </span>
              </h1>
              <div>Siap Diambil</div>
            </div>
          </div>
        </div>

        <!-- Cucian Selesai -->
        <div class="col-md-3">
          <div class="panel panel-success">
            <div class="panel-heading text-center">
              <h1>
                <i class="glyphicon glyphicon-ok-circle"></i><br>
                <span>
                  <?php 
                    $selesai = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_status='2'");
                    echo mysqli_num_rows($selesai);
                  ?>
                </span>
              </h1>
              <div>Selesai</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Panel Riwayat Transaksi -->
  <div class="panel mt-4">
    <div class="panel-heading">
      <h4>Riwayat Transaksi Terakhir</h4>
    </div>
    <div class="panel-body">
      <table class="table table-bordered table-hover">
        <thead style="background-color:#0275d8; color:white;">
          <tr>
            <th width="5%">No</th>
            <th>Invoice</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Berat (Kg)</th>
            <th>Tgl. Selesai</th>
            <th>Harga</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $data = mysqli_query($koneksi, "
              SELECT * FROM pelanggan, transaksi 
              WHERE transaksi_pelanggan = pelanggan_id 
              ORDER BY transaksi_id DESC LIMIT 7
            ");
            $no = 1;
            while($d = mysqli_fetch_array($data)) {
              $rowClass = "";
              if ($d['transaksi_status'] == "0") {
                $rowClass = "status-proses";
              } elseif ($d['transaksi_status'] == "1") {
                $rowClass = "status-dicuci";
              } elseif ($d['transaksi_status'] == "2") {
                $rowClass = "status-selesai";
              }
          ?>
          <tr class="<?= $rowClass ?>">
            <td><?= $no++ ?></td>
            <td><strong>INVOICE-<?= $d['transaksi_id'] ?></strong></td>
            <td><?= $d['transaksi_tgl'] ?></td>
            <td><?= $d['pelanggan_nama'] ?></td>
            <td><?= $d['transaksi_berat'] ?> Kg</td>
            <td><?= $d['transaksi_tgl_selesai'] ?></td>
            <td><?= "Rp. " . number_format($d['transaksi_harga'], 0, ',', '.') ?></td>
            <td>
              <?php 
                if($d['transaksi_status']=="0"){
                  echo "<span class='label label-warning'>PROSES</span>";
                } elseif($d['transaksi_status']=="1"){
                  echo "<span class='label label-info'>DICUCI</span>";
                } elseif($d['transaksi_status']=="2"){
                  echo "<span class='label label-success'>SELESAI</span>";
                }
              ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <p class="text-muted"><small>Menampilkan maksimal 7 transaksi terakhir</small></p>
    </div>
  </div>

</div>

<?php include 'footer.php'; ?>
