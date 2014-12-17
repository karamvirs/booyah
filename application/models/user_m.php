<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class User_m extends CI_Model {

    function all_users() {
        $this->db->select('*')->from('users');
        $this->db->order_by("creation_date", "DESC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	function add_user($user_data) {
        $this->db->insert('users', $user_data);
        return $this->db->insert_id();
    }
	
	function update_user($data, $where) {
        $result = $this->db->update("users", $data, $where);
        return $result;
    }
	function update_permisssion($data, $role) { 
		$result = $this->db->update("roles", $data, $role);
        return true;
    }
	
	function get_user($data) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($data);
        $query = $this->db->get();
		if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }   
	function get_permisssion($role) {
        $this->db->select('*');
        $this->db->from('roles');
        $this->db->where('role', $role);
        $query = $this->db->get();
		if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }   

    function delete_user($data) {
        $result = $this->db->delete('users', array('id' => $data));
        return $result;
    }

} ?>
