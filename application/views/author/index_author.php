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
        <h2>Author</h2>
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
    <?= form_open('author/search', ['method' => 'GET']) ?>
        <?= form_label('Find', 'key_words') ?>
        <?= form_input('keywords', $this->input->get('keywords'), ['placeholder' => 'Enter ID or Name', 'class' => 'col-3']) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Find', 'class' => 'btn-default']) ?>
    <?= form_close() ?>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($authors):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Work Unit Name</th>
                        <th scope="col">Institute Name</th>
                        <th scope="col">Author NIP</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Author Degree</th>
                        <th scope="col">Author Address</th>
                        <th scope="col">Author Contact</th>
                        <th scope="col">Author Email</th>
                        <th scope="col">Author Bank</th>
                        <th scope="col">Author Saving Number</th>
                        <th scope="col">Heir Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($authors as $author): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $author->work_unit_name ?></td>
                        <td><?= $author->institute_name ?></td>
                        <td><?= $author->author_nip ?></td>
                        <td><?= $author->author_name ?></td>
                        <td><?= $author->author_degree ?></td>
                        <td><?= $author->author_address ?></td>
                        <td><?= $author->author_contact ?></td>
                        <td><?= $author->author_email ?></td>
                        <td><?= $author->bank_name ?></td>
                        <td><?= $author->author_saving_num ?></td>
                        <td><?= $author->heir_name ?></td>                        
                        <td><?= anchor("author/edit/$author->author_id", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?= form_open("author/delete/$author->author_id") ?>
                                <?= form_hidden('author_id', $author->author_id) ?>
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
            <p>Author data were not available</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button add -->
    <div class="col-2">
        <?= anchor("author/add", 'Add', ['class' => 'btn btn-primary']) ?>
    </div>
    
        <!-- Button work_unit -->
    <div class="col-2">
        <?= anchor("workunit", 'See Work Unit List', ['class' => 'btn btn-primary']) ?>
    </div>
        
        <!-- Button institute -->
    <div class="col-2">
        <?= anchor("institute", 'See Institute List', ['class' => 'btn btn-primary']) ?>
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
