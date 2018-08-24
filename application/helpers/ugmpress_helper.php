<?php

// Get list of option for dropdown.
function getDropdownList($table, $columns)
{
    $CI =& get_instance();
    $query = $CI->db->select($columns)->from($table)->get();

    if ($query->num_rows() >= 1) {
        $options1 = ['' => '- Choose -'];
        $options2 = array_column($query->result_array(), $columns[1], $columns[0]);
        $options = $options1 + $options2;
        return $options;
    }

    return $options = ['' => '- Choose -'];
}


function getDropdownBankList($table, $columns)
{
    $CI =& get_instance();
    $query = $CI->db->select($columns)->from($table)->order_by("bank_name", "asc")->get();

    if ($query->num_rows() >= 1) {
        $options1 = ['' => '- Choose -'];
        $options2 = array_column($query->result_array(), $columns[1], $columns[0]);
        $options = $options1 + $options2;
        return $options;
    }

    return $options = ['' => '- Choose -'];
}



// Show form error validation message for "file" input.
function fileFormError($field, $prefix = '', $suffix = '')
{
    $CI =& get_instance();
    $error_field = $CI->form_validation->error_array();

    if (!empty($error_field[$field])) {
        return $prefix . $error_field[$field] . $suffix;
    }
    return '';
}

