<div class="row">
    <div class="col-10 no-margin">
        <h2>Draft Reviewer</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->draft_reviewer_id) ? form_hidden('draft_reviewer_id', $input->draft_reviewer_id) : '' ?>


    
        <!-- draft_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Draft Title', 'draft_id', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('draft_id', getDropdownList('draft', ['draft_id', 'draft_title']), $input->draft_id, 'id="draft"') ?>
        </div>
        <div class="col-4">
            <?= form_error('draft_id') ?>
        </div>
    </div>
        
    <!-- search_reviewer / fake input just for search-->
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
    </div>

        
    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
