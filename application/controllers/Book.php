<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->pages = 'book';
    }

	public function index($page = null)
	{
        $books     = $this->book->join('draft')->orderBy('draft.draft_id')->orderBy('book_id')->paginate($page)->getAll();
        $tot        = $this->book->join('draft')->orderBy('draft.draft_id')->orderBy('book_id')->getAll();
        $total     = count($tot);
        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
        $pagination = $this->book->makePagination(site_url($this->pages), 2, $total);

		$this->load->view('template', compact('pages', 'main_view', 'books', 'pagination', 'total'));
	}
        
// -- add --        
        public function add()
	{
            
        if (!$_POST) {
            $input = (object) $this->book->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }
        
//        if (!empty($_FILES) && $_FILES['cover']['size'] > 0) {
//            $getextension=explode(".",$_FILES['cover']['name']);            
//            $coverFileName  = str_replace(" ","_",$input->book_title . '_' . date('YmdHis').".".$getextension[1]); // Cover name
//            $upload = $this->book->uploadCover('cover', $coverFileName);
//
//            if ($upload) {
//                $input->cover =  "$coverFileName"; // Data for column "cover".
//                $this->book->coverResize('cover', "./cover/$coverFileName", 100, 150);
//            }
//        }
        
        
        if (!empty($_FILES) && $_FILES['book_file']['size'] > 0) {
            $getextension=explode(".",$_FILES['book_file']['name']);            
            $bookFileName  = str_replace(" ","_",$input->book_title . '_' . date('YmdHis').".".$getextension[1]); // Book file name
            $upload = $this->book->uploadBookfile('book_file', $bookFileName);

            if ($upload) {
                $input->book_file =  "$bookFileName"; // Data for column "book".
            }
        }
        
        
        if (!$this->book->validate() || $this->form_validation->error_array()) {
            $pages     = $this->pages;
            $main_view   = $this->pages . '/form_' . $this->pages;
            $form_action = $this->pages;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->book->insert($input)) {
            $this->session->set_flashdata('success', 'Data saved');
        } else {
            $this->session->set_flashdata('error', 'Data failed to save');
        }

        redirect($this->pages);
	}
 
        
// -- edit --         
        public function edit($id = null)
	{
            
        $book = $this->book->where('book_id', $id)->get();
        if (!$book) {
            $this->session->set_flashdata('warning', 'Book data were not available');
            redirect($this->pages);
        }

        if (!$_POST) {
            $input = (object) $book;
        } else {
            $input = (object) $this->input->post(null, true);
            $input->book_file = $book->book_file; // Set book file for preview.
            $input->cover = $book->cover; // Set cover untuk preview.
        }

//         //Upload new cover (if any)
//        if (!empty($_FILES) && $_FILES['cover']['size'] > 0) {
//            $getextension=explode(".",$_FILES['cover']['name']);            
//            $coverFileName  = str_replace(" ","_",$input->book_title . '_' . date('YmdHis').".".$getextension[1]); //cover file name
//            $upload = $this->book->uploadCover('cover', $coverFileName);
//            // Resize to 100x150px
//            if ($upload) {
//                $input->cover =  "$coverFileName";
//                $this->book->coverResize('cover', "./cover/$coverFileName", 100, 150);
//                // Delete old cover
//                if ($book->cover) {
//                    $this->book->deleteCover($book->cover);
//                }
//            }
//        }
        
        
        // Upload new book (if any)
        if (!empty($_FILES) && $_FILES['book_file']['size'] > 0) {            
            $getextension=explode(".",$_FILES['book_file']['name']);            
            $bookFileName  = str_replace(" ","_",$input->book_title . '_' . date('YmdHis').".".$getextension[1]); // book file name
            $upload = $this->book->uploadBookfile('book_file', $bookFileName);

            if ($upload) {
                $input->book_file =  "$bookFileName";
                // Delete old book
                if ($book->book_file) {
                    $this->book->deleteBookfile($book->book_file);
                }
            }
        }   
        
        
        // If something wrong
        if (!$this->book->validate() || $this->form_validation->error_array()) {
            $pages    = $this->pages;
            $main_view   = $this->pages . '/form_' . $this->pages;
            $form_action = $this->pages. '/' . $id;

            $this->load->view('template', compact('pages', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->book->where('book_id', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data updated');
        } else {
            $this->session->set_flashdata('error', 'Data failed to update');
        }

        redirect($this->pages);
	}

// -- delete --         
        public function delete($id = null)
	{
	$book = $this->book->where('book_id', $id)->get();
        if (!$book) {
            $this->session->set_flashdata('warning', 'Book data were not available');
            redirect($this->pages);
        }

        if ($this->book->where('book_id', $id)->delete()) {
            // Delete book.
            $this->book->deleteBookfile($book->book_file);
            // Delete cover.
//            $this->book->deleteCover($book->cover);
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
        $books     = $this->book->like('book_code', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('book_title', $keywords)
                                  ->orLike('ISBN', $keywords)
                                  ->join('draft')
                                  ->orderBy('book_id')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('book_title')                
                                  ->orderBy('book_code')
                                  ->orderBy('ISBN')
                                  ->paginate($page)
                                  ->getAll();
        $tot        = $this->book->like('book_code', $keywords)
                                  ->orLike('draft_title', $keywords)
                                  ->orLike('book_title', $keywords)
                                  ->orLike('ISBN', $keywords)
                                  ->join('draft')
                                  ->orderBy('book_id')
                                  ->orderBy('draft.draft_id')
                                  ->orderBy('book_title')                
                                  ->orderBy('book_code')
                                  ->orderBy('ISBN')
                                  ->getAll();
        $total = count($tot);

        $pagination = $this->book->makePagination(site_url('admin/book/search/'), 3, $total);

        if (!$books) {
            $this->session->set_flashdata('warning', 'Data were not found');
            redirect($this->pages);
        }

        $pages    = $this->pages;
        $main_view  = $this->pages . '/index_' . $this->pages;
        $this->load->view('template', compact('pages', 'main_view', 'books', 'pagination', 'total'));
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
    public function unique_book_title()
    {
        $book_title      = $this->input->post('book_title');
        $book_id = $this->input->post('book_id');

        $this->book->where('book_title', $book_title);
        !$book_id || $this->book->where('book_id !=', $book_id);
        $book = $this->book->get();

        if (count($book)) {
            $this->form_validation->set_message('unique_book_title', '%s has been used');
            return false;
        }
        return true;
    }
    
    public function unique_isbn()
    {
        $isbn      = $this->input->post('isbn');
        $book_id = $this->input->post('book_id');

        $this->book->where('isbn', $isbn);
        !$book_id || $this->book->where('book_id !=', $book_id);
        $book = $this->book->get();

        if (count($book)) {
            $this->form_validation->set_message('unique_isbn', '%s has been used');
            return false;
        }
        return true;
    }
    
    public function unique_serial_num()
    {
        $serial_num      = $this->input->post('serial_num');
        $book_id = $this->input->post('book_id');

        $this->book->where('serial_num', $serial_num);
        !$book_id || $this->book->where('book_id !=', $book_id);
        $book = $this->book->get();

        if (count($book)) {
            $this->form_validation->set_message('unique_serial_num', '%s has been used');
            return false;
        }
        return true;
    }
    
            public function is_date_format_valid($str)
    {
        if(!preg_match('/([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/', $str)) {
                //if(!preg_match('/(0[1-9]|1[0-9]|2[0-9]|3[01]-([0-9]{4})-(0[1-9]|1[012]))/', $str)) {    
            $this->form_validation->set_message('is_date_format_valid', 'Invalid date format (yyyy-mm-dd)');
            return FALSE;
        }

        return TRUE;
    }

}