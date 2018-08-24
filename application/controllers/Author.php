<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'author';
    }

	public function index($page = null)
	{
        $authors     = $this->author->join('work_unit')->join('institute')->join('bank')->orderBy('work_unit.work_unit_id')->orderBy('institute.institute_id')->orderBy('author_id')->paginate($page)->getAll();
        $tot        = $this->author->join('work_unit')->join('institute')->join('bank')->orderBy('work_unit.work_unit_id')->orderBy('institute.institute_id')->orderBy('author_id')->getAll();
        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = 'author/index_author';
        $pagination = $this->author->makePagination(site_url('author'), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'authors', 'pagination', 'total'));
	}
        
        
        public function add()
	{
        if (!$_POST) {
            $input = (object) $this->author->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->author->validate()) {
            $pages     = $this->pages;
            $main_view   = 'author/form_author';
            $form_action = 'author/add';

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->author->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect('author');
	}
        
        public function edit($id = null)
	{
        $author = $this->author->where('author_id', $id)->get();
        if (!$author) {
            $this->session->set_flashdata('warning', 'Author data were not available');
            redirect('author');
        }

        if (!$_POST) {
            $input = (object) $author;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->author->validate()) {
            $pages    = $this->pages;
            $main_view   = 'author/form_author';
            $form_action = "author/edit/$id";

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->author->where('author_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect('author');
	}
        
        public function delete($id = null)
	{
	$author = $this->author->where('author_id', $id)->get();
        if (!$author) {
            $this->session->set_flashdata('warning', 'Author data were not available');
            redirect('author');
        }

        if ($this->author->where('author_id', $id)->delete()) {
			$this->session->set_flashdata('success', 'Data deleted');
		} else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

		redirect('author');
	}
        
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $authors     = $this->author->where('author_id', $keywords)
                                  ->orLike('author_name', $keywords)
                                  ->join('work_unit')
                                  ->join('institute')
                                  ->join('bank')
                                  ->orderBy('work_unit.work_unit_id')
                                  ->orderBy('institute.institute_id')                
                                  ->orderBy('author_name')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->author->where('author_id', $keywords)
                                  ->orLike('author_name', $keywords)
                                  ->join('work_unit')
                                  ->join('institute')
                                  ->join('bank')
                                  ->orderBy('work_unit.work_unit_id')
                                  ->orderBy('institute.institute_id')                
                                  ->orderBy('author_name')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->author->makePagination(site_url('author/search/'), 3, $total);

        if (!$authors) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect('author');
        }

        $pages    = $this->pages;
        $main_view  = 'author/index_author';
        $this->load->view('template', compact('pages', 'main_view', 'authors', 'pagination', 'total'));
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
    public function unique_author_contact()
    {
        $author_contact      = $this->input->post('author_contact');
        $author_id = $this->input->post('author_id');

        $this->author->where('author_contact', $author_contact);
        !$author_id || $this->author->where('author_id !=', $author_id);
        $author = $this->author->get();

        if (count($author)) {
            $this->form_validation->set_message('unique_author_contact', '%s has been used');
            return false;
        }
        return true;
    }
    
        public function unique_author_email()
    {
        $author_email      = $this->input->post('author_email');
        $author_id = $this->input->post('author_id');

        $this->author->where('author_email', $author_email);
        !$author_id || $this->author->where('author_id !=', $author_id);
        $author = $this->author->get();

        if (count($author)) {
            $this->form_validation->set_message('unique_author_email', '%s has been used');
            return false;
        }
        return true;
    }
    
            public function unique_author_saving_num()
    {
        $author_saving_num      = $this->input->post('author_saving_num');
        $author_id = $this->input->post('author_id');

        $this->author->where('author_saving_num', $author_saving_num);
        !$author_id || $this->author->where('author_id !=', $author_id);
        $author = $this->author->get();

        if (count($author)) {
            $this->form_validation->set_message('unique_author_saving_num', '%s has been used');
            return false;
        }
        return true;
    }
            public function unique_author_nip()
    {
        $author_nip      = $this->input->post('author_nip');
        $author_id = $this->input->post('author_id');

        $this->author->where('author_nip', $author_nip);
        !$author_id || $this->author->where('author_id !=', $author_id);
        $author = $this->author->get();

        if (count($author)) {
            $this->form_validation->set_message('unique_author_nip', '%s has been used');
            return false;
        }
        return true;
    }
}