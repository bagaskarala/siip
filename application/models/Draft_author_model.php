<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Draft_author_model extends MY_Model
{
   protected $perPage = 10;
   
       public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'draft_id',
                'label' => 'Draft ID',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'author_id',
                'label' => 'Author ID',
                'rules' => 'trim|required'
            ],                           
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            'draft_id'           => '',
            'author_id'              => ''
        ];
    }
}