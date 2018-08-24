<?php
    $perPage = 10;
    $keywords = $this->input->get('keywords');

    if (isset($keywords)) {
        $page = $this->uri->segment(3);
    } else {
        $page = $this->uri->segment(2);
    }

    // data table series number
    $i = isset($page) ? $page * $perPage - $perPage : 0;
?>

<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>Reviewer</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<!--Search form -->
<div class="row">
    <div class="col-5">
        &nbsp;
    </div>
    <div class="col-5 align-right">
    <?= form_open('reviewer/search', ['method' => 'GET']) ?>
        <?= form_label('Find', 'key_words') ?>
        <?= form_input('keywords', $this->input->get('keywords'), ['placeholder' => 'Enter ID or Name', 'class' => 'col-3']) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Find', 'class' => 'btn-default']) ?>
    <?= form_close() ?>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($reviewers):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Reviewer NIP</th>
                        <th scope="col">Reviewer Name</th>
                        <th scope="col">Faculty Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reviewers as $reviewer): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $reviewer->reviewer_nip ?></td>
                        <td><?= $reviewer->reviewer_name ?></td>
                        <td><?= $reviewer->faculty_name  ?></td>
                        <td><?= anchor("reviewer/edit/$reviewer->reviewer_id", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?= form_open("reviewer/delete/$reviewer->reviewer_id") ?>
                                <?= form_hidden('reviewer_id', $reviewer->reviewer_id) ?>
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
            <p>Reviewer data were not available</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button add -->
    <div class="col-2">
        <?= anchor("reviewer/add", 'Add', ['class' => 'btn btn-primary']) ?>
    </div>
    
        <!-- Button faculty -->
    <div class="col-2">
        <?= anchor("faculty", 'See Faculty List', ['class' => 'btn btn-primary']) ?>
    </div>

    <!-- Pagination -->
    <div class="col-2">
    <?php if ($pagination): ?>
        <div id="pagination"  class="float-right">
            <?= $pagination ?>
        </div>
    <?php else: ?>
        &nbsp;
    <?php endif ?>
    </div>
</div>
