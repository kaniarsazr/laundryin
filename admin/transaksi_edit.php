<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white shadow-md rounded-xl p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Transaksi Laundry Baru</h2>
            <a href="transaksi.php" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-base transition">
                Kembali
            </a>
        </div>

        <form method="post" action="transaksi_aksi.php" class="space-y-6 text-lg">
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Pelanggan</label>
                <select name="pelanggan" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-3 text-base">
                    <option value="">- Pilih Pelanggan -</option>
                    <?php
                    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                    while($d = mysqli_fetch_array($data)){
                        echo "<option value='{$d['pelanggan_id']}'>{$d['pelanggan_nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label class="block mb-2 font-semibold text-gray-700">Berat (Kg)</label>
                <input type="number" name="berat" required placeholder="Masukkan berat cucian..." 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-3 text-base" />
            </div>

            <div>
                <label class="block mb-2 font-semibold text-gray-700">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" required 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-3 text-base" />
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Detail Jenis Pakaian</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border divide-y divide-gray-200 text-base">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="px-5 py-3 text-left">Jenis Pakaian</th>
                                <th class="px-5 py-3 text-left w-1/3">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php for($i = 0; $i < 5; $i++): ?>
                            <tr>
                                <td class="px-5 py-2">
                                    <input type="text" name="jenis_pakaian[]" 
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" />
                                </td>
                                <td class="px-5 py-2">
                                    <input type="number" name="jumlah_pakaian[]" 
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" />
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-right">
                <input type="submit" value="Simpan" 
                       class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold shadow transition">
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
