<?php $i = 0 ?>

<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>Faculty</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<!-- Table -->
<div class="row">
    <div class="col-6">
        <?php if ($faculties):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Faculty ID</th>
                        <th scope="col">Faculty Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($faculties as $faculty): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $faculty->faculty_id ?></td>
                        <td><?= $faculty->faculty_name ?></td>
                        <td><?= anchor("faculty/edit/$faculty->faculty_id", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?= form_open("faculty/delete/$faculty->faculty_id") ?>
                                <?= form_hidden('faculty_id', $faculty->faculty_id) ?>
                                <?= form_button(['type' => 'submit', 'content' => 'Delete', 'class' => 'btn-danger']) ?>
                            <?= form_close() ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Total : <?= isset($total) ? $total : '' ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>No faculty data were available</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button create -->
    <div class="col-10">
        <?= anchor("faculty/add", 'Add', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <!-- Button back to reviewer -->
    <div class="col-10">
        <?= anchor("reviewer", 'Back to reviewer', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
