<div class="row">
    <div class="col-10 no-margin">
        <h2>Add Faculty</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->faculty_id) ? form_hidden('faculty_id', $input->faculty_id) : '' ?>

    <!-- faculty_name -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Faculty Name', 'faculty_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('faculty_name', $input->faculty_name) ?>
        </div>
        <div class="col-4">
            <?= form_error('faculty_name') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
