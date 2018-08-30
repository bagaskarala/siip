<div class="row">
    <div class="col-10 no-margin">
        <h2>Author</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->author_id) ? form_hidden('author_id', $input->author_id) : '' ?>

    <!-- work_unit_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Work Unit Name', 'work_unit_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('work_unit_id', getDropdownList('work_unit', ['work_unit_id', 'work_unit_name']), $input->work_unit_id, 'id="work_unit"') ?>
        </div>
        <div class="col-4">
            <?= form_error('work_unit_id') ?>
        </div>
    </div>
    
        <!-- institute_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Institute Name', 'institute_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('institute_id', getDropdownList('institute', ['institute_id', 'institute_name']), $input->institute_id, 'id="institute"') ?>
        </div>
        <div class="col-4">
            <?= form_error('institute_id') ?>
        </div>
    </div>

      <!-- user_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('User Name', 'user_id', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('user_id', getDropdownList('user', ['user_id', 'username']), $input->user_id, 'id="user"') ?>
        </div>
        <div class="col-4">
            <?= form_error('user_id') ?>
        </div>
    </div>

        
        <!-- author_nip -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author NIP', 'author_nip', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('author_nip', $input->author_nip) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_nip') ?>
        </div>
    </div>

        <!-- author_name -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Name', 'author_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('author_name', $input->author_name) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_name') ?>
        </div>
    </div>
        
        <!-- author_degree -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Degree', 'author_degree', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('author_degree', $input->author_degree) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_degree') ?>
        </div>
    </div>

        <!-- author_address -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Address', 'author_address', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('author_address', $input->author_address) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_address') ?>
        </div>
    </div>
        
        <!-- author_contact -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Contact', 'author_contact', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('author_contact', $input->author_contact) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_contact') ?>
        </div>
    </div>        
        
        <!-- author_email -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Email', 'author_email', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('author_email', $input->author_email) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_email') ?>
        </div>
    </div>          
        
        <!-- author_saving_bank -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Bank', 'bank_id', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('bank_id', getDropdownBankList('bank', ['bank_id', 'bank_name']), $input->bank_id, 'id="bank"') ?>
        </div>
        <div class="col-4">
            <?= form_error('bank_id') ?>
        </div>
    </div>           
        
        <!-- author_saving_num -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Saving Number', 'author_saving_num', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('author_saving_num', $input->author_saving_num) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_saving_num') ?>
        </div>
    </div>
                
        <!-- author_heir -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Heir Name', 'heir_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('heir_name', $input->heir_name) ?>
        </div>
        <div class="col-4">
            <?= form_error('heir_name') ?>
        </div>
    </div>
        
        

        
    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
