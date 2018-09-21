<?php $i = 0 ?>

<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>Category</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<!-- Table -->
<div class="row">
    <div class="col-6">
        <?php if ($categories):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Category Year</th>
                        <th scope="col">Category Note</th>
                        <th scope="col">Date Open</th>
                        <th scope="col">Date Close</th>
                        <th scope="col">Category Status</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $category->category_name ?></td>
                        <td><?= $category->category_year ?></td>
                        <td><?= $category->category_note ?></td>
                        <td><?= $category->date_open ?></td>
                        <td><?= $category->date_close ?></td>
                        <td><?= $category->category_status == 'y' ? 'Active' : 'Not Active' ?></td>                      
                        <td><?= anchor("category/edit/$category->category_id", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?= form_open("category/delete/$category->category_id") ?>
                                <?= form_hidden('category_id', $category->category_id) ?>
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
            <p>No category data were available</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button create -->
    <div class="col-10">
        <?= anchor("category/add", 'Add', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
