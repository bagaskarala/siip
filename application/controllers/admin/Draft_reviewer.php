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
        // $drafts     = $this->draft_reviewer->join('draft')->join('reviewer')->orderBy('draft.draft_id')->orderBy('reviewer.reviewer_id')->orderBy('draft_reviewer_id')->paginate($page)->getAll();
        // $tot        = $this->draft_reviewer->join('draft')->join('reviewer')->orderBy('draft.draft_id')->orderBy('reviewer.reviewer_id')->orderBy('draft_reviewer_id')->getAll();

        $drafts     = $this->draft_reviewer->where('status', 1)->orderBy('draft.draft_id', 'DESC')->paginate($page)->getAll('draft');
        $tot        = $this->draft_reviewer->where('status', 1)->orderBy('draft.draft_id', 'DESC')->paginate($page)->getAll('draft');

        foreach ($drafts as $key => $value) {
            $reviewers = $this->draft_reviewer->select('reviewer_nip')->getIdAndName('reviewer', 'draft_reviewer', $value->draft_id, 'draft');
            $value->draft_reviewers = $reviewers;
        }

        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = $this->role . '/'. $this->pages . '/index_' . $this->pages;
        $pagination = $this->draft_reviewer->makePagination(site_url($this->role . '/' . $this->pages), 3, $total);

		$this->load->view('template', compact('pages', 'main_view', 'drafts', 'pagination', 'total'));
	}
        
// -- add --        
        public function add()
	{
            $act = 'add';
            
        if (!$_POST) {
            $input = (object) $this->draft_reviewer->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->draft_reviewer->validate()) {
            $pages     = $this->pages;
            $main_view   = $this->role . '/' . $this->pages . '/form_' . $this->pages . '_' . $act;
            $form_action = $this->role . '/' . $this->pages . '/' . $act;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }
        
//        unset($input->search_reviewer);

        if ($this->draft_reviewer->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect($this->role . '/' . $this->pages);
	}


// -- edit --        
        public function edit($id = null)
	{
            $act = 'edit';
            
        $data = array('draft_id' => $id);
        $draft = $this->draft_reviewer->getWhere($data, 'draft');

        $reviewers = $this->draft_reviewer->getIdAndName('reviewer', 'draft_reviewer', $draft->draft_id, 'draft');
        $reviewers_id = array();

        foreach ($reviewers as $key => $value) {
            $reviewers_id[$key] = $value->reviewer_id;
        }

        $draft->reviewer_id =  $reviewers_id;

        if (!$_POST) {
            $input = (object) $draft;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->draft_reviewer->validate()) {
            $pages    = $this->pages;
            $main_view   = $this->role . '/' . $this->pages . '/form_' . $this->pages . '_' . $act;
            $form_action = $this->role . '/' . $this->pages . '/' . $act . '/' . $id;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }
        
        
        unset($input->search_reviewer);

        $isSuccess = true;

        foreach ($input->reviewer_id as $key => $value) {
            if (isset($draft->reviewer_id[$key])) {
                $draft_reviewer_id = $this->draft_reviewer->getPKTableId('reviewer', 'draft', 'draft_reviewer', $draft->reviewer_id[$key], $id);

                if ($draft_reviewer_id > 0) {
                    $isSuccess = true;
                    $data_input = array('reviewer_id' => $value, 'status' => 0);

                    $this->draft_reviewer->where('draft_reviewer_id', $draft_reviewer_id)
                                         ->update($data_input, 'draft_reviewer');
                } else {
                    $isSuccess = false;
                    break;
                }
            } else {
                $data_reviewer = array('reviewer_id' => $value, 'draft_id' => $id);

                $draft_reviewer_id = $this->draft_reviewer->insert($data_reviewer, 'draft_reviewer');

                if ($draft_reviewer_id < 1) {
                    $isSuccess = false;
                    break;
                }
            }
        }

        if ($isSuccess) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect($this->role . '/' . $this->pages);
	}
        
// -- delete --        
        public function delete($id = null)
	{
	$draft_reviewer = $this->draft_reviewer->where('draft_reviewer_id', $id)->get();
        if (!$draft_reviewer) {
            $this->session->set_flashdata('warning', 'Draft Reviewer data were not available');
            redirect($this->role . '/' . $this->pages);
        }

        if ($this->draft_reviewer->where('draft_reviewer_id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data deleted');
		} else {
            $this->session->set_flashdata('error', 'Data failed to delete');
        }

		redirect($this->role . '/' . $this->pages);
	}

////-- auto complete --        
//    public function reviewer_auto_complete()
//    {
//        $key = $this->input->post('key');
//        $reviewers = $this->draft_reviewer->liveSearchReviewer($key);
//
//        foreach ($reviewers as $reviewer) {
//            // Put in bold the written text.
//            $reviewer_nip        = str_replace($key, '<strong>'.$key.'</strong>', $reviewer->reviewer_nip );
//            $reviewer_name = preg_replace("#($key)#i", "<strong>$1</strong>", $reviewer->reviewer_name);
//
//            // Add new option.
//            $str  = '<li onclick="setItemReviewer(\''.$reviewer->reviewer_name.'\'); makeHiddenIdReviewer(\''.$reviewer->reviewer_id.'\')">';
//            $str .= "$reviewer_nip - $reviewer_name";
//            $str .= "</li>";
//
//            echo $str;
//        }
//    }

// -- search --
        public function search($page = null)
        {
        $keywords   = $this->input->get('keywords', true);
        $drafts     = $this->draft_reviewer->like('draft_reviewer_id', $keywords)
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
        $tot        = $this->draft_reviewer->like('draft_reviewer_id', $keywords)
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

        $pagination = $this->draft_reviewer->makePagination(site_url('admin/draft_reviewer/search/'), 3, $total);

        if (!$drafts) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect($this->role . '/' . $this->pages);
        }

        $pages    = $this->pages;
        $main_view  = $this->role . '/'. $this->pages . '/index_' . $this->pages;
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
    public function unique_draft_reviewer_match()
    {
        // $reviewer_id      = $this->input->post('reviewer_id');
        // $draft_id      = $this->input->post('draft_id');
        // $draft_reviewer_id = $this->input->post('draft_reviewer_id');

        // $this->draft_reviewer->where('reviewer_id', $reviewer_id);
        // $this->draft_reviewer->where('draft_id', $draft_id);
        // !$draft_reviewer_id || $this->draft_reviewer->where('draft_reviewer_id !=', $draft_reviewer_id);
        // $draft_reviewer = $this->draft_reviewer->get();

        // if (count($draft_reviewer)) {
        //     $this->form_validation->set_message('unique_draft_reviewer_match', 'Both of %s has been used');
        //     return false;
        // }
        return true;
    }



}