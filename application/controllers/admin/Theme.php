<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Theme extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'theme';
        //$this->load->model('theme_model');
    }
//--index--
	public function index($page = null)
	{
        $themes     = $this->theme->orderBy('theme_id')->getAll();
        $total    = count($themes);
        $pages    = $this->pages;
        $main_view  = 'theme/index_theme';
		$this->load->view('template', compact('pages', 'main_view', 'themes', 'total'));
	}
        
//--add--
        public function add()
	{                     
        if (!$_POST) {
            $input = (object) $this->theme->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->theme->validate()) {
            $pages   = $this->pages;
            $main_view   = 'theme/form_theme';
            $form_action = 'theme/add';

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->theme->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect('theme');
	}
        
//--edit--        
        public function edit($id = null)
	{
        $theme = $this->theme->where('theme_id', $id)->get();
        if (!$this) {
            $this->session->set_flashdata('warning', 'Theme data were not available');
            redirect('theme');
        }

        if (!$_POST) {
            $input = (object) $theme;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->theme->validate()) {
            $pages     = $this->pages;
            $main_view   = 'theme/form_theme';
            $form_action = "theme/edit/$id";

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->theme->where('theme_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect('theme');
	}
        
//--delete--        
        	public function delete($id = null)
	{
		$theme = $this->theme->where('theme_id', $id)->get();
        if (!$theme) {
            $this->session->set_flashdata('warning', 'Theme data were not available');
            redirect('theme');
        }

        if ($this->theme->where('theme_id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data deleted');
        } else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

        redirect('theme');
	}
        

    /*
    |-----------------------------------------------------------------
    | Callback
    |-----------------------------------------------------------------
    */        
        

//            public function alpha_numeric_coma_dash_dot_space($str)
//    {
//        if ( !preg_match('/^[a-zA-Z0-9 .,\-]+$/i',$str) )
//        {
//            $this->form_validation->set_message('alpha_numeric_coma_dash_dot_space', 'Can only be filled with letters, numbers, dash(-), dot(.), and comma(,).');
//            return false;
//        }
//    }
    
        public function unique_theme_name()
    {
        $theme_name = $this->input->post('theme_name');
        $theme_id   = $this->input->post('theme_id');

        $this->theme->where('theme_name', $theme_name);
        !$theme_id || $this->theme->where('theme_id !=', $theme_id);
        $theme = $this->theme->get();

        if (count($theme)) {
            $this->form_validation->set_message('unique_theme_name', '%s has been used');
            return false;
        }
        return true;
    }
}