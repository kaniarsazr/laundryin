<?php include 'header.php'; ?>

<div class="flex justify-center mt-16">
    <div class="w-full max-w-xl bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Pelanggan</h2>

        <?php
        include '../koneksi.php';
        $id = $_GET['id'];
        $data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelanggan_id = '$id'");
        while($d = mysqli_fetch_array($data)) {
        ?>
        <form method="post" action="pelanggan_update.php" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $d['pelanggan_id']; ?>">

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="nama" placeholder="Masukkan Nama .."
                    value="<?php echo $d['pelanggan_nama']; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">HP</label>
                <input type="number" name="hp" placeholder="Masukkan No. HP .."
                    value="<?php echo $d['pelanggan_hp']; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Alamat</label>
                <input type="text" name="alamat" placeholder="Masukkan Alamat .."
                    value="<?php echo $d['pelanggan_alamat']; ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="pt-4">
                <input type="submit" value="Simpan"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 cursor-pointer">
            </div>
        </form>
        <?php } ?>
    </div>
</div>

<?php include 'footer.php'; ?>
