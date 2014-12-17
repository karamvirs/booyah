<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Art_work extends CI_Model {

    function add_artwork($data) {
        $this->db->insert('art_work', $data);
        return $this->db->insert_id();
    }

    function all_art_work() {
        $this->db->select('*')->from('art_work');
        $this->db->order_by("artwork_id", "desc");
        $this->db->limit(10);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function edit_artwork_show_model($i) {
        $this->db->select('*')->from('art_work');
        $this->db->where('artwork_id', $i);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function all_artwork_of_mediatype($i) {
        $this->db->select('*');
        $this->db->like('media_id', $i);
        $query = $this->db->get('art_work');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }		
	function edit_artwork($data, $where) { 
		$result = $this->db->update("art_work", $data, $where);	
		return $result;   
	}	
	function delete_art_work($data, $where) {   
		$result = $this->db->update("art_work", $data, $where);	
		return $result;   
	}	
	
	function media_name($media_id) {
        $this->db->select('name');
        $this->db->from('media_type');
        $this->db->where('media_id', $media_id);
        $query = $this->db->get();
        // die();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}

?>