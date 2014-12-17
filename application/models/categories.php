<?php if (!defined('BASEPATH')) exit('No direct script access allowed')

;class Categories extends CI_Model {

    function all_artwork_categories() {
        $this->db->select('*')->from('artwork_categories');
        $this->db->order_by("cat_id", "ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function all_deals_categories() {
        $this->db->select('*')->from('deals_categories');
        $this->db->order_by("cat_id", "ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function add_artwork_category($data) {
        $post_data = array('cat_name' => $data['cat_name'], 'status' => 1);
        return $this->db->insert($data['cat_type'], $post_data);
    }

    function cat_data($data) {
        $this->db->select('*');
        $this->db->from('artwork_categories');
        $this->db->where($data);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function deals_cat_data($data) {
        $this->db->select('*');
        $this->db->from('deals_categories');
        $this->db->where($data);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function update_artwork_category($data, $where) {
        $result = $this->db->update("artwork_categories", $data, $where);
        return $result;
    }

    function update_deals_category($data, $where) {
        $result = $this->db->update("deals_categories", $data, $where);
        return $result;
    }

    function delete_deals_category($data) {
        $result = $this->db->delete('deals_categories', array('cat_id' => $data));
        return $result;
    }

    function delete_artwork_category($data) {
        $result = $this->db->delete('artwork_categories', array('cat_id' => $data));
        return $result;
    }

} ?>