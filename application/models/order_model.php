<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_model extends CI_Model {

    function insert_product_order($data) {
//print_r($data);die;
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }
    
    function update_after_paypal($insert_id , $data){
        $this->db->where('product_id', $insert_id);
        $this->db->update('products', $data);
        return true;
    }
    
    function all_orders() {
        $this->db->select('*')->from('products');
        $this->db->where('status', '1');
        $this->db->order_by('product_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    function user_orders($user_id) {
        $this->db->select('*')->from('products');
        //$this->db->where('status', '1');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('product_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
     function delete_order($order_id) {
        $order_data = array(
            'status' => '2'
        );//2 means deleted/
        $this->db->where('product_id', $order_id);
        $this->db->update('products', $order_data);
        return true;
    }
     function view_order($order_id) {
        $this->db->select('*')->from('products');
        $this->db->where('status', '1');
        $this->db->where('product_id', $order_id);
       
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    
    
}
?>