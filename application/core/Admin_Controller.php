<?php
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        $this->role = 'superadmin';
        parent::__construct();

        $username = $this->session->userdata('username');
        $level    = $this->session->userdata('level');
        $is_login = $this->session->userdata('is_login');

        if (!$is_login) {
            redirect(base_url());
            return;
        }

        if ($level !== 'superadmin') {
            redirect(base_url());
            return;
        }
    }
}
