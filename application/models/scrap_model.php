<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Scrap_model extends CI_Model {

  function allSubredditDataNew() {
        $this->db->select('*')->from('subreddits');//
        $this->db->order_by("id", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;  
        }
    } 
    function getSubredditStartNew($name){
		$this->db->select('last_post, url')->from('subreddits');
        $this->db->where("name", $name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
			return $query->row_array();
        } else {
            return false;
        }	
	}
	function twoDaysBackSearchNew($name) {
		
		$this->db->select('*')->from('reddit');
		$start 		= date('Y-m-d H:i:s');//today        
        $dend		= date("Y-m-d H:i:s",strtotime("-2 day", strtotime($start)));        
		$this->db->where("created_time BETWEEN '".$dend."' AND '".$start."'");
		$this->db->where("name", $name);
		$query = $this->db->get();
		//echo $this->db->last_query();//die;
        if ($query->num_rows() == 0) {
            return true;//$query->row_array();
        } else {
            return false;
        }
    }
    
    function redditInsertNew($data) {
		//print_r($data); die;
        $this->db->insert('reddit', $data);
        //echo $this->db->last_query();
        return true;
    }
    function updateSubredditNew($subtname, $data) {
		$this->db->where('name', $subtname);
		$this->db->update('subreddits', $data); 
		return true;       
    }
     function getNextPostUrlNew($name, $subreddit_id, $index) {
		//$q ="SELECT name FROM `reddit` where id = (select id from reddit where name = '".$name."' group by name )-1 ORDER BY `reddit`.`id` DESC";
		$q = "select id from reddit where subreddit_id = '".$subreddit_id."' ORDER BY id DESC";
		$query = $this->db->query($q);
		if ($query->num_rows() > 0) {
            $ids = $query->result_array();
          
            foreach($ids as $k=>$v){
				$ids[$k]=$v['id'];	
			}
			if(isset($ids[$index])){
				$q1 = "SELECT name FROM `reddit` where id= ".$ids[$index];
				$query = $this->db->query($q);
				if ($query->num_rows() > 0) {
					return $query->row_array();
				} 
			} else{
				return '';
				}
        } else {
            return '';
        }
    }
	  



}
