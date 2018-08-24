<div class="row">
    <div class="col-10 no-margin">
        <h2>Add Institute</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->institute_id) ? form_hidden('institute_id', $input->institute_id) : '' ?>

    <!-- institute_name -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Institute Name', 'institute_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('institute_name', $input->institute_name) ?>
        </div>
        <div class="col-4">
            <?= form_error('institute_name') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
