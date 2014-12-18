<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reddit_model extends CI_Model {

    function redditInsert($data) {
        $this->db->insert('reddit', $data);
        //echo $this->db->last_query();
        return true;
    }
    
    function subredditInsert($data) {
        $this->db->insert('subreddits', $data);
        return true;//$this->db->insert_id();
    }
    function emptyReddit($table) {
        $this->db->truncate($table); 
        return true;
    }
    function allData($per_page='', $offset='') { //echo "offset=".$offset;die;
        $this->db->select('*')->from('reddit');// this is for original table reddit but changed to reddit_old
        $this->db->order_by("id", "DESC");
        $this->db->limit($per_page, $offset);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function countAllData() {
		return $this->db->count_all_results('reddit');
    }
    function allSubredditData() {
        $this->db->select('*')->from('subreddits');
        $this->db->order_by("id", "DESC");
        //$this->db->limit(200);
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getNameToStartOld() {
        $this->db->select('name,url')->from('reddit');
        $this->db->where("flags", '1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
			return $query->row_array();
        } else {
            return false;
        }
    }
    function getTagToStartOld() {
        $this->db->select('name')->from('subreddits');
        $this->db->where("flags", '1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
			return $query->row_array();
        } else {
            return false;
        }
    }
    function getNameToStartNew() {
        $this->db->select('name')->from('reddit');
        $this->db->where("flags", '2');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
			return $query->row_array();
        } else {
            return false;
        }
    }
    function resetNameToStart($tname) {
		$data = array(               
            'flags' => '0'               
        );
        $this->db->where('name', $tname);
		$this->db->update('reddit', $data); 
		return true;       
    }
    
    function deleteRecordToStart($tname) {//echo $tname;die;
		$this->db->delete('reddit', array('name' => $tname)); 
		//echo $this->db->last_query();die;
		return true;       
    }
    
/****************************************subreddit function start*********************************************/
    function getSubredditStart($name){
		$this->db->select('last_post, url')->from('subreddits_test');
        $this->db->where("name", $name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
			return $query->row_array();
        } else {
            return false;
        }	
	}
	    
    function redditInsertTest($data) {
        $this->db->insert('reddit_test', $data);
        //echo $this->db->last_query();
        return true;
    }
    function updateSubredditTest($subtname, $data) {
		$this->db->where('name', $subtname);
		$this->db->update('subreddits_test', $data); 
		return true;       
    }
    
    function allSubredditDataTest() {
        $this->db->select('*')->from('subreddits_test');
        $this->db->order_by("id", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getLastPostUrl($last_post) {
        $this->db->select('name,url')->from('reddit');
        $this->db->where("name", $last_post);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
			return $query->row_array();
        } else {
            return false;
        }
    }
     function delNonGif($tname) {//echo $tname;die;//DELETE RECORD from reddit table cause it was a NON-GIF post
		$this->db->delete('reddit_test', array('name' => $tname)); 
		//echo $this->db->last_query();die;
		return true;       
    }
    
/******************************************subreddit end*************************************************/
/******************************************scrapping functions start*************************************************/

	function redditInsertOld($data) {
        $this->db->insert('reddit_old', $data);
        //echo $this->db->last_query();
        return true;
    }
	function twoDaysBack() {
        $this->db->select('*')->from('reddit');
		$start 		= date('Y-m-d H:i:s');//today        
        $dend		= date("Y-m-d H:i:s",strtotime("-2 day", strtotime($start)));        
		$this->db->where("created_time BETWEEN '".$dend."' AND '".$start."'");
		$this->db->order_by("created", "asc");
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function twoDaysBackSearch($name) {
		
		$this->db->select('*')->from('reddit_test');
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

    function getNextPostUrl($name) {
		$q ="SELECT name FROM `reddit_test` where id = (select id from reddit_test where name = '".$name."' group by name )-1 ORDER BY `reddit_test`.`id` DESC";
		$query = $this->db->query($q);
		if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }


	function updatescore($name, $score) {
		$data = array(
               'score' => $score
            );
		$this->db->where('name', $name);
		$this->db->update('reddit', $data); 		
    }
    
 
/*
 * 			
 * */



/******************************************scrapping functions end*************************************************/
	





}
