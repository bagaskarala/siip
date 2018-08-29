<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'home';
    }

	public function index($page = null)
	{
        $pages    = $this->pages;
        $main_view  = 'home/index';
	$this->load->view('template', compact('pages', 'main_view'));        
	}
}