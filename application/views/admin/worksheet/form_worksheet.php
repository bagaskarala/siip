<div class="row">
    <div class="col-10 no-margin">
        <h2>Worksheet</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->worksheet_id) ? form_hidden('worksheet_id', $input->worksheet_id) : '' ?>


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

    <!-- worksheet_num -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Worksheet Number', 'worksheet_num', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('worksheet_num', $input->worksheet_num) ?>
        </div>
        <div class="col-4">
            <?= form_error('worksheet_num') ?>
        </div>
    </div>
    
            <!-- is_reprint -->
    <div class="row form-group">
        <div class="col-2">
            <p class="label">Reprint Status</p>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('is_reprint', 'y',
                    isset($input->is_reprint) && ($input->is_reprint == 'y') ? true : false)
                ?> Reprint
            </label>
            <label class="block-label">
                <?= form_radio('is_reprint', 'n',
                    isset($input->is_reprint) && ($input->is_reprint == 'n') ? true : false)
                ?> Not Reprint
            </label>
        </div>
        <div class="col-4">
            <?= form_error('is_reprint') ?>
        </div>
    </div>

            
        <!-- worksheet_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Desk Screening Notes', 'worksheet_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('worksheet_notes', $input->worksheet_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('worksheet_notes') ?>
        </div>
    </div>    




    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>