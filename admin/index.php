<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="container mt-4">
  <div class="card shadow rounded-4 bg-white text-black border-0 p-4 d-flex flex-md-row align-items-center justify-content-between">
    <div>
      <h1 class="fw-bold mb-2" style="font-size: 2.2rem;">Selamat Datang 👋</h1>
      <p class="mb-0" style="font-size: 1.1rem; color: #555;">
	  <span class="fw-semibold text-dark">  Di  Sistem Informasi LaundryIn</span><br>
	  <span class="fw-semibold text-dark">  Kelola cucian Anda dengan mudah & cepat!</span><br>
      </p>
    </div>
    <div class="d-none d-md-block">
      <img src="https://img.freepik.com/vector-premium/criada-lavanderia-preparara-ropa_78118-211.jpg?w=2000" alt="Welcome Illustration" width="130" style="border-radius: 1rem;">
    </div>
  </div>
</div>





	<!-- Statistik -->
	<div class="row mt-4 g-4">
		<?php
			$stat = [
				['title' => 'Pelanggan', 'icon' => 'bi-people-fill', 'color' => 'primary', 'query' => "SELECT * FROM pelanggan"],
				['title' => 'Proses', 'icon' => 'bi-arrow-repeat', 'color' => 'warning', 'query' => "SELECT * FROM transaksi WHERE transaksi_status='0'"],
				['title' => 'Siap Ambil', 'icon' => 'bi-info-circle', 'color' => 'info', 'query' => "SELECT * FROM transaksi WHERE transaksi_status='1'"],
				['title' => 'Selesai', 'icon' => 'bi-check-circle', 'color' => 'success', 'query' => "SELECT * FROM transaksi WHERE transaksi_status='2'"],
			];
			foreach ($stat as $s):
				$count = mysqli_num_rows(mysqli_query($koneksi, $s['query']));
		?>
		<div class="col-md-3 col-sm-6">
			<div class="card bg-<?= $s['color']; ?> text-white shadow h-100 rounded-4">
				<div class="card-body d-flex justify-content-between align-items-center">
					<div>
						<h5 class="card-title mb-1"><i class="bi <?= $s['icon']; ?>"></i> <?= $s['title']; ?></h5>
						<span class="fs-4 fw-bold"><?= $count; ?></span>
					</div>
					<i class="bi <?= $s['icon']; ?> fs-1 opacity-25"></i>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>

	<!-- Riwayat Transaksi -->
	<div class="card mt-5 shadow rounded-4">
		<div class="card-header bg-dark text-white py-3 rounded-top-4">
			<h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Transaksi Terakhir</h5>
		</div>
		<div class="card-body p-4">
			<div class="table-responsive">
				<table class="table table-bordered table-hover align-middle text-center">
					<thead class="table-light">
						<tr>
							<th>No</th>
							<th>Invoice</th>
							<th>Tanggal</th>
							<th>Pelanggan</th>
							<th>Berat (Kg)</th>
							<th>Tgl. Selesai</th>
							<th>Harga</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php 
						$data = mysqli_query($koneksi, "SELECT * FROM pelanggan, transaksi WHERE transaksi_pelanggan = pelanggan_id ORDER BY transaksi_id DESC LIMIT 7");
						$no = 1;
						while($d = mysqli_fetch_array($data)) {
						?>
						<tr>
							<td><?= $no++; ?></td>
							<td><span class="fw-bold text-primary">INV-<?= $d['transaksi_id']; ?></span></td>
							<td><?= $d['transaksi_tgl']; ?></td>
							<td><?= $d['pelanggan_nama']; ?></td>
							<td><?= $d['transaksi_berat']; ?></td>
							<td><?= $d['transaksi_tgl_selesai']; ?></td>
							<td><span class="text-success fw-semibold">Rp. <?= number_format($d['transaksi_harga']); ?></span></td>
							<td>
								<?php 
								switch ($d['transaksi_status']) {
									case '0':
										echo "<span class='badge rounded-pill bg-warning text-dark px-3 py-2'>PROSES</span>";
										break;
									case '1':
										echo "<span class='badge rounded-pill bg-info text-dark px-3 py-2'>DICUCI</span>";
										break;
									case '2':
										echo "<span class='badge rounded-pill bg-success px-3 py-2'>SELESAI</span>";
										break;
								}
								?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<p class="text-muted mt-2 mb-0"><small>Menampilkan 7 transaksi terbaru</small></p>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
