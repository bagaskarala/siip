<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Worksheet extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'worksheet';
    }

	public function index($page = null)
	{
        $worksheets     = $this->worksheet->join('draft')->orderBy('draft.draft_id')->orderBy('worksheet_id')->paginate($page)->getAll();
        $tot        = $this->worksheet->join('draft')->orderBy('draft.draft_id')->orderBy('worksheet_id')->getAll();
        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = 'worksheet/index_worksheet';
        $pagination = $this->worksheet->makePagination(site_url('worksheet'), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'worksheets', 'pagination', 'total'));
	}
        
        
        public function add()
	{
        if (!$_POST) {
            $input = (object) $this->worksheet->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->worksheet->validate()) {
            $pages     = $this->pages;
            $main_view   = 'worksheet/form_worksheet';
            $form_action = 'worksheet/add';

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->worksheet->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect('worksheet');
	}
        
        public function edit($id = null)
	{
        $worksheet = $this->worksheet->where('worksheet_id', $id)->get();
        if (!$worksheet) {
            $this->session->set_flashdata('warning', 'Worksheet data were not available');
            redirect('worksheet');
        }

        if (!$_POST) {
            $input = (object) $worksheet;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->worksheet->validate()) {
            $pages    = $this->pages;
            $main_view   = 'worksheet/form_worksheet';
            $form_action = "worksheet/edit/$id";

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->worksheet->where('worksheet_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect('worksheet');
	}
        
        public function delete($id = null)
	{
	$worksheet = $this->worksheet->where('worksheet_id', $id)->get();
        if (!$worksheet) {
            $this->session->set_flashdata('warning', 'Worksheet data were not available');
            redirect('worksheet');
        }

        if ($this->worksheet->where('worksheet_id', $id)->delete()) {
			$this->session->set_flashdata('success', 'Data deleted');
		} else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

		redirect('worksheet');
	}
        
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $worksheets     = $this->worksheet->where('worksheet_id', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->join('draft')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('draft_title')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->worksheet->where('worksheet_id', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->join('draft')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('worksheet_num')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->worksheet->makePagination(site_url('worksheet/search/'), 3, $total);

        if (!$worksheets) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect('worksheet');
        }

        $pages    = $this->pages;
        $main_view  = 'worksheet/index_worksheet';
        $this->load->view('template', compact('pages', 'main_view', 'worksheets', 'pagination', 'total'));
    }
        
        /*
    |-----------------------------------------------------------------
    | Callback
    |-----------------------------------------------------------------
    */
//    public function alpha_coma_dash_dot_space($str)
//    {
//        if ( !preg_match('/^[a-zA-Z .,\-]+$/i',$str) )
//        {
//            $this->form_validation->set_message('alpha_coma_dash_dot_space', 'Can only be filled with letters, numbers, dash(-), dot(.), and comma(,).');
//            return false;
//        }
//    }
//
    public function unique_worksheet_num()
    {
        $worksheet_num      = $this->input->post('worksheet_num');
        $worksheet_id = $this->input->post('worksheet_id');

        $this->worksheet->where('worksheet_num', $worksheet_num);
        !$worksheet_id || $this->worksheet->where('worksheet_id !=', $worksheet_id);
        $worksheet = $this->worksheet->get();

        if (count($worksheet)) {
            $this->form_validation->set_message('unique_worksheet_num', '%s has been used');
            return false;
        }
        return true;
    }
    
    

}