<?php include 'header.php'; ?>

<div class="min-h-screen bg-gray-100 py-10 px-4">
  <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🧾 Tambah Pelanggan Baru</h2>

    <form method="post" action="pelanggan_aksi.php" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama..."
          class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">HP</label>
        <input type="text" name="hp" placeholder="Masukkan No. HP..."
          class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
        <input type="text" name="alamat" placeholder="Masukkan Alamat..."
          class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div class="pt-4">
        <button type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
          💾 Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>
