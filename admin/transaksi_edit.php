<?php 
include 'header.php';
include '../koneksi.php';
?>
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit Transaksi Laundry</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-8 col-md-offset-2">
                <a href="transaksi.php" class="btn btn-sm btn-info 
                pull-right">Kembali</a><br/><br/>
                <?php
                //menangkap id yang dikirim melalui url
                $id = $_GET['id']; //'transaksi_id'
                //mengambil data pelanggan yang ber-id diatas dari tabel pelanggan
                $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi where 
                transaksi_id='$id'");
                while($t=mysqli_fetch_array($transaksi)){
                    ?>
                    <form method="post" action="transaksi_update.php">
                    <!--menyimpan id transaksi yang diedit dalam form hidden berikut-->
                    <input type="hidden" name="id" value="<?php echo $t['transaksi_id'];?>">
                    
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select class="form-control" 
                        name="pelanggan" required="required">
                            <option value="">- Pilih Pelanggan</option>
                            <?php 
                            //mengambil data pelanggan dari database
                            $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                            //mengubah data ke array dan menampilkan nya dengan perulangan while
                            while($d = mysqli_fetch_array($data)){
                                ?>
                                <option <?php 
                                if($d['pelanggan_id'] == $t['transaksi_pelanggan']){
                                    echo "selected='selected'";
                                } ?> value="<?php echo $d['pelanggan_id'];?>">
                                <?php echo $d['pelanggan_nama'];?></option>
                            <?php }?>
                        </select>
                    </div><!--form-group-->

                    <div class="form-group">
                        <label>Berat</label>
                        <input type="number" class="form-control" name="berat" 
                        placeholder="Masukkan Berat Cucian .." required="required" 
                        value="<?php echo $t['transaksi_berat'];?>">
                    </div><!--form-group-->

                    <div class="form-group">
                        <label>Tgl. Selesai</label>
                        <input type="date" class="form-control" name="tgl_selesai" 
                        required="required" value="<?php echo $t['transaksi_tgl_selesai'];?>">
                    </div><br/><!--"form-group"-->

                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Jenis Pakaian</th>
                            <th width="20%">Jumlah</th>
                        </tr>
                        
                        <?php
                        //menyimpan id transaksi ke variabel id_transaksi
                        $id_transaksi = $t['transaksi_id'];
                        //menampilkan pakaian-pakaian dari transaksi ber-id diatas
                        $pakaian = mysqli_query($koneksi, "SELECT * from pakaian where 
                        pakaian_transaksi='$id_transaksi'");

                        while($p=mysqli_fetch_array($pakaian)){
                            ?>
                            <tr>
                                <td><input type="text" class="form-control" name="jenis_pakaian[]" 
                                value="<?php echo $p['pakaian_jenis'];?>"></td>
                                <td><input type="number" class="form-control" name="jumlah_pakaian[]" 
                                value="<?php echo $p['pakaian_jumlah'];?>"></td>
                            </tr>
                        <?php }?>
                        
                        <tr>
                            <td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
                            <td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
                            <td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
                            <td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="jenis_pakaian[]"></td>
                            <td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
                        </tr>
                    </table>
                    <div class="form-group alert alert-info">
                        <label>Status</label>
                        <select class="form-control" name="status" required="required">
                        <option <?php if($t['transaksi_status'] == "0"){echo "selected='selected'";}?> 
                        value="0">PROSES</option>
                        <option <?php if($t['transaksi_status']=="1"){echo "selected='selected'";}?> 
                        value="1">DI CUCI</option>
                        <option <?php if($t['transaksi_status']=="2"){echo "selected='selected'";}?> 
                        value="2">SELESAI</option>
                        </select>
                    </div><!--"form-group alert alert-info"-->
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    </form>
                <?php }?>
                
            </div>
        </div><!--End of Panel Body-->
    </div><!--End of Panel-->
</div><!--End of Container-->
<?php include 'footer.php';?>
