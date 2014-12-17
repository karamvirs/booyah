<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deals_model extends CI_Model {	
			function add_deals($data) {
			   $this->db->insert('deals', $data); 
			   return $this->db->insert_id();	
	           }			   			function all_deals() {
				$this->db->select('*')->from('deals');
				$this->db->order_by("deals_id", "desc");
				$query = $this -> db -> get();
				if($query->num_rows() > 0)		  
				{ 
				return $query->result_array();		
				}
				else
				{
				return false;
				}
			}   
		
			function edit_deals($i) {
				$this->db->select('*')->from('deals');
				$this->db->where('deals_id', $i);
				$query = $this -> db -> get();				if($query->num_rows() > 0)  
				{ 
				return $query->result_array();	
				}
				else
				{
				return false;
				}
			} 
			function view_deals($i) {
				$this->db->select('*')->from('categories');
				$this->db->order_by("category_id", "ASC");		
				$query = $this -> db -> get();
				if($query->num_rows() > 0)		  
				{ 				return $query->result_array();		
				}
				else
				{				return false;
				}
			} 
			function all_deals_of_mediatype($i) {
				$this->db->select('*');
				$this->db->like('media_id', $i);
				$query = $this -> db -> get('deals');
				if($query->num_rows() > 0)		  
				{ 
				return $query->result_array();	
				}
				else
				{
				return false;
				}
			} 
			function all_cats() {
				$this->db->select('*')->from('deals_categories');
				$query = $this -> db -> get();
				if($query->num_rows() > 0)
				{ 
				return $query->result_array();	
				}
				else
				{
				return false;
				}
			} 
			function edit_deal($data, $where) {
				$result = $this->db->update("deals", $data, $where);	
				return $result; 
			} 
}
?>