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
        <h2>Draft Reviewer</h2>
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
    <?= form_open('draft_reviewer/search', ['method' => 'GET']) ?>
        <?= form_label('Find', 'key_words') ?>
        <?= form_input('keywords', $this->input->get('keywords'), ['placeholder' => 'Enter Title or NIP or Name', 'class' => 'col-3']) ?>
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
                        <th scope="col">Draft Title</th>
                        <th scope="col">Reviewer NIP</th>
                        <th scope="col">Reviewer Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($drafts as $draft):
                            $reviewers_nip = "";
                            $reviewers_name = "";
                            if (!empty($draft->draft_reviewers)) {
                                foreach ($draft->draft_reviewers as $key => $value) {
                                    $reviewers_nip .= $value->reviewer_nip . ', ';
                                    $reviewers_name .= $value->reviewer_name . ', ';
                                }

                                $reviewers_nip = substr($reviewers_nip, 0, -2);
                                $reviewers_name = substr($reviewers_name, 0, -2);
                            } else {
                                $reviewers_nip .= "-";
                                $reviewers_name .= "-";
                            }
                    ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $draft->draft_title ?></td>
                        <td><?= $reviewers_nip ?></td>   
                        <td><?= $reviewers_name ?></td>  
                        <td><?= anchor("draft_reviewer/edit/$draft->draft_id", 'Choose Reviewer', ['class' => 'btn btn-success']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Total : <?= isset($total) ? $total : '' ?></td>
                    </tr>
                </tfoot>
                    <tr>
                        <td colspan="6">Total : <?= isset($total) ? $total : '' ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>Draft Reviewer data were not available</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button add -->
    <div class="col-2">
        <?= anchor("draft_reviewer/add", 'Add', ['class' => 'btn btn-primary']) ?>
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
