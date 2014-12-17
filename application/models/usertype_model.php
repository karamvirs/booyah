<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Usertype_model extends CI_Model {

   
    function getUserTypeInfo($user_id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $user_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    function getUserGif($user_id) {
        $this->db->select('*');
        $this->db->from('users_gif');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();     
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else { 
			return FALSE;
		}
    }
    function insertUserGif($data) {
       $this->db->insert('users_gif', $data);
        return true;//$this->db->insert_id();
    }
    function deleteUserGif($gifid) {
		$this->db->delete('users_gif', array('id' => $gifid));        
        return true;//$this->db->insert_id();
    }
    
    /*******************************************/
    
    function insertTags($data) {
       $this->db->insert('tags', $data);
        return $this->db->insert_id();
    }
    function insertUserTag($data) {
       $this->db->insert('user_tags', $data);
        return $this->db->insert_id();
    }
    function getTag($tagname) {
		$this->db->select('tag_id')->from('tags');
		$this->db->where('tag_name', $tagname);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row_array();//$this->db->insert_id();
		} else {
			return false;
		}
    }
    

   
}
