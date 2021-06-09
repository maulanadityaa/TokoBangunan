<script src="assets/js/jquery.js"></script>
<div class="container">
    <div><br></div>
    <div class="card bg-light mb-3 o-hidden border-0 shadow-lg my-5">
        <?php foreach ($libra as $row) { ?>
            <div class="card-header text-white bg-primary ">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link bg-light" href="<?php echo base_url(); ?>libra/update/<?php echo $row->id_barang ?>">
                            <h4>Beli Barang</h4>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url(); ?>libra/beli_process">

                    <div class="form-group">
                        <label for="id_barang">ID Barang</label>
                        <input type="number" class="form-control" id="id_barang" name="id_barang" value="<?= $row->id_barang ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="jenis_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="<?= $row->jenis_barang ?>" readonly>
                        <small class="text-danger"><?= form_error('jenis_barang'); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="merk_barang">Merk Barang</label>
                        <input type="text" class="form-control" id="merk_barang" name="merk_barang" value="<?= $row->merk_barang ?>" readonly>
                        <small class="text-danger"><?= form_error('merk_barang'); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="ukuran">Ukuran</label>
                        <input type="text" class="form-control" id="ukuran" name="ukuran" value="<?= $row->ukuran ?>" readonly>
                        <small class="text-danger"><?= form_error('ukuran'); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="<?= $row->stock ?>" readonly>
                        <small class="text-danger"><?= form_error('stock'); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value=" ">
                        <small class="text-danger"><?= form_error('jumlah'); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="<?= $row->harga ?>" readonly>
                        <small class="text-danger"><?= form_error('harga'); ?></small>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_harga">Total Harga</label>
                        <input type="number" class="form-control" id="jumlah_harga" name="jumlah_harga" value="0" readonly>
                        <small class="text-danger"><?= form_error('jumlah_harga'); ?></small>
                    </div>

                    <p align="right"><button type="submit" class="btn btn-outline-primary">Beli</button>
                        <a href="<?php echo base_url(); ?>libra/" class="btn btn-outline-warning">Kembali</a></p>
                <?php } ?>
                </form>
            </div>
    </div>
</div>

<script type="text/javascript">
 $("#jumlah").keyup(function(){
 total = $("#jumlah").val()* $("#harga").val();
 $("#jumlah_harga").val(total);
 });

 $("#stock").keyup(function(){
 sisa = $("#stock").val()- $("#jumlah").val();
 $("#stock").val(sisa);
 })
</script>