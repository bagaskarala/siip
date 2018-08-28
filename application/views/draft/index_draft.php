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
        <h2>Draft</h2>
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
    <?= form_open('draft/search', ['method' => 'GET']) ?>
        <?= form_label('Find', 'key_words') ?>
        <?= form_input('keywords', $this->input->get('keywords'), ['placeholder' => 'Enter ID or Name', 'class' => 'col-3']) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Find', 'class' => 'btn-default']) ?>
    <?= form_close() ?>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($drafts):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Theme Name</th>
                        <th scope="col">Draft Title</th>
                        <th scope="col">Draft File</th>
                        <th scope="col">Proposed Fund</th>
                        <th scope="col">Approved Fund</th>
                        <th scope="col">Entry Date</th>
                        <th scope="col">Finish Date</th>
                        <th scope="col">Print Date</th>
                        <th scope="col">Review Status</th>
                        <th scope="col">Review Notes</th>
                        <th scope="col">Author Review Notes</th>
                        <th scope="col">Review Start Date</th>
                        <th scope="col">Review End Date</th>
                        <th scope="col">Revise Status</th>
                        <th scope="col">Revise Notes</th>
                        <th scope="col">Edit Status</th>
                        <th scope="col">Edit Notes</th>
                        <th scope="col">Author Edit Notes</th>
                        <th scope="col">Edit Start Date</th>
                        <th scope="col">Edit End Date</th>
                        <th scope="col">Layout Status</th>
                        <th scope="col">Layout Notes</th>
                        <th scope="col">Author Layout Notes</th>
                        <th scope="col">Layout Start Date</th>
                        <th scope="col">Layout End Date</th>
                        <th scope="col">Reprint Status</th>
                        <th scope="col">Draft Notes</th>
                        <th scope="col">Proofread Notes</th>
                        <th scope="col">Author Proofread Notes</th>
                        <th scope="col">Proofread Start Date</th>
                        <th scope="col">Proofread End Date</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($drafts as $draft): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $draft->category_name ?></td>
                        <td><?= $draft->theme_name ?></td>
                        <td><?= $draft->draft_title ?></td>
                        <td><?= $draft->draft_file ?></td>
                        <!--<td><a href="<?php echo base_url(); ?>/draft/download/<?php $fieldname; ?>">Download</a></td>-->
                        <td><?= $draft->proposed_fund ?></td>
                        <td><?= $draft->approved_fund ?></td>
                        <td><?= $draft->entry_date ?></td>
                        <td><?= $draft->finish_date ?></td>
                        <td><?= $draft->print_date ?></td>
                        <td><?= $draft->is_reviewed == 'y' ? 'Reviewed' : 'Not Reviewed'?></td>
                        <td><?= $draft->review_notes ?></td>
                        <td><?= $draft->author_review_notes ?></td>
                        <td><?= $draft->review_start_date ?></td>
                        <td><?= $draft->review_end_date ?></td>
                        <td><?= $draft->is_revised == 'y' ? 'Revised' : 'Not Revised'?></td>
                        <td><?= $draft->revise_notes ?></td>
                        <td><?= $draft->is_edited == 'y' ? 'Edited' : 'Not Edited'?></td>
                        <td><?= $draft->edit_notes ?></td>
                        <td><?= $draft->author_edit_notes ?></td>
                        <td><?= $draft->edit_start_date ?></td>
                        <td><?= $draft->edit_end_date ?></td>
                        <td><?= $draft->is_layouted == 'y' ? 'Layouted' : 'Not Layouted'?></td>
                        <td><?= $draft->layout_notes ?></td>
                        <td><?= $draft->author_layout_notes ?></td>
                        <td><?= $draft->layout_start_date ?></td>
                        <td><?= $draft->layout_end_date ?></td>
                        <td><?= $draft->is_reprint == 'y' ? 'Reprint' : 'Not Reprint'?></td>
                        <td><?= $draft->draft_notes ?></td>
                        <td><?= $draft->proofread_notes ?></td>
                        <td><?= $draft->author_proofread_notes ?></td>
                        <td><?= $draft->proofread_start_date ?></td>
                        <td><?= $draft->proofread_end_date ?></td>
                        <td><?= anchor("draft/edit/$draft->draft_id", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?= form_open("draft/delete/$draft->draft_id") ?>
                                <?= form_hidden('draft_id', $draft->draft_id) ?>
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
            <p>Draft data were not available</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button add -->
    <div class="col-2">
        <?= anchor("draft/add", 'Add', ['class' => 'btn btn-primary']) ?>
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
