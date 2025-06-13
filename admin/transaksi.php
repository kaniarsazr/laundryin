<?php include 'header.php'; ?>

<div class="px-6 py-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Data Transaksi Laundry</h2>
            <a href="transaksi_tambah.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Transaksi Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold">No</th>
                        <th class="px-4 py-2 text-left font-semibold">Invoice</th>
                        <th class="px-4 py-2 text-left font-semibold">Tanggal</th>
                        <th class="px-4 py-2 text-left font-semibold">Pelanggan</th>
                        <th class="px-4 py-2 text-left font-semibold">Berat (Kg)</th>
                        <th class="px-4 py-2 text-left font-semibold">Tgl. Selesai</th>
                        <th class="px-4 py-2 text-left font-semibold">Harga</th>
                        <th class="px-4 py-2 text-left font-semibold">Status</th>
                        <th class="px-4 py-2 text-center font-semibold">Opsi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan, transaksi WHERE transaksi_pelanggan = pelanggan_id ORDER BY transaksi_id DESC");
                    $no = 1;
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2"><?php echo $no++; ?></td>
                        <td class="px-4 py-2 font-mono">INVOICE-<?php echo $d['transaksi_id']; ?></td>
                        <td class="px-4 py-2"><?php echo $d['transaksi_tgl']; ?></td>
                        <td class="px-4 py-2"><?php echo $d['pelanggan_nama']; ?></td>
                        <td class="px-4 py-2"><?php echo $d['transaksi_berat']; ?></td>
                        <td class="px-4 py-2"><?php echo $d['transaksi_tgl_selesai']; ?></td>
                        <td class="px-4 py-2"><?php echo "Rp. ".number_format($d['transaksi_harga'])." ,-"; ?></td>
                        <td class="px-4 py-2">
                            <?php
                            if($d['transaksi_status'] == "0"){
                                echo "<span class='px-2 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-1.5 rounded-full text-xs md:text-sm transition'>PROSES</span>";
                            } else if($d['transaksi_status'] == "1"){
                                echo "<span class='px-2 py-2 bg-blue-600 hover:bg-yellow-700 text-white font-semibold px-4 py-1.5 rounded-full text-xs md:text-sm transition'>DICUCI</span>";
                            } else if($d['transaksi_status'] == "2"){
                                echo "<span class='px-2 py-2 bg-blue-600 hover:bg-green-700 text-white font-semibold px-4 py-1.5 rounded-full text-xs md:text-sm transition'>SELESAI</span>";
                            }
                            ?>
                        </td>
                        <td class="px-4 py-2 text-center">
    <div class="flex flex-col md:flex-row justify-center items-center gap-2">
        <a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank"
           class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-1.5 rounded-full text-xs md:text-sm transition">
            🧾 Invoice
        </a>
        <a href="transaksi_edit.php?id=<?php echo $d['transaksi_id']; ?>"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-1.5 rounded-full text-xs md:text-sm transition">
            ✏️ Edit
        </a>
        <a href="transaksi_hapus.php?id=<?php echo $d['transaksi_id']; ?>"
           onclick="return confirm('Yakin ingin membatalkan transaksi ini?')"
           class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-1.5 rounded-full text-xs md:text-sm transition">
            ❌ Batalkan
        </a>
    </div>
</td>

        </a>
    </div>
</td>

                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
