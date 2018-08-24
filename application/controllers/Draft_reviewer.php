<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Draft_reviewer extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'draft_reviewer';
    }

	public function index($page = null)
	{
        $draft_reviewers     = $this->draft_reviewer->join('draft')->join('reviewer')->orderBy('draft.draft_id')->orderBy('reviewer.reviewer_id')->orderBy('draft_reviewer_id')->paginate($page)->getAll();
        $tot        = $this->draft_reviewer->join('draft')->join('reviewer')->orderBy('draft.draft_id')->orderBy('reviewer.reviewer_id')->orderBy('draft_reviewer_id')->getAll();
        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = 'draftreviewer/index_draft_reviewer';
        $pagination = $this->draft_reviewer->makePagination(site_url('draftreviewer'), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'draft_reviewers', 'pagination', 'total'));
	}
        
        
        public function add()
	{
        if (!$_POST) {
            $input = (object) $this->draft_reviewer->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->draft_reviewer->validate()) {
            $pages     = $this->pages;
            $main_view   = 'draftreviewer/form_draft_reviewer';
            $form_action = 'draftreviewer/add';

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->draft_reviewer->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect('draftreviewer');
	}
        
        public function edit($id = null)
	{
        $draft_reviewer = $this->draft_reviewer->where('draft_reviewer_id', $id)->get();
        if (!$draft_reviewer) {
            $this->session->set_flashdata('warning', 'Draft Reviewer data were not available');
            redirect('draftreviewer');
        }

        if (!$_POST) {
            $input = (object) $draft_reviewer;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->draft_reviewer->validate()) {
            $pages    = $this->pages;
            $main_view   = 'draftreviewer/form_draft_reviewer';
            $form_action = "draftreviewer/edit/$id";

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->draft_reviewer->where('draft_reviewer_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect('draftreviewer');
	}
        
        public function delete($id = null)
	{
	$draft_reviewer = $this->draft_reviewer->where('draft_reviewer_id', $id)->get();
        if (!$draft_reviewer) {
            $this->session->set_flashdata('warning', 'Draft Reviewer data were not available');
            redirect('draftreviewer');
        }

        if ($this->draft_reviewer->where('draft_reviewer_id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data deleted');
		} else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

		redirect('draftreviewer');
	}
        
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $draft_reviewers     = $this->draft_reviewer->where('draft_reviewer_id', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('reviewer_name', $keywords)
                                  ->orLike('reviewer_nip', $keywords)
                                  ->join('draft')
                                  ->join('reviewer')
                                  ->orderBy('draft_reviewer_id')
                                  ->orderBy('draft.draft_title')
                                  ->orderBy('reviewer.reviewer_name')                
                                  ->orderBy('reviewer.reviewer_nip')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->draft_reviewer->where('draft_reviewer_id', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('reviewer_name', $keywords)
                                  ->orLike('reviewer_nip', $keywords)
                                  ->join('draft')
                                  ->join('reviewer')
                                  ->orderBy('draft_reviewer_id')
                                  ->orderBy('draft.draft_title')
                                  ->orderBy('reviewer.reviewer_name')                
                                  ->orderBy('reviewer.reviewer_nip')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->draft_reviewer->makePagination(site_url('draft_reviewer/search/'), 3, $total);

        if (!$draft_reviewers) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect('draftreviewer');
        }

        $pages    = $this->pages;
        $main_view  = 'draftreviewer/index_draft_reviewer';
        $this->load->view('template', compact('pages', 'main_view', 'draft_reviewers', 'pagination', 'total'));
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
//    public function unique_author_contact()
//    {
//        $author_contact      = $this->input->post('author_contact');
//        $author_id = $this->input->post('author_id');
//
//        $this->author->where('author_contact', $author_contact);
//        !$author_id || $this->author->where('author_id !=', $author_id);
//        $author = $this->author->get();
//
//        if (count($author)) {
//            $this->form_validation->set_message('unique_author_contact', '%s has been used');
//            return false;
//        }
//        return true;
//    }

}