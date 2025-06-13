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

    .panel-heading {
        text-align: center;
        margin-bottom: 30px;
    }

    .panel-heading h4 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 26px;
        color: #333;
        margin: 0;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .btn {
        border-radius: 4px;
        font-family: 'Poppins', sans-serif;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
    }

    .btn-info {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        box-shadow: 0 2px 4px rgba(0,123,255,0.4);
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
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

    .badge.proses { background-color: #ffc107; color: #000; }
    .badge.dicuci { background-color: #17a2b8; color: #fff; }
    .badge.selesai { background-color: #28a745; color: #fff; }

    .top-btn-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 15px;
    }
</style>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Transaksi Laundry</h4>
        </div>

        <div class="panel-body">
            <div class="top-btn-container">
                <a href="transaksi_tambah.php" class="btn btn-info btn-sm" style="font-size: 14px; padding: 10px 20px;">
                    <i class="fa fa-plus"></i> Transaksi Baru
                </a>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="1%">No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Berat (Kg)</th>
                        <th>Tgl. Selesai</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="22%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan,transaksi WHERE transaksi_pelanggan=pelanggan_id ORDER BY transaksi_id DESC");
                    $no = 1;
                    while($d = mysqli_fetch_array($data)){
                        $statusBadge = "";
                        if($d['transaksi_status'] == "0"){
                            $statusBadge = "<span class='badge proses'>PROSES</span>";
                        } else if($d['transaksi_status'] == "1"){
                            $statusBadge = "<span class='badge dicuci'>DICUCI</span>";
                        } else if($d['transaksi_status'] == "2"){
                            $statusBadge = "<span class='badge selesai'>SELESAI</span>";
                        }
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>INVOICE-<?php echo $d['transaksi_id']; ?></td>
                        <td><?php echo $d['transaksi_tgl']; ?></td>
                        <td><?php echo $d['pelanggan_nama']; ?></td>
                        <td class="text-center"><?php echo $d['transaksi_berat']; ?></td>
                        <td><?php echo $d['transaksi_tgl_selesai']; ?></td>
                        <td><?php echo "Rp. ".number_format($d['transaksi_harga'])." ,-"; ?></td>
                        <td class="text-center"><?php echo $statusBadge; ?></td>
                        <td>
                            <a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank"
                               class="btn btn-warning btn-sm mb-1" title="Lihat Invoice">
                                <i class="fa fa-file-invoice-dollar"></i> Invoice
                            </a>
                            <a href="transaksi_edit.php?id=<?php echo $d['transaksi_id']; ?>"
                               class="btn btn-info btn-sm mb-1" title="Edit Transaksi">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="transaksi_hapus.php?id=<?php echo $d['transaksi_id']; ?>"
                               class="btn btn-danger btn-sm mb-1"
                               onclick="return confirm('Yakin ingin membatalkan transaksi ini?')"
                               title="Batalkan Transaksi">
                                <i class="fa fa-ban"></i> Batal
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
