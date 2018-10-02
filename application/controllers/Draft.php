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
        $drafts     = $this->draft->join('category')->join('theme')->orderBy('draft_id', 'desc')->orderBy('category.category_id')->orderBy('theme.theme_id')->paginate($page)->getAll();
        $tot        = $this->draft->join('category')->join('theme')->orderBy('draft_id', 'desc')->orderBy('category.category_id')->orderBy('theme.theme_id')->getAll();

        foreach ($drafts as $key => $value) {
            $authors = $this->draft->getIdAndName('author', 'draft_author', $value->draft_id);
            $value->author = $authors;
            $value->draft_status = $this->checkStatus($value->draft_status);
        }

        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
        $pagination = $this->draft->makePagination(site_url($this->pages), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'drafts', 'pagination', 'total'));
	}
        
        
// --add--        
        public function add()
	{
        $act = 'add';

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
            $main_view   = $this->pages . '/form_' . $this->pages . '_' . $act;
            $form_action = $this->pages . '/' . $act;
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
            $worksheet_num = $this->generateWorksheetNumber();

            $data_worksheet = array('draft_id' => $draft_id, 'worksheet_num' => $worksheet_num);
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

        redirect($this->pages);
      }
     
// -- edit --
      
      public function edit($id = null)
	{
        $act = 'edit';

        $draft = $this->draft->where('draft_id', $id)->get();
        $authors = $this->draft->getIdAndName('author', 'draft_author', $draft->draft_id);

        $author_id = array();

        foreach ($authors as $key => $value) {
            $author_id[$key] = $value->author_id;
        }

        $draft->author_id = $author_id;

        if (!$draft) {
            $this->session->set_flashdata('warning', 'Draft data were not available');
            redirect($this->pages);
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
            $main_view   = $this->pages . '/form_' . $this->pages . '_' . $act;
            $form_action = $this->pages . '/' . $act . '/' . $id;

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

        redirect($this->pages);
	}

// -- delete --        
        public function delete($id = null)
	{
	$draft = $this->draft->where('draft_id', $id)->get();
        if (!$draft) {
            $this->session->set_flashdata('warning', 'Draft data were not available');
            redirect($this->pages);
        }

        $isSuccess = true;

        $this->draft->where('draft_id', $id)
                    ->delete('draft_author');

        $affected_rows = $this->db->affected_rows();

        if ($affected_rows > 0) {
            if ($this->draft->where('draft_id', $id)->delete()) {
                // Delete draftfile.
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

		redirect($this->pages);
	}

// -- search --        
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $this->db->group_by('draft.draft_id');
        $drafts     = $this->draft->like('category_name', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('theme_name', $keywords)
                                  ->orLike('author_name', $keywords)
                                  ->join('category')
                                  ->join('theme')
                                  ->joinRelationMiddle('draft', 'draft_author')
                                  ->joinRelationDest('author', 'draft_author')
                                  ->orderBy('category.category_id')
                                  ->orderBy('theme.theme_id')                
                                  ->orderBy('draft_title')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->draft->like('category_name', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('theme_name', $keywords)
                                  ->join('category')
                                  ->join('theme')
                                  ->orderBy('category.category_id')
                                  ->orderBy('theme.theme_id')                
                                  ->orderBy('draft_title')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->draft->makePagination(site_url('admin/draft/search/'), 4, $total);

        if (!$drafts) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect($this->pages);
        } else {
            foreach ($drafts as $key => $value) {
                $authors = $this->draft->getIdAndName('author', 'draft_author', $value->draft_id);
                $value->author = $authors;
                $value->draft_status = $this->checkStatus($value->draft_status);
            }
        }

        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
        $this->load->view('template', compact('pages', 'main_view', 'drafts', 'pagination', 'total'));
    }

    public function detail($id) {
        $draft = $this->draft->joinRelationMiddle('draft', 'draft_author')->joinRelationMiddle('draft', 'draft_reviewer')->joinRelationMiddle('draft', 'draft_layouter')->where('draft.draft_id', $id)->get('draft');

        if ($draft->draft_status >= 4) {
            $draft->draft_status_string = $this->checkStatus($draft->draft_status);
            $draft->draft_id = $id;
        } else {
            $draft = null;
        }

        // EDWARD :: Yang lu butuhin biar author sama reviewer gabisa ganti link cuma ini
        $role_table = "";
        $role_column = "";

        if ($this->level == "reviewer") {
            $role_table = 'draft_reviewer';
            $role_column = $draft->reviewer_id;
        }

        if ($this->level == "author") {
            $role_table = 'draft_author';
            $role_column = $draft->author_id;
        }

        if ($role_table != "") {
            if ($this->role_id != $role_column) {
                // redirect($this->index());
                redirect('draft');
            }
        }
        // EDWARD :: Sampai sini

        $pages    = $this->pages;
        $main_view  = $this->pages . '/' . $this->pages . '_detail';

        $this->load->view('template', compact('pages', 'main_view', 'draft'));
    }

    // EDWARD :: Ini fungsi yang buat case nya ganti
    public function endProgress($id, $status) {
        $this->draft->updateDraftStatus($id, array('draft_status' => $status + 1));

        // EDWARD :: tinggal tambahin ininya aja nanti
        switch ($status) {
            case '4':
                $column = 'review_end_date';
                break;
            
            default:
                # code...
                break;
        }

        $this->draft->editDraftDate($id, $column);

        $this->detail($id);
    }
    // EDWARD :: Sampai sini

    public function generateWorksheetNumber() {
        $date = date('Y-m');

        $this->db->limit(1);
        $query = $this->draft->like('worksheet_num', $date, 'after')
                             ->orderBy('draft_id', 'desc')
                             ->get('worksheet');

        if ($query) {
            $worksheet_num = $query->worksheet_num;
            $worksheet_num = explode("-", $worksheet_num);
            $num = (int) $worksheet_num[2];
            $num++;

            $num = str_pad($num, 2, '0', STR_PAD_LEFT);
        } else {
            $num = '01';
        }

        return $date . '-' . $num;
    }

    public function checkStatus($code) {
        $status = "";
        switch ($code) {
            case 0:
                $status = 'Waiting for Worksheet/Desk Screening';
                break;
            case 2:
                $status = 'Worksheet Rejected';
                break;
            case 1:
                $status = 'Choosing Reviewer';
                break;
            case 3:
                $status = 'Reviewer Rejected';
                break;
            case 4:
                $status = 'Review on Progress';
                break;
            case 5:
                $status = 'Choosing Editor';
                break;
            case 6:
                $status = 'Edit on Progress';
                break;
            case 7:
                $status = 'Choosing Layouter';
                break;
            case 8:
                $status = 'Layout on Progress';
                break;
            case 9:
                $status = 'Choosing Cover';
                break;
            case 10:
                $status = 'Cover on Progress';
                break;
            case 11:
                $status = 'Choosing Proofread';
                break;
            case 12:
                $status = 'Proofread on Progress';
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