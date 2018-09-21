<div class="row">
    <div class="col-10 no-margin">
        <h2>Draft Author</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->draft_author_id) ? form_hidden('draft_author_id', $input->draft_author_id) : '' ?>


    
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
        
    <!-- author_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Name', 'author_id', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('author_id', getDropdownList('author', ['author_id', 'author_name']), $input->author_id, 'id="author"') ?>
        </div>
        <div class="col-4">
            <?= form_error('author_id') ?>
        </div>
    </div>

        
    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
