<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends MY_Model
{
   protected $perPage = 10;
   
       public function getValidationRules()
    {
        $validationRules = [
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            
        ];
    }
}