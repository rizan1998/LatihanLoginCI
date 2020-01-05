<!-- Content Wrapper -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?>

    </h1>
    <div id="graph" style="overflow: auto;"></div>
    <button type="button" class="btn btn-primary">
        jumlah data saat ini: <span class="badge badge-light"><?php echo $total_asset; ?></span>
        <span class="sr-only">unread messages</span>
    </button>
    <button type="button" class="btn btn-primary">
        julah pekerjaan saat ini <span class="badge badge-light"><?php echo $total_inventori; ?></span>
        <span class="sr-only">unread messages</span>
    </button>


    <div class="gp_btn">
        <ul>
            <li>
                <?php echo form_open('admin/cari'); ?>
                <input type="text" name="key" placeholder="Search..." size="50" required>
                <input type="submit" name="search" value="Search">
                <?php echo form_close(); ?>
            </li>
            <li><a class="btn2" href="<?php echo base_url(); ?>/admin/">Reload</a></li>
        </ul>
    </div>
    <!-- <table id="gp_tabel">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>ISBN</th>
        </tr> -->
    <div class="row">

        <?php
        if ($this->uri->segment(3)) {
            $no = $this->uri->segment(3);
        } else {
            $no = 0;
        }


        foreach ($data_buku as $row) {
            $no++;
        ?>
            <!-- <tr align=center>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['pekerjaan']; ?></td>
            </tr> -->
            <div class=" col-md-4 col-lg-4 col-xs-4" style="margin-top: 5px">
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
        ?>
    </div>
    <!-- </table> -->

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