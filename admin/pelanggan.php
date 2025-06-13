<?php include 'header.php'; ?>

<style>
    body {
        background-color: #f4f6f9;
    }

    .panel {
        background: linear-gradient(to bottom right, #ffffff, #f8faff);
        border: none;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .panel-title {
        text-align: center;
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 26px;
        color: #333;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .btn-add {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 30px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        padding: 10px 25px;
        box-shadow: 0 3px 6px rgba(0,123,255,0.3);
        color: white;
        transition: 0.2s;
    }

    .btn-add:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 10px rgba(0,123,255,0.4);
    }

    .table {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        background-color: #ffffff;
    }

    .table > thead > tr {
        background-color: #e8f0fe;
        color: #333;
    }

    .table > tbody > tr:hover {
        background-color: #f1f7ff;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
    }

    .badge.active { background-color: #28a745; color: #fff; }
    .badge.inactive { background-color: #dc3545; color: #fff; }
</style>

<div class="container">
    <div class="panel">
        <!-- Judul Tengah -->
        <h4 class="panel-title"><i class="glyphicon glyphicon-user"></i> Data Pelanggan</h4>

        <!-- Tombol Tambah -->
        <div class="text-right mb-3">
            <a href="pelanggan_tambah.php" class="btn btn-add">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>

        <!-- Isi Tabel -->
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Nama</th>
                        <th>HP</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th width="15%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                    $no = 1;
                    while($d = mysqli_fetch_array($data)){
                        $status = strtolower($d['pelanggan_status']) == 'aktif' ? 
                            '<span class="badge active">Aktif</span>' : 
                            '<span class="badge inactive">Tidak Aktif</span>';
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['pelanggan_nama']; ?></td>
                            <td><?php echo $d['pelanggan_hp']; ?></td>
                            <td><?php echo $d['pelanggan_alamat']; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <a href="pelanggan_edit.php?id=<?php echo $d['pelanggan_id']; ?>" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="pelanggan_hapus.php?id=<?php echo $d['pelanggan_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus pelanggan <?php echo $d['pelanggan_nama']; ?>?')">
                                    <i class="fa fa-trash-alt"></i> Hapus
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
