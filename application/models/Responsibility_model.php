<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Responsibility_model extends MY_Model
{
   protected $perPage = 10;
   
       public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'user_id',
                'label' => 'User ID',
                'rules' => 'trim|required'
            ],  
            [
                'field' => 'draft_id',
                'label' => 'Draft ID',
                'rules' => 'trim|required'
            ],
                                 
            
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            
            'user_id'              => '',
            'draft_id'           => ''
        ];
    }
}