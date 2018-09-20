<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Responsibility extends Admin_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'responsibility';
    }

	public function index($page = null)
	{
        $responsibilities     = $this->responsibility->join('draft')->join('user')->orderBy('draft.draft_id')->orderBy('user.user_id')->orderBy('responsibility_id')->paginate($page)->getAll();
        $tot        = $this->responsibility->join('draft')->join('user')->orderBy('draft.draft_id')->orderBy('user.user_id')->orderBy('responsibility_id')->getAll();
        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = $this->role . '/'. $this->pages . '/index_' . $this->pages;
        $pagination = $this->responsibility->makePagination(site_url($this->role . '/' . $this->pages), 3, $total);

		$this->load->view('template', compact('pages', 'main_view', 'responsibilities', 'pagination', 'total'));
	}
        
        
        public function add()
	{
            $act = 'add';
            
        if (!$_POST) {
            $input = (object) $this->responsibility->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->responsibility->validate()) {
            $pages     = $this->pages;
            $main_view   = $this->role . '/' . $this->pages . '/form_' . $this->pages . '_' . $act;
            $form_action = $this->role . '/' . $this->pages . '/' . $act;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->responsibility->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect($this->role . '/' . $this->pages);
	}
        
        public function edit($id = null)
	{
            $act = 'edit';
            
        $responsibility = $this->responsibility->where('responsibility_id', $id)->get();
        if (!$responsibility) {
            $this->session->set_flashdata('warning', 'Responsibility data were not available');
            redirect($this->role . '/' . $this->pages);
        }

        if (!$_POST) {
            $input = (object) $responsibility;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->responsibility->validate()) {
            $pages    = $this->pages;
            $main_view   = $this->role . '/' . $this->pages . '/form_' . $this->pages . '_' . $act;
            $form_action = $this->role . '/' . $this->pages . '/' . $act . '/' . $id;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->responsibility->where('responsibility_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect($this->role . '/' . $this->pages);
	}
        
        public function delete($id = null)
	{
	$responsibility = $this->responsibility->where('responsibility_id', $id)->get();
        if (!$responsibility) {
            $this->session->set_flashdata('warning', 'Responsibility data were not available');
            redirect($this->role . '/' . $this->pages);
        }

        if ($this->responsibility->where('responsibility_id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data deleted');
		} else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

		redirect($this->role . '/' . $this->pages);
	}
        
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $responsibilities     = $this->responsibility->like('responsibility_id', $keywords)
                                  ->orLike('user_id', $keywords)
                                  ->join('draft')
                                  ->join('user')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('user.user_id')                
                                  ->orderBy('responsibility_id')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->responsibility->like('responsibility_id', $keywords)
                                  ->orLike('user_id', $keywords)
                                  ->join('draft')
                                  ->join('user')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('user.user_id')                
                                  ->orderBy('responsibility_id')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->responsibility->makePagination(site_url('superadmin/responsibility/search/'), 3, $total);

        if (!$responsibilities) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect($this->role . '/' . $this->pages);
        }

        $pages    = $this->pages;
        $main_view  = $this->role . '/'. $this->pages . '/index_' . $this->pages;
        $this->load->view('template', compact('pages', 'main_view', 'responsibilities', 'pagination', 'total'));
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
    public function unique_responsibility_match()
    {
        $user_id      = $this->input->post('user_id');
        $draft_id      = $this->input->post('draft_id');
        $responsibility_id = $this->input->post('responsibility_id');

        $this->responsibility->where('user_id', $user_id);
        $this->responsibility->where('draft_id', $draft_id);
        !$responsibility_id || $this->responsibility->where('responsibility_id !=', $responsibility_id);
        $responsibility = $this->responsibility->get();

        if (count($responsibility)) {
            $this->form_validation->set_message('unique_responsibility_match', 'Both of %s has been used');
            return false;
        }
        return true;
    }

}