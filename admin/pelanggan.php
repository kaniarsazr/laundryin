<?php include 'header.php'; ?>
<!-- Sudah otomatis terbungkus oleh <div class="max-w-7xl mx-auto p-6"> dari header.php -->

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold">Data Pelanggan</h2>
    <a href="pelanggan_tambah.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah
    </a>
</div>


<div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-medium">No</th>
                <th class="px-4 py-3 text-left text-sm font-medium">Nama</th>
                <th class="px-4 py-3 text-left text-sm font-medium">HP</th>
                <th class="px-4 py-3 text-left text-sm font-medium">Alamat</th>
                <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                <th class="px-4 py-3 text-left text-sm font-medium">OPSI</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 text-sm">
            <?php
            include '../koneksi.php';
            $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
            $no = 1;
            while($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td class="px-4 py-2"><?php echo $no++; ?></td>
                <td class="px-4 py-2"><?php echo $d['pelanggan_nama']; ?></td>
                <td class="px-4 py-2"><?php echo $d['pelanggan_hp']; ?></td>
                <td class="px-4 py-2"><?php echo $d['pelanggan_alamat']; ?></td>
                <td class="px-4 py-2"><?php echo $d['pelanggan_status']; ?></td>
                <td class="px-4 py-2 space-x-2">
                                    <!-- Tombol Edit -->
                <a href="pelanggan_edit.php?id=<?php echo $d['pelanggan_id']; ?>" 
                class="px-2 py-2 bg-blue-600 hover:bg-green-700 text-white font-semibold px-4 py-1.5 rounded-full text-xs md:text-sm transition">
                ✏ Edit
                </a>

                <!-- Tombol Hapus -->
                <a href="pelanggan_hapus.php?id=<?php echo $d['pelanggan_id']; ?>" 
                onclick="return confirm('Yakin ingin menghapus?')"
                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-full text-xs md:text-sm transition">
                🗑 Hapus
                </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
