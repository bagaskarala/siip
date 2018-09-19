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
            $authors = $this->draft->getIdAndName('author', 'draft_author', $value->draft_id);
            $value->author = $authors;
            $value->status = $this->checkStatus($value->status);
        }

        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = $this->role . '/draft/index_draft';
        $pagination = $this->draft->makePagination(site_url($this->role . '/draft'), 3, $total);

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

        $isSuccess = true;

        if ($draft_id > 0) {
            foreach ($input->author_id as $key => $value) {
                $data_author = array('author_id' => $value, 'draft_id' => $draft_id);

                $draft_author_id = $this->draft->insert($data_author, 'draft_author');

                if ($draft_author_id < 1 ) {
                    $isSuccess = false;
                    break;
                }
            }
        } else {
            $isSuccess = false;
        }

        if ($isSuccess) {
            $data_worksheet = array('draft_id' => $draft_id);
            $worksheet_id = $this->draft->insert($data_worksheet, 'worksheet');

            if ($worksheet_id < 1) {
                $isSuccess = false;
            }
        }

        if ($isSuccess) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data author failed to save');
        } 

        redirect('draft');
      }
     
// -- edit --
      
      public function edit($id = null)
	{
        $draft = $this->draft->where('draft_id', $id)->get();
        $authors = $this->draft->getIdAndName('author', 'draft_author', $draft->draft_id);

        $author_id = array();

        foreach ($authors as $key => $value) {
            $author_id[$key] = $value->author_id;
        }

        $draft->author_id = $author_id;

        if (!$draft) {
            $this->session->set_flashdata('warning', 'Draft data were not available');
            redirect('draft');
        }

        if (!$_POST) {
            $input = (object) $draft;
            $pages    = $this->pages;
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

        $isSuccess = true;

        if ($this->draft->where('draft_id', $id)->update($input)) {
            foreach ($input->author_id as $key => $value) {
                if (isset($draft->author_id[$key])) {
                    $draft_author_id = $this->draft->select('draft_author_id')
                                                   ->where('author_id', $draft->author_id[$key])
                                                   ->where('draft_id', $id)
                                                   ->get('draft_author')
                                                   ->draft_author_id;

                    if ($draft_author_id > 0) {
                        $isSuccess = true;
                        $data_input = array('author_id' => $value);

                        $this->draft->where('draft_author_id', $draft_author_id)
                                    ->update($data_input, 'draft_author');
                    } else {
                        $isSuccess = false;
                        break;
                    }
                } else {
                    $isSuccess = true;
                    $data_author = array('author_id' => $value, 'draft_id' => $id);

                    $draft_author_id = $this->draft->insert($data_author, 'draft_author');

                    if ($draft_author_id < 1) {
                        $isSuccess = false;
                        break;
                    }
                }
            }
        } else {
            $isSuccess = false;
        }

        if ($isSuccess) {
            $this->session->set_flashdata('success', 'Data Updated');
        } else {
            $this->session->set_flashdata('error', 'Data Failed to Update');
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

        $isSuccess = true;

        $this->draft->where('draft_id', $id)
                    ->delete('draft_author');

        $affected_rows = $this->db->affected_rows();

        if ($affected_rows > 0) {
            if ($this->draft->where('draft_id', $id)->delete()) {
                // Delete cover.
                $this->draft->deleteDraftfile($draft->draft_file);
            } else {
                $isSuccess = false;
            }
        } else {
            $isSuccess = false;
        }

        if ($isSuccess) {
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

    public function checkStatus($code) {
        $status = "";
        switch ($code) {
            case 0:
                $status = 'Waiting for Worksheet';
                break;
            case 1:
                $status = 'Worksheet Rejected';
                break;
            case 2:
                $status = 'Choosing Reviewer';
                break;
            case 3:
                $status = 'Reviewer Rejected';
                break;
            case 4:
                $status = 'Process Review';
                break;
            case 5:
                $status = 'Review Done';
                break;
            case 6:
                $status = 'Choosing Editor';
                break;
            case 7:
                $status = 'Process Editor';
                break;
            case 8:
                $status = 'Edit Done';
                break;
            case 9:
                $status = 'Choosing Layouter';
                break;
            case 10:
                $status = 'Process Layouter';
                break;
            case 11:
                $status = 'Layout Done';
                break;
            case 12:
                $status = 'Choosing Proofread';
                break;
            case 13:
                $status = 'Process Proofread';
                break;
            case 14:
                $status = 'Proofread Done';
                break;
            case 15:
                $status = 'Choosing Layouter';
                break;
            case 16:
                $status = 'Process Layouter';
                break;
            case 17:
                $status = 'Layout Done';
                break;
            
            default:
                # code...
                break;
        }

        return $status;
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

        if ($draft) {
            $this->form_validation->set_message('unique_draft_title', '%s has been used');
            return false;
        }
        return true;
    }

    public function unique_draft_title_author()
    {
        // $draft_title     = $this->input->post('draft_title');
        // $author_id     = $this->input->post('author_id')[0];
        // $draft_id = $this->input->post('draft_id');
        
        // $this->draft->where('author_id', $author_id);
        // $this->draft->where('draft_title', $draft_title);
        // !$draft_id || $this->draft->where('draft_id !=', $draft_id);
        // $draft = $this->draft->get();

        // if ($draft) {
        //     $this->form_validation->set_message('unique_draft_title_author', 'Title and Author Name has been used');
        //     return false;
        // }
        return true;
    }    

    
}