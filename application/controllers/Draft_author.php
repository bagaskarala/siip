<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Draft_author extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'draft_author';
    }

	public function index($page = null)
	{
        $draft_authors     = $this->draft_author->join('draft')->join('author')->orderBy('draft.draft_id')->orderBy('author.author_id')->orderBy('draft_author_id')->paginate($page)->getAll();
        $tot        = $this->draft_author->join('draft')->join('author')->orderBy('draft.draft_id')->orderBy('author.author_id')->orderBy('draft_author_id')->getAll();
        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = 'draftauthor/index_draft_author';
        $pagination = $this->draft_author->makePagination(site_url('draftauthor'), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'draft_authors', 'pagination', 'total'));
	}
        
        
        public function add()
	{
        if (!$_POST) {
            $input = (object) $this->draft_author->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->draft_author->validate()) {
            $pages     = $this->pages;
            $main_view   = 'draftauthor/form_draft_author';
            $form_action = 'draftauthor/add';

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->draft_author->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect('draftauthor');
	}
        
        public function edit($id = null)
	{
        $draft_author = $this->draft_author->where('draft_author_id', $id)->get();
        if (!$draft_author) {
            $this->session->set_flashdata('warning', 'Draft Author data were not available');
            redirect('draftauthor');
        }

        if (!$_POST) {
            $input = (object) $draft_author;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->draft_author->validate()) {
            $pages    = $this->pages;
            $main_view   = 'draftauthor/form_draft_author';
            $form_action = "draftauthor/edit/$id";

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->draft_author->where('draft_author_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect('draftauthor');
	}
        
        public function delete($id = null)
	{
	$draft_author = $this->draft_author->where('draft_author_id', $id)->get();
        if (!$draft_author) {
            $this->session->set_flashdata('warning', 'Draft Author data were not available');
            redirect('draftauthor');
        }

        if ($this->draft_author->where('draft_author_id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data deleted');
		} else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

		redirect('draftauthor');
	}
        
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $draft_authors     = $this->draft_author->where('draft_author_id', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('author_name', $keywords)
                                  ->orLike('author_nip', $keywords)
                                  ->join('draft')
                                  ->join('author')
                                  ->orderBy('draft_author_id')
                                  ->orderBy('draft.draft_title')
                                  ->orderBy('author.author_name')                
                                  ->orderBy('author.author_nip')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->draft_author->where('draft_author_id', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('author_name', $keywords)
                                  ->orLike('author_nip', $keywords)
                                  ->join('draft')
                                  ->join('author')
                                  ->orderBy('draft_author_id')
                                  ->orderBy('draft.draft_title')
                                  ->orderBy('author.author_name')                
                                  ->orderBy('author.author_nip')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->draft_author->makePagination(site_url('draft_author/search/'), 3, $total);

        if (!$draft_authors) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect('draftauthor');
        }

        $pages    = $this->pages;
        $main_view  = 'draftauthor/index_draft_author';
        $this->load->view('template', compact('pages', 'main_view', 'draft_authors', 'pagination', 'total'));
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
    public function unique_draft_author_match()
    {
        $author_id      = $this->input->post('author_id');
        $draft_id      = $this->input->post('draft_id');
        $draft_author_id = $this->input->post('draft_author_id');

        $this->draft_author->where('author_id', $author_id);
        $this->draft_author->where('draft_id', $draft_id);
        !$draft_author_id || $this->draft_author->where('draft_author_id !=', $draft_author_id);
        $draft_author = $this->draft_author->get();

        if (count($draft_author)) {
            $this->form_validation->set_message('unique_draft_author_match', 'Both of %s has been used');
            return false;
        }
        return true;
    }

}