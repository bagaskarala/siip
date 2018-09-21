<div class="row">
    <div class="col-10 no-margin">
        <h2>Add Theme</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->theme_id) ? form_hidden('theme_id', $input->theme_id) : '' ?>

    <!-- theme_name -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Theme Name', 'theme_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('theme_name', $input->theme_name) ?>
        </div>
        <div class="col-4">
            <?= form_error('theme_name') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
