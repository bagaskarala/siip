<div class="row">
    <div class="col-10 no-margin">
        <h2>Draft Reviewer</h2>
    </div>
</div>

<?php $this->load->view('_partial/flash_message') ?>
<?= form_open($form_action, ['id' => 'form_draft_reviewer', 'autocomplete' => 'off']) ?>

    <?= isset($input->draft_id) ? form_hidden('draft_id', $input->draft_id) : '' ?>


    
        <!-- draft_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Draft Title', 'draft_title', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('draft_title', $input->draft_title, 'disabled') ?>
        </div>
        <div class="col-4">
            <?= form_error('draft_title') ?>
        </div>
    </div>

    <?= form_hidden('draft_title', $input->draft_title) ?>
        
        <?php
        if (!empty($input->reviewer_id)) {
            foreach ($input->reviewer_id as $key => $value) {
                // var_dump($value);
                ?>
                    <!--         reviewer_id -->
                <div class="row form-group">
                    <div class="col-2">
                        <?= form_label('Reviewer Name', 'reviewer_id[]', ['class' => 'label']) ?>
                    </div>
                    <div class="col-4">
                        <?= form_dropdown('reviewer_id[]', getDropdownList('reviewer', ['reviewer_id', 'reviewer_name']), $value, 'id="reviewer_id[]"') ?>
                    </div>
                    <div class="col-4">
                        <?= form_error('reviewer_id[]') ?>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
                <!--         reviewer_id -->
            <div class="row form-group">
                <div class="col-2">
                    <?= form_label('Reviewer Name', 'reviewer_id[]', ['class' => 'label']) ?>
                </div>
                <div class="col-4">
                    <?= form_dropdown('reviewer_id[]', getDropdownList('reviewer', ['reviewer_id', 'reviewer_name']), 'id="reviewer_id[]"') ?>
                </div>
                <div class="col-4">
                    <?= form_error('reviewer_id[]') ?>
                </div>
            </div>
            <?php
        }
        ?>


<!--     search_reviewer / fake input just for search
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Reviewer Name', 'search_reviewer', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <input type="text" name="search_reviewer" value="<?= $input->search_reviewer ?>" id="search_reviewer" onkeyup="reviewerAutoComplete()" placeholder="Input Reviewer NIP or Name">
            <ul id="reviewer_list" class="live-search-list"></ul>
        </div>
        <div class="col-4">
            <?= form_error('search_reviewer') ?>
        </div>
    </div>-->

        
    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
