<div class="row">
    <div class="col-10 no-margin">
        <h2>User</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->user_id) ? form_hidden('user_id', $input->user_id) : '' ?>

    <!-- username -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Username', 'username', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('username', $input->username) ?>
        </div>
        <div class="col-4">
            <?= form_error('username') ?>
        </div>
    </div>

    <!-- password -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Password', 'password', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_password('password') ?>
        </div>
        <div class="col-4">
            <?= form_error('password') ?>
        </div>
    </div>

    <!-- level -->
    <div class="row form-group">
        <div class="col-2">
            <p class="label">Level</p>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('level', 'superadmin',
                    isset($input->level) && ($input->level == 'superadmin') ? true : false)
                ?> Superadmin
            </label>
            <label class="block-label">
                <?= form_radio('level', 'admin_penerbitan',
                    isset($input->level) && ($input->level == 'admin_penerbitan') ? true : false)
                ?> Admin Penerbitan
            </label>
            <label class="block-label">
                <?= form_radio('level', 'staff_penerbitan',
                    isset($input->level) && ($input->level == 'staff_penerbitan') ? true : false)
                ?> Staff Penerbitan
            </label>
            <label class="block-label">
                <?= form_radio('level', 'admin_pemasaran',
                    isset($input->level) && ($input->level == 'admin_pemasaran') ? true : false)
                ?> Admin Pemasaran
            </label>
            <label class="block-label">
                <?= form_radio('level', 'admin_percetakan',
                    isset($input->level) && ($input->level == 'admin_percetakan') ? true : false)
                ?> Admin Percetakan
            </label>
            <label class="block-label">
                <?= form_radio('level', 'admin_gudang',
                    isset($input->level) && ($input->level == 'admin_gudang') ? true : false)
                ?> Admin Gudang
            </label>
            <label class="block-label">
                <?= form_radio('level', 'author',
                    isset($input->level) && ($input->level == 'author') ? true : false)
                ?> Author
            </label>      
            <label class="block-label">
                <?= form_radio('level', 'reviewer',
                    isset($input->level) && ($input->level == 'reviewer') ? true : false)
                ?> Reviewer
            </label>                
        </div>
        <div class="col-4">
            <?= form_error('level') ?>
        </div>
    </div>

    <!-- is_blocked -->
    <div class="row form-group">
        <div class="col-2">
            <p class="label">Block Status</p>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('is_blocked', 'y',
                    isset($input->is_blocked) && ($input->is_blocked == 'y') ? true : false)
                ?> Yes
            </label>
            <label class="block-label">
                <?= form_radio('is_blocked', 'n',
                    isset($input->is_blocked) && ($input->is_blocked == 'n') ? true : false)
                ?> No
            </label>
        </div>
        <div class="col-4">
            <?= form_error('is_blocked') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
