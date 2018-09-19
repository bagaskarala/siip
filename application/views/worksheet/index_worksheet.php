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
        <h2>Worksheet</h2>
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
    <?= form_open('worksheet/search', ['method' => 'GET']) ?>
        <?= form_label('Find', 'key_words') ?>
        <?= form_input('keywords', $this->input->get('keywords'), ['placeholder' => 'Enter Title or Number', 'class' => 'col-3']) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Find', 'class' => 'btn-default']) ?>
    <?= form_close() ?>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($worksheets):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Draft Title</th>
                        <th scope="col">Worksheet Number</th>
                        <th scope="col">Reprint Status</th>
                        <th scope="col">Status</th>
                        <th scope="col">Notes</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($worksheets as $worksheet):?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $worksheet->draft_title ?></td>
                        <td><?= $worksheet->worksheet_num ?></td>
                        <td><?= $worksheet->is_reprint == 'y' ? 'Reprint' : 'Not Reprint' ?></td>
                        <td><?=
                            $status = "";
                            if ($worksheet->worksheet_status > 0) {
                                if ($worksheet->worksheet_status == 1) {
                                    $status = "Approved";
                                } else {
                                    $status = "Rejected";
                                }
                            } else {
                                $status = "Waiting";
                            }
                            echo $status;
                            ?>        
                        </td>
                        <td><?= $worksheet->worksheet_notes ?></td>
                        <td><?= anchor("worksheet/edit/$worksheet->worksheet_id", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?php if ($worksheet->worksheet_status > 0) {
                                echo "";
                            } else {
                                ?>
                                <?= form_open("worksheet/action/$worksheet->worksheet_id/1") ?>
                                    <?= form_hidden('worksheet_id', $worksheet->worksheet_id) ?>
                                    <?= form_button(['type' => 'submit', 'content' => 'Approve', 'class' => 'btn-success']) ?>
                                <?= form_close() ?>

                                <?= form_open("worksheet/action/$worksheet->worksheet_id/2") ?>
                                    <?= form_hidden('worksheet_id', $worksheet->worksheet_id) ?>
                                    <?= form_button(['type' => 'submit', 'content' => 'Reject                                                                                                                                                                                                                                                                                                                                                                   ', 'class' => 'btn-danger']) ?>
                                <?= form_close() ?>
                            <?php
                            }
                            ?>
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
            <p>Worksheet data were not available</p>
        <?php endif ?>
    </div>
</div>

<div class="row">

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
