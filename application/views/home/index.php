<div class="row">
    <div class="col-10">
        <h2>Home</h2>
    </div>
</div>

<?php
    $is_login = $this->session->userdata('is_login');
    $username = $this->session->userdata('username');
?>

<?php if ($is_login): ?>
    <div class="row">
        <div class="col-10">
        <p>Welcome, <strong><?= $username ?></strong> !</p>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-10">
            <p>Tampilan Sistem Informasi UGMPress</p>
        </div>
            <?php echo $this->calendar->generate(); ?>

    </div>
<?php endif ?>