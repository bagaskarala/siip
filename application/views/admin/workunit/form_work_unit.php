<div class="row">
    <div class="col-10 no-margin">
        <h2>Add Work Unit</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->work_unit_id) ? form_hidden('work_unit_id', $input->work_unit_id) : '' ?>

    <!-- work_unit_name -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Work Unit Name', 'work_unit_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('work_unit_name', $input->work_unit_name) ?>
        </div>
        <div class="col-4">
            <?= form_error('work_unit_name') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
