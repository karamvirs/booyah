<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media_type extends CI_Model {

    function add_mediatype($data) {
        $this->db->insert('media_type', $data);
        return $this->db->insert_id();
    }

    function edit_mediatype_model($data, $data1) {
        $this->db->where('media_id', $data1['media_id']);
        $this->db->update('media_type', $data);
    }

    function edit_mediatype_show_model($i) {
        $this->db->select('*')->from('media_type');
        $this->db->where('media_id', $i);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function all_mediatype() {/*
        $this->db->select('*')->from('media_type');
        $this->db->order_by("media_id", "desc");
		$this->db->where('status', '1');
        $this->db->limit(10);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }*/
    }
	
	 function delete_mediatype($data) {
        $result = $this->db->delete('media_type', array('media_id' => $data));
        return $result;
    }
	
}
