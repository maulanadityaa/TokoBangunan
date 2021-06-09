 <div class="container">
     <div><br><?php foreach ($id_barang as $maxId) { ?></div>
     <div class="card bg-light mb-3 o-hidden border-0 shadow-lg my-5">
         <div class="card-header bg-primary">
             <ul class="nav nav-tabs card-header-tabs" role="tablist" id="myTab">
                 <li class="nav-item">
                     <a class="nav-link  bg-light  active" href="<?php echo base_url(); ?>libra/create">
                         <h4>Tambah Barang</h4>
                     </a>
                 </li>
             </ul>
         </div>
         <div class="card-body">
             <form method="post" action="<?php echo base_url(); ?>libra/create_process">
                 <div class="form-group">
                     <label for="id_buku">ID Barang</label>
                     <input type="number" class="form-control" id="id_barang" name="id_barang" value="<?= $maxId->id_barang + 1;} ?>">
                     <small class="text-danger"><?= form_error('id_barang'); ?></small>
                 </div>

                 <div class="form-group">
                     <label for="jenis_barang">Nama Barang</label>
                     <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="<?= set_value('jenis_barang'); ?>">
                     <small class="text-danger"><?= form_error('jenis_barang'); ?></small>
                 </div>

                 <div class="form-group">
                     <label for="merk_barang">Merk Barang</label>
                     <input type="text" class="form-control" id="merk_barang" name="merk_barang" value="<?= set_value('merk_barang'); ?>">
                     <small class="text-danger"><?= form_error('merk_barang'); ?></small>
                 </div>

                 <div class="form-group">
                     <label for="ukuran">Ukuran</label>
                     <input type="text" class="form-control" id="ukuran" name="ukuran" value="<?= set_value('ukuran'); ?>">
                     <small class="text-danger"><?= form_error('ukuran'); ?></small>
                 </div>

                 <div class="form-group">
                     <label for="stock">Stock</label>
                     <input type="number" class="form-control" id="stock" name="stock" value="<?= set_value('stock'); ?>">
                     <small class="text-danger"><?= form_error('stock'); ?></small>
                 </div>

                 <div class="form-group">
                     <label for="harga">Harga</label>
                     <input type="number" class="form-control" id="harga" name="harga" value="<?= set_value('harga'); ?>">
                     <small class="text-danger"><?= form_error('harga'); ?></small>
                 </div>

                 <p align="right"><button type="submit" class="btn btn-outline-primary">Tambah</button>
                     <a href="<?php echo base_url(); ?>libra/" class="btn btn-outline-warning">Kembali</a></p>
             </form>
         </div>
     </div>
 </div>