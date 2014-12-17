<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement_model extends CI_Model {	
	        function fetch_advertisement()
	        {
	        	 $this->db->select('*');
                 $this->db->from('advertisement');
                 $query = $this->db->get();		
                if ($query->num_rows() > 0) {
                   return $query->result_array();
               } else {	
                  return FALSE;
               }
	        }
			function add_advertisement($id,$data) {
				if($id=="")
				 {
			       $this->db->insert('advertisement', $data); 
			       return $this->db->insert_id();
			     }	
			     else
			     {
			     	$this->db->where('id', $id);
		            $this->db->update('advertisement', $data); 
		            return $id;
			     }	
	           }			   			
			function delete_advertisement($id) {
				if($id)
				 {
			       $this->db->where('id', $id); 
			       $this->db->delete('advertisement'); 			       
			       return true;
			     }	
			    
	           }			   			
	 
			function advertisement_detail($id) {
				 $this->db->select('*');
                 $this->db->from('advertisement');
                 $this->db->where('id', $id);
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
			
}
?>
