<main role="main" class="container">
    <div>
        <div><br>
            <?php
            $role = $this->session->role;
            $kondisi = $this->session->kondisi;
            // $jumlah_harga = $this->session->jumlah_harga;
            // $jumlah_beli = $this->session->jumlah_beli;
            ?>
        </div>
        <div class="card bg-light mb-3 o-hidden border-0 shadow-lg my-5">
            <div class="card-header bg-primary">
                <ul class="nav nav-tabs card-header-tabs" role="tablist" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active bg-light" href="<?php echo base_url(); ?>libra/pembelian">
                            <h4>List Pembelian</h4>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Jenis Barang</th>
                        <th>Merk</th>
                        <th>Ukuran</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                    <?php
                    foreach ($libra as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row->id_barang; ?></td>
                            <td><?php echo $row->jenis_barang; ?></td>
                            <td><?php echo $row->merk_barang; ?></td>
                            <td><?php echo $row->ukuran; ?></td>
                            <td><?php echo $row->jumlah_beli; ?></td>
                            <td><?php echo $row->total_harga; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <div class="btn-toolbar float-right">
                    <a href="<?php echo base_url(); ?>libra" class="btn btn-outline-warning mr-2" type="button">Kembali</a>
                    <!-- Button mengembalikan -->
                    <a href="<?php echo base_url(); ?>libra/beli_sukses" class="btn btn-outline-primary mr-2">Beli</a>
                </div>
            </div>
        </div>
    </div>
</main>

</body>

</html>