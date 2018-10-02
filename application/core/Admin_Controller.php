<?php
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        $this->role = 'superadmin';
        parent::__construct();

        $this->username = $this->session->userdata('username');
        $this->level    = $this->session->userdata('level');
        $this->is_login = $this->session->userdata('is_login');
        $this->user_id = $this->session->userdata('user_id');
        $this->role_id = $this->session->userdata('role_id'); // EDWARD :: 

        if (!$this->is_login) {
            redirect(base_url());
            return;
        }

        if ($this->level !== 'superadmin') {
            redirect(base_url());
            return;
        }
    }
}
