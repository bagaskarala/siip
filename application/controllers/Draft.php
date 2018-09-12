<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Draft extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'draft';
    }

	public function index($page = null)
	{
        $drafts     = $this->draft->join('category')->join('theme')->orderBy('category.category_id')->orderBy('theme.theme_id')->orderBy('draft_id')->paginate($page)->getAll();
        $tot        = $this->draft->join('category')->join('theme')->orderBy('category.category_id')->orderBy('theme.theme_id')->orderBy('draft_id')->getAll();

        foreach ($drafts as $key => $value) {
            $authors = $this->commonlibs->getIdAndName('author', 'draft_author', 'draft', $value->draft_id);
            $value->author = $authors;
        }

        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = 'draft/index_draft';
        $pagination = $this->draft->makePagination(site_url('draft'), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'drafts', 'pagination', 'total'));
	}
        
        
// --add--        
        public function add()
	{
        if (!$_POST) {
            $input = (object) $this->draft->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['draft_file']['size'] > 0) {
            $getextension=explode(".",$_FILES['draft_file']['name']);            
            $draftFileName  = str_replace(" ","_",$input->draft_title . '_' . date('YmdHis').".".$getextension[1]) ; // draft file name
            $upload = $this->draft->uploadDraftfile('draft_file', $draftFileName);

            if ($upload) {
                $input->draft_file =  "$draftFileName"; // Data for column "draft".
            }
        }   

        if (!$this->draft->validate() || $this->form_validation->error_array()) {
            $pages     = $this->pages;
            $main_view   = 'draft/form_draft_add';
            $form_action = 'draft/add';
            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        $draft_id = $this->draft->insert($input);

        if ($draft_id > 0) {
            foreach ($input->author_id as $key => $value) {
                    if ($this->commonlibs->insertIntoDifferentTable('draft_author', 'author', 'draft', $value, $draft_id)) {
                    $this->session->set_flashdata('success', 'Data saved');
                } else {
                    $this->session->set_flashdata('error', 'Data author failed to save');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect('draft');
      }
     
// -- edit --
      
      public function edit($id = null)
	{
        $draft = $this->draft->where('draft_id', $id)->get();
        $author = $this->commonlibs->getIdAndName('author', 'draft_author', 'draft', $draft->draft_id);
        $draft->author = $author;

        if (!$draft) {
            $this->session->set_flashdata('warning', 'Draft data were not available');
            redirect('draft');
        }

        if (!$_POST) {
            $input = (object) $draft;$pages    = $this->pages;
        } else {
            $input = (object) $this->input->post(null, true);
            $input->draft_file = $draft->draft_file; // Set draft file for preview.
        }

        
         if (!empty($_FILES) && $_FILES['draft_file']['size'] > 0) {
            // Upload new draft (if any)
            $getextension=explode(".",$_FILES['draft_file']['name']);            
            $draftFileName  = str_replace(" ","_",$input->draft_title . '_' . date('YmdHis').".".$getextension[1]); // draft file name
            $upload = $this->draft->uploadDraftfile('draft_file', $draftFileName);

            if ($upload) {
                $input->draft_file =  "$draftFileName";
                // Delete old draft file
                if ($draft->draft_file) {
                    $this->draft->deleteDraftfile($draft->draft_file);
                }
            }
        }   
        
        // If something wrong
        if (!$this->draft->validate() || $this->form_validation->error_array()) {
            $pages    = $this->pages;
            $main_view   = 'draft/form_draft_edit';
            $form_action = "draft/edit/$id";

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->draft->where('draft_id', $id)->update($input)) {
            foreach ($input->author_id as $key => $value) {
                if (isset($draft->author[$key])) {
                    if ($this->commonlibs->updateIntoDifferentTable('draft_author', 'author', 'draft', $value, $id, $draft->author[$key]->author_id)) {
                        $this->session->set_flashdata('success', 'Data updated');
                    } else {
                        $this->session->set_flashdata('error', 'Data failed to update');
                    }
                } else {
                    if ($this->commonlibs->insertIntoDifferentTable('draft_author', 'author', 'draft', $value, $id)) {
                        $this->session->set_flashdata('success', 'Data saved');
                    } else {
                        $this->session->set_flashdata('error', 'Data author failed to save');
                    }
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect('draft');
	}

// -- delete --        
        public function delete($id = null)
	{
	$draft = $this->draft->where('draft_id', $id)->get();
        if (!$draft) {
            $this->session->set_flashdata('warning', 'Draft data were not available');
            redirect('draft');
        }

        if ($this->draft->where('draft_id', $id)->delete()) {
            // Delete cover.
            $this->draft->deleteDraftfile($draft->draft_file);
            $this->commonlibs->deleteDifferentTable('draft_author', 'draft', $id);
            $this->session->set_flashdata('success', 'Data deleted');
		} else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

		redirect('draft');
	}

// -- search --        
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $drafts     = $this->draft->like('category_name', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('theme_name', $keywords)
                                  ->orLike('author_name', $keywords)
                                  ->join('category')
                                  ->join('theme')
                                  ->join('author')
                                  ->orderBy('category.category_id')
                                  ->orderBy('theme.theme_id')                
                                  ->orderBy('draft_title')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->draft->like('category_name', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('theme_name', $keywords)
                                  ->orLike('author_name', $keywords)
                                  ->join('category')
                                  ->join('theme')
                                  ->join('author')
                                  ->orderBy('category.category_id')
                                  ->orderBy('theme.theme_id')                
                                  ->orderBy('draft_title')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->draft->makePagination(site_url('draft/search/'), 3, $total);

        if (!$drafts) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect('draft');
        }

        $pages    = $this->pages;
        $main_view  = 'draft/index_draft';
        $this->load->view('template', compact('pages', 'main_view', 'drafts', 'pagination', 'total'));
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
    public function unique_draft_title()
    {
        $draft_title     = $this->input->post('draft_title');
        $draft_id = $this->input->post('draft_id');

        $this->draft->where('draft_title', $draft_title);
        !$draft_id || $this->draft->where('draft_id !=', $draft_id);
        $draft = $this->draft->get();

        if (count($draft)) {
            $this->form_validation->set_message('unique_draft_title', '%s has been used');
            return false;
        }
        return true;
    }

    public function unique_draft_title_author()
    {
        $draft_title     = $this->input->post('draft_title');
        $author_id     = $this->input->post('author_id');
        $draft_id = $this->input->post('draft_id');
        
        $this->draft->where('author_id', $author_id);
        $this->draft->where('draft_title', $draft_title);
        !$draft_id || $this->draft->where('draft_id !=', $draft_id);
        $draft = $this->draft->get();

        if (count($draft)) {
            $this->form_validation->set_message('unique_draft_title_author', 'Title and Author Name has been used');
            return false;
        }
        return true;
    }    

    
}