<div class="row">
    <div class="col-10 no-margin">
        <h2>Category</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->category_id) ? form_hidden('category_id', $input->category_id) : '' ?>

    <!-- category_name -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Category Name', 'category_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('category_name', $input->category_name) ?>
        </div>
        <div class="col-4">
            <?= form_error('category_name') ?>
        </div>
    </div>
    
        <!-- category_year -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Category Year', 'category_year', ['class' => 'label']) ?>
        </div>
        <div class="col-4">        
            <select name="category_year">
                <option value=""> - Year - </option>
                <option value=<?=date('Y')+2 ?> <?=set_select('category_year',date('Y')+2) ?>> <?=date('Y')+2 ?> </option>
                <option value=<?=date('Y')+1 ?> <?=set_select('category_year',date('Y')+1) ?>> <?=date('Y')+1 ?> </option>
                <option value=<?=date('Y') ?> <?=set_select('category_year',date('Y')) ?>> <?=date('Y') ?> </option>               
            </select>
        </div>
        <div class="col-4">
            <?= form_error('category_year') ?>
        </div>
    </div>
        
        <!-- category_note -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Category Note', 'category_note', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('category_note', $input->category_note, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('category_note') ?>
        </div>
    </div>    
        
        <!-- date_open -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Date Open (yyyy-mm-dd)', 'date_open', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('date_open', $input->date_open, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('date_open') ?>
        </div>
    </div>           
        
        <!-- date_close -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Date Close (yyyy-mm-dd)', 'date_close', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('date_close', $input->date_close, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('date_close') ?>
        </div>
    </div>           
    
    <!-- category_status -->
    <div class="row form-group">
        <div class="col-2">
            <p class="label">Category Status</p>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('category_status', 'y',
                    isset($input->category_status) && ($input->category_status == 'y') ? true : false)
                ?> Active
            </label>
            <label class="block-label">
                <?= form_radio('category_status', 'n',
                    isset($input->category_status) && ($input->category_status == 'n') ? true : false)
                ?> Not Active
            </label>
        </div>
        <div class="col-4">
            <?= form_error('category_status') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
