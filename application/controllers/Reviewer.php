<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'reviewer';
    }

	public function index($page = null)
	{
        $reviewers     = $this->reviewer->join('faculty')->join('user')->orderBy('faculty.faculty_id')->orderBy('reviewer_id')->paginate($page)->getAll();
        $tot        = $this->reviewer->join('faculty')->join('user')->orderBy('faculty.faculty_id')->orderBy('reviewer_id')->getAll();
        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = 'reviewer/index_reviewer';
        $pagination = $this->reviewer->makePagination(site_url('reviewer'), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'reviewers', 'pagination', 'total'));
	}
        
        
        public function add()
	{
        if (!$_POST) {
            $input = (object) $this->reviewer->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->reviewer->validate()) {
            $pages     = $this->pages;
            $main_view   = 'reviewer/form_reviewer';
            $form_action = 'reviewer/add';

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->reviewer->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect('reviewer');
	}
        
        public function edit($id = null)
	{
        $reviewer = $this->reviewer->where('reviewer_id', $id)->get();
        if (!$reviewer) {
            $this->session->set_flashdata('warning', 'Reviewer data were not available');
            redirect('reviewer');
        }

        if (!$_POST) {
            $input = (object) $reviewer;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->reviewer->validate()) {
            $pages    = $this->pages;
            $main_view   = 'reviewer/form_reviewer';
            $form_action = "reviewer/edit/$id";

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->reviewer->where('reviewer_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect('reviewer');
	}
        
        public function delete($id = null)
	{
	$reviewer = $this->reviewer->where('reviewer_id', $id)->get();
        if (!$reviewer) {
            $this->session->set_flashdata('warning', 'Reviewer data were not available');
            redirect('reviewer');
        }

        if ($this->reviewer->where('reviewer_id', $id)->delete()) {
			$this->session->set_flashdata('success', 'Data deleted');
		} else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

		redirect('reviewer');
	}
        
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $reviewers     = $this->reviewer->where('reviewer_nip', $keywords)
                                  ->orLike('reviewer_name', $keywords)
                                  ->orLike('faculty_name', $keywords)
                                  ->orLike('username', $keywords)
                                  ->join('faculty')
                                  ->join('user')
                                  ->orderBy('faculty.faculty_id')
                                  ->orderBy('reviewer_name')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->reviewer->where('reviewer_id', $keywords)
                                  ->orLike('reviewer_name', $keywords)
                                  ->join('faculty')
                                  ->orderBy('faculty.faculty_id')
                                  ->orderBy('reviewer_name')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->reviewer->makePagination(site_url('reviewer/search/'), 3, $total);

        if (!$reviewers) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect('reviewer');
        }

        $pages    = $this->pages;
        $main_view  = 'reviewer/index_reviewer';
        $this->load->view('template', compact('pages', 'main_view', 'reviewers', 'pagination', 'total'));
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
    public function unique_reviewer_nip()
    {
        $reviewer_nip      = $this->input->post('reviewer_nip');
        $reviewer_id = $this->input->post('reviewer_id');

        $this->reviewer->where('reviewer_nip', $reviewer_nip);
        !$reviewer_id || $this->reviewer->where('reviewer_id !=', $reviewer_id);
        $reviewer = $this->reviewer->get();

        if (count($reviewer)) {
            $this->form_validation->set_message('unique_reviewer_nip', '%s has been used');
            return false;
        }
        return true;
    }
    
        public function unique_reviewer_username()
    {
        $user_id      = $this->input->post('user_id');
        $reviewer_id = $this->input->post('reviewer_id');

        $this->reviewer->where('user_id', $user_id);
        !$reviewer_id || $this->reviewer->where('reviewer_id !=', $reviewer_id);
        $reviewer = $this->reviewer->get();

        if (count($reviewer)) {
            $this->form_validation->set_message('unique_reviewer_username', '%s has been used');
            return false;
        }
        return true;
    }
}