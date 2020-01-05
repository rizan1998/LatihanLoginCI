<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?>

    </h1>

    <!-- <div class="row">
        <div class="col-lg-6">
            <form action="<?= site_url('admin/index/'); ?>" method="POST">
                <div class="input-group mb-3 ml-4">
                    <input type="text" name="cari" class="form-control" placeholder="Masukan nama pencarian">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" name="q" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->

    <div class="gp_btn">
        <ul>
            <li>
                <?php echo form_open('admin/cari'); ?>
                <input type="text" name="key" placeholder="Search..." size="50" required>
                <input type="submit" name="search" value="Search">
                <?php echo form_close(); ?>
            </li>
            <li><a class="btn2" href="<?php echo base_url(); ?>./admin">Reload</a></li>
        </ul>
    </div>

    <!-- jika menampilkan menggunakan table -->
    <!-- <table id="gp_tabel">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>ISBN</th>
        </tr>
        <?php
        if ($this->uri->segment(4)) {
            $no = $this->uri->segment(4);
        } else {
            $no = 0;
        }
        foreach ($data_buku as $row) {
            $no++;
        ?>
            <tr align=center>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['pekerjaan']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table> -->

    <!-- jika menampilkan menggunakan card -->
    <div class="row">
        <?php
        if ($this->uri->segment(3)) {
            $no = $this->uri->segment(3);
        } else {
            $no = 0;
        }

        if (count($data_buku) > 0) {
            foreach ($data_buku as $row) {
                $no++;
        ?>
                <div class=" col-md-4 col-sm-4 col-xs-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                            <p class="card-text"><?php echo $row['alamat']; ?></p>
                            <a href="#" class="btn btn-primary"><?php echo $row['pekerjaan']; ?></a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<tbody><tr><td colspan='8' style='padding:10px; background:#F00; border:none; color:#FFF;'>Hasil pencarian tidak ditemukan.</td></tr></tbody>";
        }
        ?>
    </div>
    <div id="pagination">
        <ul class="gp_pagination">
            <!-- Pagination links -->
            <?php foreach ($links as $link) {
                echo "<li>" . $link . "</li>";
            } ?>
        </ul>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->