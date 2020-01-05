 <?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$titleExcel.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
<div class="container-fluid">
  <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) :  ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $sm['title']; ?> </td>
                            <td><?= $sm['menu']; ?> </td>
                            <td><?= $sm['url']; ?> </td>
                            <td><?= $sm['icon']; ?> </td>
                            <td><?= $sm['is_active']; ?> </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>


                </tbody>
            </table>
</div>