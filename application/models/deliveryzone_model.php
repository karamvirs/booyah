<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deliveryzone_model extends CI_Model {

    function add_deliveryzone($data) {

        $this->db->insert('delivery_zone', $data);
        return $this->db->insert_id();
    } 

    function all_deliveryzone() {
        $this->db->select('*')->from('delivery_zone');
        $this->db->where('status', '0');
        $this->db->order_by("delivery_zone_id", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function edit_deals($i) {
        $this->db->select('*')->from('deals');
        $this->db->where('deals_id', $i);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function view_deals($i) {
        $this->db->select('*')->from('categories');
        $this->db->order_by("category_id", "ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function all_deals_of_mediatype($i) {
        $this->db->select('*');
        $this->db->like('media_id', $i);
        $query = $this->db->get('deals');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function edit_zone($zone_id) {
        $this->db->select('*');
        $this->db->from('delivery_zone');
        $this->db->where('delivery_zone_id', $zone_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function updat_zone($zone_data) {

        $this->db->where('delivery_zone_id', $zone_data['delivery_zone_id']);
        $this->db->update('delivery_zone', $zone_data);
        return true;
    }

    function delete_zone($zone_id) {
        $zone_data = array(
            'status' => '1'
        );
        $this->db->where('delivery_zone_id', $zone_id);
        $this->db->update('delivery_zone', $zone_data);
        return true;
    }
    
     function getZonebyId($data) {
        $this->db->select('*')->from('delivery_zone');
        $this->db->where('status', '0');//0 for active
        $this->db->where_in('delivery_zone_id', $data);
        
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
     function getZoneNamebyId($data) { 
        $this->db->select('location_name')->from('delivery_zone');
        $this->db->where('status', '0');//0 for active
        $this->db->where_in('delivery_zone_id', $data);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

}

?>
