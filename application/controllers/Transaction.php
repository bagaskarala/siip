<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'transaction';
    }

	public function index($page = null)
	{
        $draft_layouter = null;

        $transactions = $this->transaction->join('draft')->getAll();

        $id = $this->user_id;

        if ($this->level === 'reviewer') {
            $id = $this->getIdRole('reviewer');
            $roleDraft = 'draft_reviewer';
            $role = $roleDraft;
        } elseif ($this->level === 'author') {
            $id = $this->getIdRole('author');
            $roleDraft = 'draft_author';
            $role = $roleDraft;
        } elseif ($this->level === 'admin_penerbitan' || $this->level === 'superadmin') {
            if ($transactions) {
                foreach ($transactions as $key) {
                    $draft_layouter = $this->transaction->where('user_id', $id)
                                                        ->get('draft_layouter');

                    if ($draft_layouter) {
                        $roleDraft = 'draft_layouter';
                        $role = 'user';
                    }
                }
            }
        }
        
        // For Data
        $this->transaction->joinRelationDest('draft', 'transaction');
        if ($this->level !== 'reviewer' && $this->level !== 'author') {
            $this->transaction->orWhere('draft.edit_user_id', $id)->orWhere('draft.proofread_user_id', $id);
        }
        if ($this->level === 'reviewer' || $this->level === 'author' || $draft_layouter) {
            $this->transaction->joinRelationMiddle('draft', $roleDraft)->orWhereRelation($roleDraft, $id, $role);
        } 
        $transactions = $this->transaction->paginate($page)->getAll('transaction');

        // For Total
        $this->transaction->joinRelationDest('draft', 'transaction');
        if ($this->level !== 'reviewer' && $this->level !== 'author') {
            $this->transaction->orWhere('draft.edit_user_id', $id)->orWhere('draft.proofread_user_id', $id);
        }
        if ($this->level === 'reviewer' || $this->level === 'author' || $draft_layouter) {
            $this->transaction->joinRelationMiddle('draft', $roleDraft)->orWhereRelation($roleDraft, $id, $role);
        } 
        $tot        = $this->transaction->getAll('transaction');
        $total     = count($tot);
        
        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
        $pagination = $this->transaction->makePagination(site_url($this->pages), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'transactions', 'pagination', 'total'));
	}
        
// -- add --        
        public function add()
	{
            
        if (!$_POST) {
            $input = (object) $this->transaction->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }
        
//        if (!empty($_FILES) && $_FILES['cover']['size'] > 0) {
//            $getextension=explode(".",$_FILES['cover']['name']);            
//            $coverFileName  = str_replace(" ","_",$input->transaction_title . '_' . date('YmdHis').".".$getextension[1]); // Cover name
//            $upload = $this->transaction->uploadCover('cover', $coverFileName);
//
//            if ($upload) {
//                $input->cover =  "$coverFileName"; // Data for column "cover".
//                $this->transaction->coverResize('cover', "./cover/$coverFileName", 100, 150);
//            }
//        }
        
        
        if (!empty($_FILES) && $_FILES['transaction_file']['size'] > 0) {
            $getextension=explode(".",$_FILES['transaction_file']['name']);            
            $transactionFileName  = str_replace(" ","_",$input->transaction_title . '_' . date('YmdHis').".".$getextension[1]); // Book file name
            $upload = $this->transaction->uploadBookfile('transaction_file', $transactionFileName);

            if ($upload) {
                $input->transaction_file =  "$transactionFileName"; // Data for column "transaction".
            }
        }
        
        
        if (!$this->transaction->validate() || $this->form_validation->error_array()) {
            $pages     = $this->pages;
            $main_view   = $this->pages . '/form_' . $this->pages;
            $form_action = $this->pages;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->transaction->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect($this->pages);
	}
 
        
// -- edit --         
        public function edit($id = null)
	{
            
        $transaction = $this->transaction->where('transaction_id', $id)->get();
        if (!$transaction) {
            $this->session->set_flashdata('warning', 'Book data were not available');
            redirect($this->pages);
        }

        if (!$_POST) {
            $input = (object) $transaction;
        } else {
            $input = (object) $this->input->post(null, true);
            $input->transaction_file = $transaction->transaction_file; // Set transaction file for preview.
            $input->cover = $transaction->cover; // Set cover untuk preview.
        }
        // Upload new transaction (if any)
        if (!empty($_FILES) && $_FILES['transaction_file']['size'] > 0) {            
            $getextension=explode(".",$_FILES['transaction_file']['name']);            
            $transactionFileName  = str_replace(" ","_",$input->transaction_title . '_' . date('YmdHis').".".$getextension[1]); // transaction file name
            $upload = $this->transaction->uploadBookfile('transaction_file', $transactionFileName);

            if ($upload) {
                $input->transaction_file =  "$transactionFileName";
                // Delete old transaction
                if ($transaction->transaction_file) {
                    $this->transaction->deleteBookfile($transaction->transaction_file);
                }
            }
        }   
        
        
        // If something wrong
        if (!$this->transaction->validate() || $this->form_validation->error_array()) {
            $pages    = $this->pages;
            $main_view   = $this->pages . '/form_' . $this->pages;
            $form_action = $this->pages. '/' . $id;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->transaction->where('transaction_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect($this->pages);
	}

// -- delete --         
        public function delete($id = null)
	{
	$transaction = $this->transaction->where('transaction_id', $id)->get();
        if (!$transaction) {
            $this->session->set_flashdata('warning', 'Book data were not available');
            redirect($this->pages);
        }

        if ($this->transaction->where('transaction_id', $id)->delete()) {
            // Delete transaction.
            $this->transaction->deleteBookfile($transaction->transaction_file);
            // Delete cover.
//            $this->transaction->deleteCover($transaction->cover);
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
        $transactions     = $this->transaction->like('transaction_code', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('transaction_title', $keywords)
                                  ->orLike('ISBN', $keywords)
                                  ->join('draft')
                                  ->orderBy('transaction_id')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('transaction_title')                
                                  ->orderBy('transaction_code')
                                  ->orderBy('ISBN')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->transaction->like('transaction_code', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('transaction_title', $keywords)
                                  ->orLike('ISBN', $keywords)
                                  ->join('draft')
                                  ->orderBy('transaction_id')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('transaction_title')                
                                  ->orderBy('transaction_code')
                                  ->orderBy('ISBN')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->transaction->makePagination(site_url('admin/transaction/search/'), 3, $total);

        if (!$transactions) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect($this->pages);
        }

        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
        $this->load->view('template', compact('pages', 'main_view', 'transactions', 'pagination', 'total'));
    }

    public function getIdRole($role) {
        return $this->transaction->getIdRoleFromUserId($this->user_id, $role);
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
}