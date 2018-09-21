<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Work_unit extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'work_unit';
    }
//--index--
	public function index($page = null)
	{
        $work_units     = $this->work_unit->orderBy('work_unit_id')->getAll();
        $total    = count($work_units);
        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
		$this->load->view('template', compact('pages', 'main_view', 'work_units', 'total'));
	}
        
//--add--
        public function add()
	{
            
        if (!$_POST) {
            $input = (object) $this->work_unit->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->work_unit->validate()) {
            $pages   = $this->pages;
            $main_view   = $this->pages . '/form_' . $this->pages;
            $form_action = $this->pages;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->work_unit->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect($this->pages);
	}
        
//--edit--        
        public function edit($id = null)
	{
            
        $work_unit = $this->work_unit->where('work_unit_id', $id)->get();
        if (!$this) {
            $this->session->set_flashdata('warning', 'Work Unit data were not available');
            redirect($this->pages);
        }

        if (!$_POST) {
            $input = (object) $work_unit;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->work_unit->validate()) {
            $pages     = $this->pages;
            $main_view   = $this->pages . '/form_' . $this->pages;
            $form_action = $this->pages . '/' . $id;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->work_unit->where('work_unit_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect($this->pages);
	}
        
//--delete--        
        	public function delete($id = null)
	{
		$code = $this->work_unit->where('work_unit_id', $id)->get();
        if (!$code) {
            $this->session->set_flashdata('warning', 'Work Unit data were not available');
            redirect($this->pages);
        }

        if ($this->work_unit->where('work_unit_id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data deleted');
        } else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

        redirect($this->pages);
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
    
        public function unique_work_unit_name()
    {
        $work_unit_name = $this->input->post('work_unit_name');
        $work_unit_id   = $this->input->post('work_unit_id');

        $this->work_unit->where('work_unit_name', $work_unit_name);
        !$work_unit_id || $this->work_unit->where('work_unit_id !=', $work_unit_id);
        $work_unit = $this->work_unit->get();

        if (count($work_unit)) {
            $this->form_validation->set_message('unique_work_unit_name', '%s has been used');
            return false;
        }
        return true;
    }
}