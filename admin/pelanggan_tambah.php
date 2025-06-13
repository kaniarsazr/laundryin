<?php include 'header.php';?>

<div class="container">
    <br/><br/><br/>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel">
            <div class="panel-heading">
                Tambah Pelanggan baru
            </div>

            <div class="panel-body">
                <form method="post" action="pelanggan_aksi.php">
                    <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control"
                    name="nama" placeholder="Masukkan Nama ..">
                    </div>
                    <div class="form-group">

                    <label>HP</label>
                    <input type="text" class="form-control"
                    name="hp" placeholder="Masukkan No.Hp ..">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control"
                        name="alamat" placeholder="Masukkan Alamat ..">
                    </div><br/>

                    <input type="submit" class="btn btn-primary"
                    value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div><!--End of container-->