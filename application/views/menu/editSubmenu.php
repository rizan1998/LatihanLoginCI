<!-- pembungkus -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?>

    </h1>

    <div class="row">

        <?php foreach ($detailsubmenu as $ds) { ?>
            <div class="col-lg-6 sol col-sm- co6l-xl-12">
                <form action="<?= base_url('menu/ubahSubmenu') ?>" method="POST">
                    <div class="form-group">
                        <label for="title">Title submenu</label>
                        <input id="title" type="text" name="title" class="form-control" style="width: 526px;" value="<?php echo $ds->title; ?>">
                    </div>
                    <div class="form-group">
                        <label>Menu Utama</label>
                        <select name="menu_id" class="form-control">
                            <?php foreach ($user_menu as $sm) : ?>
                                <?php if ($ds->menu_id == $sm->id) : ?>
                                    <option value="<?= $ds->menu_id ?>" selected><?= $sm->menu ?></option>
                                <?php else : ?>
                                    <option value="<?= $sm->id ?>"><?= $sm->menu ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Url submenu</label>
                        <input id="url" type="text" name="url" class="form-control" style="width: 526px;" value="<?php echo $ds->url; ?>">
                    </div>
                    <div class="form-group">
                        <label>Icon submenu</label>
                        <input id="icon" type="text" name="icon" class="form-control" style="width: 526px;" value="<?php echo $ds->icon; ?>">
                    </div>

                    <div class="form-group">
                        <label>is active ini 1 atau 0</label>
                        <input id="is_active" type="number" name="is_active" class="form-control" value="<?php echo $ds->is_active; ?>">
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo $ds->id; ?>">
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-warning">Ubah Data</button>
                        <a href="<?php echo base_url() . 'menu/submenu'; ?>" class="btn btn-primary">Kembali</a>
                    </div>
            </div>
            </form>
        <?php } ?>

    </div>
</div>
<!--end pembungkus -->