<main role="main" class="container">
    <div>
        <div><br>
            <?php
            $role = $this->session->role;
            $kondisi = $this->session->kondisi;
            ?>
        </div>
        <div class="card bg-light mb-3 o-hidden border-0 shadow-lg my-5">
            <div class="card-header bg-primary">
                <ul class="nav nav-tabs card-header-tabs" role="tablist" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active bg-light" href="<?php echo base_url(); ?>libra">
                            <h4>Daftar Barang</h4>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- Set notifikasi -->
                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Barang <strong>berhasil</strong> <?= $this->session->flashdata('flash') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- end notifikasi -->
                <?php if ($role == 2) { ?>
                    <p align="right"><a href="<?php echo base_url(); ?>libra/create" class="btn btn-outline-primary ">Tambah Barang</a></p>
                <?php } else if ($role == 1 && $kondisi != 0) { ?>
                    <p align="right"><a href="<?php echo base_url(); ?>libra/pembelian" class="btn btn-outline-primary">Cek Pembelian</a></p>
                <?php } ?>
                <table class="table table-bordered">
                    <?php if (empty($libra)) : ?>
                        <div class="alert alert-danger" role="alert">
                            Data buku tidak ditemukan.
                        </div>
                    <?php endif ?>
                    <!-- Kondisi apabila data search tidak ditemukan, maka tidak menampilkan Header Kolom  -->
                    <?php if (!empty($libra)) :  ?>
                        <tr>
                            <th>ID</th>
                            <th>Jenis Barang</th>
                            <th>Merk</th>
                            <th>Ukuran</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <?php if ($role == 1) { ?>
                                <th>
                                    <p align="center">Action</p>
                                </th>
                            <?php } else if ($role == 2) { ?>
                                <th>
                                    <p align="center">Action</p>
                                </th>
                            <?php } ?>
                        </tr>
                    <?php endif; ?>
                    <?php
                    $no = 1;
                    foreach ($libra as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row->id_barang; ?></td>
                            <td><?php echo $row->jenis_barang; ?></td>
                            <td><?php echo $row->merk_barang; ?></td>
                            <td><?php echo $row->ukuran; ?></td>
                            <td><?php echo $row->stock; ?></td>
                            <td><?php echo $row->harga; ?></td>
                            <?php if ($role == 1) { ?>
                                <td>
                                    <p align="center">
                                        <a href="<?php echo base_url(); ?>libra/beli/<?php echo $row->id_barang; ?>" class="btn btn-outline-primary">Beli</a>
                                    </p>
                                </td>
                            <?php } else if ($role == 2  && $row->stock <= 20) { ?>
                                <td>
                                    <p align="center">
                                        <a href="<?php echo base_url(); ?>libra/supplier" class="btn btn-outline-warning btn-block">Tambah Stock</a>
                                        <a href="<?php echo base_url(); ?>libra/delete/<?php echo $row->id_barang; ?>" class="btn btn-outline-danger btn-block" onclick="return confirm('Yakin?');">Hapus</a>
                                    </p>
                                </td>
                                
                            <?php } else if ($role == 2) { ?>
                                <td>
                                    <p align="center">
                                        <a href="<?php echo base_url(); ?>libra/update/<?php echo $row->id_barang; ?>" class="btn btn-outline-success btn-block">Edit</a>
                                        <a href="<?php echo base_url(); ?>libra/delete/<?php echo $row->id_barang; ?>" class="btn btn-outline-danger btn-block" onclick="return confirm('Yakin?');">Hapus</a>
                                    </p>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <div class="btn-toolbar float-right">
                    <a href="<?php echo base_url(); ?>libra/logout" class="btn btn-outline-danger mr-2">Logout</a>
                    <!-- Menyembumnyikan button kembali di halaman utama -->
                    <?php if (!empty($this->input->post('keyword'))) : ?>
                        <a href="<?php echo base_url(); ?>libra" class="btn btn-outline-warning mr-2">Kembali</a>
                    <?php endif ?>
                </div>
                <?php echo var_dump($this->session->flashdata('flash'))?>
            </div>
        </div>
    </div>
</main>

</body>

</html>