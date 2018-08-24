<div class="row">
    <div class="col-10 no-margin">
        <h2>Reviewer</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->reviewer_id) ? form_hidden('reviewer_id', $input->reviewer_id) : '' ?>

    <!-- reviewer_nip -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Reviewer NIP', 'reviewer_nip', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('reviewer_nip', $input->reviewer_nip) ?>
        </div>
        <div class="col-4">
            <?= form_error('reviewer_nip') ?>
        </div>
    </div>
    
<!-- reviewer_name -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Reviewer Name', 'reviewer_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('reviewer_name', $input->reviewer_name) ?>
        </div>
        <div class="col-4">
            <?= form_error('reviewer_name') ?>
        </div>
    </div>



    <!-- faculty_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Faculty Name', 'faculty_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('faculty_id', getDropdownList('faculty', ['faculty_id', 'faculty_name']), $input->faculty_id, 'id="faculty"') ?>
        </div>
        <div class="col-4">
            <?= form_error('faculty_id') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
