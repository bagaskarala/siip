<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Responsibility_model extends MY_Model
{
   protected $perPage = 10;
   
       public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'responsibility_id',
                'label' => 'Responsibility ID',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'user_id',
                'label' => 'User ID',
                'rules' => 'trim|required'
            ],                       
            
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            'draft_id'           => '',
            'user_id'              => ''
        ];
    }
}