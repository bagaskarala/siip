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
        $worksheets     = $this->worksheet->join('draft')->orderBy('draft.draft_id', 'desc')->orderBy('worksheet_id', 'desc')->paginate($page)->getAll();
        $tot        = $this->worksheet->join('draft')->orderBy('draft.draft_id', 'desc')->orderBy('worksheet_id', 'desc')->getAll();
        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
        $pagination = $this->worksheet->makePagination(site_url($this->pages), 3, $total);

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
            $main_view   = $this->pages . '/form_' . $this->pages;
            $form_action = $this->pages;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->worksheet->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect($this->pages);
	}
        
        public function edit($id = null)
	{
            
        $worksheet = $this->worksheet->where('worksheet_id', $id)->get();
        $data = array('draft_id' => $worksheet->draft_id);
        $draft_title = $this->worksheet->getWhere($data, 'draft');

        $worksheet->draft_title = $draft_title->draft_title;

        if (!$worksheet) {
            $this->session->set_flashdata('warning', 'Worksheet data were not available');
            redirect($this->pages);
        }

        if (!$_POST) {
            $input = (object) $worksheet;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->worksheet->validate()) {
            $pages    = $this->pages;
            $main_view   = $this->pages . '/form_' . $this->pages;
            $form_action = $this->pages . '/edit/' . $id;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->worksheet->where('worksheet_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect($this->pages);
	}
        
        public function action($id, $action)
	{
    	$worksheet = $this->worksheet->where('worksheet_id', $id)->get();

        if (!$worksheet) {
            $this->session->set_flashdata('warning', 'Worksheet data were not available');
            redirect($this->pages);
        }

        $data = array('worksheet_status' => $action, 'worksheet_pic' => $this->username);

        if ($this->worksheet->where('worksheet_id', $id)->update($data)) {
            $status = array('draft_status' => $action);
            $this->worksheet->updateDraftStatus($worksheet->draft_id, $status);

            $affected_rows = $this->db->affected_rows();

            if ($affected_rows > 0) {
                $actionMessage = 'Approved';
                if ($action == '2') {
                    $actionMessage = 'Rejected';
                }

                $this->worksheet->insert(array('draft_id' => $worksheet->draft_id), 'transaction');
                
                $this->session->set_flashdata('success', "Worksheet $actionMessage");
            } else {
                $this->session->set_flashdata('warning', 'Worksheet Failed to Update');
            }
		} else {
            $this->session->set_flashdata('warning', 'Worksheet Failed to Update');
        }

		redirect($this->pages);
	}
        
        public function search($page = null)
        {
        $keywords       = $this->input->get('keywords', true);
        $worksheets     = $this->worksheet->like('worksheet_num', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->join('draft')
                                  ->orderBy('worksheet_id')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('worksheet_num')  
                                  ->paginate($page)
                                  ->getAll();
        $tot            = $this->worksheet->like('worksheet_num', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->join('draft')
                                  ->orderBy('worksheet_id')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('worksheet_num')  
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->worksheet->makePagination(site_url('admin/worksheet/search/'), 3, $total);

        if (!$worksheets) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect($this->pages);
        }

        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
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
    
        public function unique_worksheet_draft()
    {
        $draft_id      = $this->input->post('draft_id');
        $worksheet_id = $this->input->post('worksheet_id');

        $this->worksheet->where('draft_id', $draft_id);
        !$worksheet_id || $this->worksheet->where('worksheet_id !=', $worksheet_id);
        $worksheet = $this->worksheet->get();

        if (count($worksheet)) {
            $this->form_validation->set_message('unique_worksheet_draft', '%s has been used');
            return false;
        }
        return true;
    }
    
    

}