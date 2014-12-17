<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_model extends CI_Model {

    
    
    function getUsernameById($id){
        $this->db->select('username')->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    function getUserdataById($id){
        $this->db->select('*')->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    function getUserIdByUsername($username){
        $this->db->select('id')->from('users');
        $this->db->where('username', $username);
        $query = $this->db->get();
        //echo $this->db->last_query();die("sss");
        if ($query->num_rows() > 0) {
            return $query->row_array(); 
        } else {
            return false;
        }
    }
    function getUserEmailByEmail($email){
        $this->db->select('email')->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    function getUserAllDataById($user_id){
        $this->db->select('id,email,session_token,username,dtype,is_logged_in')->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        //echo $this->db->last_query();die("sss");
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    } 
    /****************TAGs*********************/ 
    function insertTags($data) {
       $this->db->insert('tags', $data);
        return $this->db->insert_id();
    }

    function insertUserTag($data) {
       $this->db->insert('user_tags', $data);
        return $this->db->insert_id();
    }
    function getTag($tagname) {
		$this->db->select('tag_id')->from('tags');
		$this->db->like('tag_name', $tagname);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row_array();//$this->db->insert_id();
		} else {
			return false; 
		}
    } 
    function insertUserGif($data) {
       $this->db->insert('users_gif', $data);
        return $this->db->insert_id();
    } 
    
    function getUserIdsByTagId($tagid) {
		$this->db->distinct();
		$this->db->select('*')->from('user_tags');
		$this->db->where('tag_id', $tagid);
		$this->db->group_by('user_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}
    } 
     function getGifsByUser_TagId($tagid, $user_id) {
		$this->db->select('*')->from('users_gif');
		$this->db->where("FIND_IN_SET('".$tagid."',tag_id) !=", 0);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}
    } 
    /*****************************************/
    function FollowFollowing($tofollow, $loggeduser){
		$this->db->select('*')->from('usernetwork');
		$this->db->where('user_id', $loggeduser);
		$this->db->where('network_id', $tofollow);
		$this->db->where('networkstatus', '1');
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->row_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
	
	 function insertFollower($data) {
       $this->db->insert('usernetwork', $data);
       return $this->db->insert_id();
    }
	 function deleteFollower($tofollow, $loggeduser){
		$this->db->where('user_id', $loggeduser);
		$this->db->where('network_id', $tofollow);
		$this->db->delete('usernetwork'); 
		return true;
    }
    
    /*************** USER PROFILE**************************/

	function getUserGifsCount($user_id){
		$this->db->select('count(*) as postcount')->from('users_gif');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->row_array();//$this->db->insert_id();
		} else {
			return false; 
		}	 
	}
	
	function userFollowCount($user_id){
		$this->db->select('count(*) as followers')->from('usernetwork');
		$this->db->where('user_id', $user_id);
		$this->db->where('networkstatus', '1');// 1 means followers
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->row_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
	/*
	// user follow count
	*/
	function userFollowingCount($user_id){
		$this->db->select('count(*) as following')->from('usernetwork');
		$this->db->where('user_id', $user_id);
		$this->db->where('networkstatus', '2');// 1 means followers
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->row_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
    
    
    
	function userFollowData($user_id){
		$this->db->select('*')->from('usernetwork');
		$this->db->where('user_id', $user_id);
		$this->db->where('networkstatus', '1');// 1 means followers
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
	function userFollowingData($user_id){
		$this->db->select('*')->from('usernetwork');
		$this->db->where('user_id', $user_id);
		$this->db->where('networkstatus', '2');// 2 means following
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
	function otherUserFollowData($other_user){
		$this->db->select('*')->from('usernetwork');
		$this->db->where('user_id', $other_user);
		$this->db->where('networkstatus', '1');// 2 means following
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
	function loggedUserFollowData($user_id){
		$this->db->select('*')->from('usernetwork');
		$this->db->where('user_id', $user_id);
		$this->db->where('networkstatus', '1');// 2 means following
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
	
	function otherUserFollowingData($other_user){
		$this->db->select('*')->from('usernetwork');
		$this->db->where('user_id', $other_user);
		$this->db->where('networkstatus', '2');// 2 means following
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
	function loggedUserFollowingData($user_id){
		$this->db->select('*')->from('usernetwork');
		$this->db->where('user_id', $user_id);
		$this->db->where('networkstatus', '2');// 2 means following
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
    
    
    function updateUserImage($user_id, $fileurl) {
        $image_data = array(
            'profile_pic' => $fileurl
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $image_data);
        return true;
    }
    
    function userFollowingComments($user_id){
		$this->db->distinct();
		$this->db->select('reddit_id, post_id')->from('appcomments');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	}
	
	function getUsergifsDataById($pid){
		$this->db->select('*')->from('users_gif');
		$this->db->where('id', $pid);
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->row_array();//$this->db->insert_id();
		} else {
			return false; 
		} 
	}
	function getRdditgifsDataById($reddit_id){
		$this->db->select('name,id, url, title, score, webmUrl, gifUrl, mp4url, gfyname, created_time')->from('reddit');
		$this->db->where('name', $reddit_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->row_array();//$this->db->insert_id();
		} else {
			return false; 
		} 
	}
	
	function userFollowingPosts($user_id){
		$this->db->select('*')->from('users_gif');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	 
	}

    function userFollowingLikes($user_id){
		$this->db->distinct();
		$this->db->select('reddit_id, post_id')->from('userpostlike');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();//$this->db->insert_id();
		} else {
			return false; 
		}	
	} 
    
    function userFollowingFeed($userids){
		
		$start 		= date('Y-m-d H:i:s');//today        
        $dend		= date("Y-m-d H:i:s",strtotime("-2 day", strtotime($start)));        
        $this->db->distinct();
		$this->db->select('*')->from('activity');
		$this->db->where_in('user_id', $userids);
		$this->db->where("created BETWEEN '".$dend."' AND '".$start."'");
		$this->db->group_by('post_id'); 
		$this->db->order_by("created", "DESC");
		$query = $this->db->get();
		//echo $this->db->last_query();die("sss");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false; 
		}	 
	}
	
	    function getRedditPosts(){
		
		$start 		= date('Y-m-d H:i:s');//today        
        $dend		= date("Y-m-d H:i:s",strtotime("-1 day", strtotime($start)));        
        $this->db->select('*')->from('reddit');
		$this->db->where("created_time BETWEEN '".$dend."' AND '".$start."'");
		$this->db->order_by("created_time", "DESC");
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false; 
		}	 
	}
	
	function updateUserTrending($user_id, $device_id, $posts) {
        $data = array(
            'posts' => $posts,
            'device_id' =>$device_id
        );
        $this->db->where('user_id', $user_id); 
        $this->db->update('usertrending', $data);
        return true;
    }
	
    /*****************************************/
    
    	/*	 
	}*/
	
 /*
    function getPostFieldsById($pid){
        $this->db->select('title, score, webmUrl, gifUrl, mp4Url')->from('reddit');
        $this->db->where('id', $pid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    function getCommentsByPid($pid){
        $this->db->select('user_id, comment')->from('appcomments');
        $this->db->where('post_id', $pid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
//$pid	= $this->app_model->getCommentsByPid($pid);


 



    

*/
}

?>
