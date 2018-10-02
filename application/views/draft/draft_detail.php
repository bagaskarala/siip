
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
        <?= form_input('keywords', $this->input->get('keywords'), ['placeholder' => 'Enter Category, Theme, or Title', 'class' => 'col-3']) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Find', 'class' => 'btn-default']) ?>
    <?= form_close() ?>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($draft):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">Draft Title</th>
                        <th scope="col">Draft File</th>
                        <th scope="col">Status</th>
                        <th scope="col">Review Start Date</th>
                        <th scope="col">Review Deadline Date</th>
                        <th scope="col">Reviewer 1 File</th>
                        <th scope="col">Reviewer 1 File Replay</th>
                        <th scope="col">Reviewer 1 Last Update</th>
                        <th scope="col">Reviewer 2 File</th>
                        <th scope="col">Reviewer 2 File Replay</th>
                        <th scope="col">Reviewer 2 Last Update</th>
                        <th scope="col">Reviewer Replay Last Update</th>
                        <th scope="col">Review End Date</th>
                        <th scope="col">Editor Start Date</th>
                        <th scope="col">Editpr Deadline Date</th>
                        <th scope="col">Editor File</th>
                        <th scope="col">Editor File Replay</th>
                        <th scope="col">Editor Last Update</th>
                        <th scope="col">Editor End Date</th>
                        <th scope="col">Layouter Start Date</th>
                        <th scope="col">Layouter Deadline Date</th>
                        <th scope="col">Layouter 1 File</th>
                        <th scope="col">Layouter 1 File Replay</th>
                        <th scope="col">Layouter 1 Last Update</th>
                        <th scope="col">Layouter 2 File</th>
                        <th scope="col">Layouter 2 File Replay</th>
                        <th scope="col">Layouter 2 Last Update</th>
                        <th scope="col">Layouter Replay Last Update</th>
                        <th scope="col">Layouter End Date</th>
                        <th scope="col">Proofread Start Date</th>
                        <th scope="col">Proofread Deadline Date</th>
                        <th scope="col">Proofread File</th>
                        <th scope="col">Proofread File Replay</th>
                        <th scope="col">Proofread Last Update</th>
                        <th scope="col">Proofread End Date</th>
                        <th scope="col">Progress</th>
                    </tr>
                </thead>
                <tbody>
                        <td><?= $draft->draft_title ?></td>
                        <td><?= $draft->draft_file ?></td>
                        <!--<td><a href="<?php echo base_url(); ?>/draft/download/<?php $fieldname; ?>">Download</a></td>-->
                        <td><?= $draft->draft_status_string ?></td>
                        <td><?= $draft->review_start_date ?></td>
                        <td><?= $draft->review_deadline_date ?></td>
                        <td><?= $draft->reviewer_1_file ?></td>
                        <td><?= $draft->reviewer_1_file_reply ?></td>
                        <td><?= $draft->reviewer_1_last_update ?></td>
                        <td><?= $draft->reviewer_2_file ?></td>
                        <td><?= $draft->reviewer_2_file_reply ?></td>
                        <td><?= $draft->reviewer_2_last_update ?></td>
                        <td><?= $draft->reviewer_reply_last_update ?></td>
                        <td><?= $draft->review_end_date ?></td>
                        <td><?= $draft->edit_start_date ?></td>
                        <td><?= $draft->edit_deadline_date ?></td>
                        <td><?= $draft->editor_file ?></td>
                        <td><?= $draft->editor_file_reply ?></td>
                        <td><?= $draft->edit_end_date ?></td>
                        <td><?= $draft->editor_last_update ?></td>
                        <td><?= $draft->layout_start_date ?></td>
                        <td><?= $draft->layout_deadline_date ?></td>
                        <td><?= $draft->layouter_1_file ?></td>
                        <td><?= $draft->layouter_1_file_reply ?></td>
                        <td><?= $draft->layouter_1_last_update ?></td>
                        <td><?= $draft->layouter_2_file ?></td>
                        <td><?= $draft->layouter_2_file_reply ?></td>
                        <td><?= $draft->layouter_2_last_update ?></td>
                        <td><?= $draft->layouter_reply_last_update ?></td>
                        <td><?= $draft->layout_end_date ?></td>
                        <td><?= $draft->proofread_start_date ?></td>
                        <td><?= $draft->proofread_deadline_date ?></td>
                        <td><?= $draft->proofread_file ?></td>
                        <td><?= $draft->proofread_file_reply ?></td>
                        <td><?= $draft->proofread_last_update ?></td>
                        <td><?= $draft->proofread_end_date ?></td>
                        <td><?= anchor("draft/endProgress/$draft->draft_id/$draft->draft_status", 'Selesai', ['class' => 'btn btn-success']) ?></td>
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

