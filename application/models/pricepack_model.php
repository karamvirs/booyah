<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pricepack_model extends CI_Model {

    function add_pricepack($data) {

        $this->db->insert('price_pack', $data);
        return $this->db->insert_id();
    }

    function all_pricepacks() {
        $this->db->select('*')->from('price_pack');
        $this->db->where('status', '0');
        $this->db->order_by('pricepack_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
 


    function edit_pricepack($pricepack_id) {
        $this->db->select('*');
        $this->db->from('price_pack');
        $this->db->where('pricepack_id', $pricepack_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function update_pricepack($price_data) {
        $pricepack_id = $price_data['pricepack_id'];

        $this->db->where('pricepack_id', $pricepack_id);
        $this->db->update('price_pack', $price_data);
        return true;
    }

    function delete_pricepack($pricepack_id) {
        $price_data = array(
            'status' => '1'
        );
        $this->db->where('pricepack_id', $pricepack_id);
        $this->db->update('price_pack', $price_data);
        return true;
    }

       
    function all_pricepacks_by_quantity() { // used on payment page order by quantity
        $this->db->select('*')->from('price_pack');
        $this->db->where('status', '0');
        $this->db->order_by('quantity', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false; 
        }
    }
    function getPricepackName($pricepack_id) {
        $this->db->select('pack_name');
        $this->db->from('price_pack');
        $this->db->where('pricepack_id', $pricepack_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}

?>
