<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages_model extends CI_Model {

   

    function all_pages() {
        $this->db->select('*')->from('pages');
        //$this->db->where('status', '1');
        $this->db->order_by('page_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }
    function edit_page($page_id) {
        $this->db->select('*');
        $this->db->from('pages');
        $this->db->where('page_id', $page_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    
    function update_page($page_data) {
        $page_id = $page_data['page_id'];
        $this->db->where('page_id', $page_id);
        return $this->db->update('pages', $page_data);
        
    }
    
    function delete_page($page_id) {
       return  $this->db->delete('pages', array('page_id' => $page_id)); 
        
    }
    
   
    function add_page($data) {

          $this->db->insert('pages', $data);
          return $this->db->insert_id();
      }
 
/*

    

    function update_pricepack($price_data) {
        $page_id = $price_data['page_id'];

        $this->db->where('page_id', $page_id);
        $this->db->update('pages', $price_data);
        return true;
    }

    function delete_pricepack($page_id) {
        $price_data = array(
            'status' => '1'
        );
        $this->db->where('page_id', $page_id);
        $this->db->update('pages', $price_data);
        return true;
    }

       
    function all_pricepacks_by_quantity() { // used on payment page order by quantity
        $this->db->select('*')->from('pages');
        $this->db->where('status', '0');
        $this->db->order_by('quantity', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false; 
        }
    }
    function getPricepackName($page_id) {
        $this->db->select('pack_name');
        $this->db->from('pages');
        $this->db->where('page_id', $page_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }*/
}

?>
