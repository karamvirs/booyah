<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model {
	
	function commentThreadInsert($data) {
		$this->db->insert('admin_comments_gifs', $data);
		return true;
	}

	function fetch_comments()
	{
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$this->db->from('admin_comments');
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
		   return $query->result_array();
		} else {	
		  return FALSE;
		}
	}
	function addComment($id, $data) {
		if($id=="")
		 {
		   $this->db->insert('admin_comments', $data); 
		   return $this->db->insert_id();
		 }	
		 else
		 {
			$this->db->where('id', $id);
			$this->db->update('admin_comments', $data); 
			return $id;
		 }	
	   }			   			
	function deleteComment($id) {
		if($id)
		 {
		   $this->db->where('id', $id); 
		   $this->db->delete('admin_comments'); 			       
		   return true;
		 }	
		
	   }			   			
	function deleteCommentGifs($id) {
		if($id)
		 {
		   $this->db->where('lpost_id', $id); 
		   $this->db->delete('admin_comments_gifs'); 			       
		   return true;
		 }	
		
	   }			   			

	function comment_detail($id) { //echo $id;die;
		 $this->db->select('*');
		 $this->db->from('admin_comments');
		 $this->db->where('id', $id);
		$query = $this -> db -> get();
		if($query->num_rows() > 0)		  
		{ 				
			return $query->row_array();		
		}
		else
		{				
			return false;
		}
	} 
	function viewComment($id) { //echo $id;die;
		 $this->db->select('*');
		 $this->db->from('admin_comments_gifs');
		 $this->db->where('lpost_id', $id);
		$query = $this -> db -> get();
		if($query->num_rows() > 0)		  
		{ 				
			return $query->result();		
		}
		else
		{				
			return false;
		}
	} 
			
}
?>
