<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commonlibs {
	protected $CI;

	public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->database();
    }

    public function getIdAndName($table_dest, $table_from, $table_middle, $id_table_middle) {
    	return $this->CI->db->select($table_dest . '.' . $table_dest . '_id, ' . $table_dest . '.' . $table_dest . '_name')
    				 		->from($table_dest)
    				 		->join($table_from, $table_from . '.' . $table_dest . '_id = ' . $table_dest . '.' . $table_dest . '_id')
    				 		->where($table_from . '.' . $table_middle . '_id', $id_table_middle)
    				 		->get()
    				 		->result();
    }

    public function insertIntoDifferentTable($table_dest, $table_from, $table_middle, $data, $id_table_middle) {
        $data_input = array($table_from . '_id' => $data, $table_middle . '_id' => $id_table_middle);

        $this->CI->db->insert($table_dest, $data_input);

        if ($this->CI->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateIntoDifferentTable($table_dest, $table_from, $table_middle, $data, $id_table_middle, $id_table_from) {
        $pk_table_id = $this->getPKTableId($table_dest, $table_from, $table_middle, $id_table_from, $id_table_middle);

        if ($pk_table_id > 0) {
            $data_input = array($table_from . '_id' => $data);
            $this->CI->db->where($table_dest . '_id', $pk_table_id);
            $this->CI->db->update($table_dest, $data_input);
        } else {
            $this->insertIntoDifferentTable($table_dest, $table_from, $table_middle, $data, $id_table_middle);
        }

        if ($this->CI->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPKTableId($table_dest, $table_from, $table_middle, $id_table_from, $id_table_middle) {
        $data =  $this->CI->db->select($table_dest . '_id')
                              ->from($table_dest)
                              ->where($table_from . '_id = ' . $id_table_from)
                              ->where($table_middle . '_id = ' . $id_table_middle)
                              ->get()
                              ->result();

        if (count($data) > 0) {
            return $data[0]->draft_author_id;
        } else {
            return 0;
        }
    }

    public function deleteDifferentTable($table_dest, $table_from, $id_table_from) {
        $this->CI->db->where($table_from . '_id', $id_table_from)
                     ->delete($table_dest);
    }

    public function getData($table_dest, $table_from, $table_middle, $id) {
        return $this->CI->db->select('*')
                            ->from($table_from)
                            ->join($table_middle, $table_from . '.' . $table_from . '_id = ' . $table_middle . '.' . $table_from . '_id')
                            ->join($table_dest, $table_middle . '.' . $table_dest . '_id = ' . $table_dest . '.' . $table_dest . '_id')
                            ->where($table_from . '.' . $table_from . '_id', $id)
                            ->get()
                            ->result();
    }
}