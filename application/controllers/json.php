<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Json extends CI_Controller {
	
	
    function __construct() {
#        ini_set('display_errors', 1);
#        error_reporting(E_ALL);

        parent::__construct();
		
       /*echo "<pre>";
       print_r($_REQUEST);
       print_r($_FILES);
       echo "</pre>";
       die;*/
		$this->load->database();
		$this->load->model('app_model');
        error_reporting(E_ERROR | E_PARSE);
        $this->get_request($_REQUEST);
    }
   
    /* Get And Process Request */
    
    protected function get_request($data) {
        $a = $data['a']; 
        if (!empty($a) && strpos($a, 'Action') != false) { 
            $action = str_replace('Action', '', $a);
            if (method_exists($this, $action)) {
                call_user_func(array($this, $action), (object) $data);
            }
        } else {
            $this->falseResponse("Given action is invalid");
        }
    }

    /* Function to return Request */

    protected function returnRequest($success = null, $msg = null, $data = null, $encode = false) {
        $array = array(
            "success" => $success,
            "message" => $msg,
            "data" => $data
        );
        if ($encode == true) {
            echo str_replace("\\\\\\\\", "\\", json_encode($array));
        } else {
            echo json_encode($array, JSON_FORCE_OBJECT);
        }
        die;
    }

    /* make false response */

    protected function falseResponse($msg, $data='') {
        $success = '0';
        //$data = array();
        $this->returnRequest($success, $msg, $data);
    }

    /* make false response */

    protected function trueResponse($data, $msg = 'success', $encode = false) {
        $success = '1';
        $this->returnRequest($success, $msg, $data, $encode);
    }

	/* user sign up saveDataAction  */

    protected function saveData($data) {
		$msg = '';
		$dtype = $data->dtype;
		$token = md5(time()); 
		if($dtype=='email'){
			$email 		= $data->email;
			$password 	= $data->password;
			$username 	= $data->username;
			$user_id	= $this->app_model->getUserIdByUsername($username);
			if($user_id) {
				$this->falseResponse("Username already exists.");
				
			}
			$user_email	= $this->app_model->getUserEmailByEmail($email);
			if($user_email) {
				$this->falseResponse("Email already exists.");
			} else {
				$data = array(
					'email' 		=> $email,
					'password' 		=> md5($password),
					'username' 		=> $username, 
					'fb_tw_id'		=> '',
					'creation_date' => date('Y-m-d H:i:s'),
					'session_token' => $token,
					'dtype' 		=> $dtype,
					'is_logged_in' 	=> '1',
					'user_from' 	=> 'app'
				);
				$result = $this->db->insert('users', $data);
				$last_inserted_id = $this->db->insert_id();
				
				
				if(!empty($last_inserted_id)) { 
					$userData	= $this->app_model->getUserAllDataById($last_inserted_id);
					if($userData) {
						$id 			= $userData['id'];
						$email 			= $userData['email'];
						$fb_tw_id		= '';
						$session_token 	= $userData['session_token'];
						$username 		= $userData['username'];
						$dtype 			= $userData['dtype'];
						$is_logged_in 	= $userData['is_logged_in'];
						$data1			= array('user_id' => $id, 'session_token' => $session_token, 'username' => $username, 'dtype' => $dtype, 'is_logged_in' => $is_logged_in, 'fb_tw_id' => $fb_tw_id, 'email' => $email);
						$this->trueResponse($data1,'success'); 
						
					}
				} else {
					$this->falseResponse("No response");
				}
			}
		}
		if($dtype=='fb' || $dtype=='tw'){ die('you are here');
			$fb_tw_id 	= $data->fb_tw_id;//check
			$username 	= $data->username;
			$sql 		= "select id as user_id from users where fb_tw_id='$fb_tw_id' AND dtype='$dtype'";
			$query 		= $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$userData 		= $query->_fetch_object();
				$this->falseResponse("User Already exists", $userData);
			} else {
				$data = array(
					'email' 		=> '',
					'password'		=> '',
					'username' 		=> $username, 
					'fb_tw_id'		=> $fb_tw_id, 
					'creation_date'	=> date('Y-m-d H:i:s'),
					'session_token' => $token,
					'dtype' 		=> $dtype,
					'is_logged_in' 	=> '1',
					'user_from' 	=> 'app'
				);
				$result				= $this->db->insert('users', $data);
				$last_inserted_id 	= $this->db->insert_id();
				if(!empty($last_inserted_id)) {
					$sql = "select * from users where id='$last_inserted_id'";
					$query = $this->db->query($sql);
					if ($query->num_rows() > 0) {
						$userData 		= $query->_fetch_object();
						$id 			= $userData->id;
						$fb_tw_id 		= $userData->fb_tw_id;
						$email 			= '';//$userData->email;
						$session_token 	= $userData->session_token;
						$username 		= $userData->username;
						$dtype 			= $userData->dtype;
						$is_logged_in 	= $userData->is_logged_in;
						$data1			= array('user_id' => $id, 'session_token' => $session_token, 'username' => $username, 'dtype' => $dtype, 'is_logged_in' => $is_logged_in, 'fb_tw_id' => $fb_tw_id, 'email' => $email);
						$this->trueResponse($data1,'success'); 
					}
				} else {
					$this->falseResponse("No response");
					
				}
			}
			
		}
	}

    /* Function Login Action */

	protected function login($data) {
	
		$dtype = $data->dtype;
		$token = md5(time()); //$data->token;	
		if($dtype=='email'){
			if (!empty($data->username) ) {	
				$username 	= $data->username;
				$pass 		= md5($data->password);
				$sql 		= "SELECT * FROM users WHERE ( email = '{$username}')  AND password = '{$pass}'";
				$query 		= $this->db->query($sql);
				
				if ($query->num_rows() > 0) {
					$userData 		= $query->_fetch_object();					
					$sql 			= "UPDATE users SET session_token = '{$token}', dtype='{$dtype}',is_logged_in = 1 WHERE id = $userData->id";
					if ($this->db->query($sql)) {
						$userid 		= $userData->id;
						$username 		= $userData->username;
						$email 			= $userData->email;
						$is_logged_in 	= $userData->is_logged_in;
						$fb_tw_id 		= '';//$userData->fb_tw_id;
						$data1 			= array('user_id' => $userid, 'username' => $username, 'session_token' => "$token", 'dtype' => "$dtype", 'email' => "$email", 'is_logged_in' => $is_logged_in, 'fb_tw_id' => $fb_tw_id,);
						$this->trueResponse($data1);
					}					
				} else {
					$sql1 		= "SELECT * FROM users WHERE ( username = '{$username}')  AND password = '{$pass}'";
					$query1 		= $this->db->query($sql1);
					if ($query1->num_rows() > 0) {
						$userData 		= $query1->_fetch_object();					
						$sql 			= "UPDATE users SET session_token = '{$token}', dtype='{$dtype}',is_logged_in = 1 WHERE id = $userData->id";
						if ($this->db->query($sql)) {
							$userid 		= $userData->id;
							$username 		= $userData->username;
							$email 			= $userData->email;
							$is_logged_in 	= $userData->is_logged_in;
							$fb_tw_id 		= '';//$userData->fb_tw_id;
							$data1 			= array('user_id' => $userid, 'username' => $username, 'session_token' => "$token", 'dtype' => "$dtype", 'email' => "$email", 'is_logged_in' => $is_logged_in, 'fb_tw_id' => $fb_tw_id,);
							$this->trueResponse($data1);
						}
					} else {
						$this->falseResponse("You have entered wrong credentials");
					}
				}					
			} 
		} 
		if($dtype=='fb' || $dtype=='tw'){	
			$fb_tw_id 	= $data->fb_tw_id;
			$sql 			= "SELECT * FROM users WHERE ( fb_tw_id = '{$fb_tw_id}') AND dtype= $dtype";
			$query 			= $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$userData = $query->_fetch_object();
				$sql = "UPDATE users SET session_token = '{$token}', dtype='{$dtype}',is_logged_in = 1 WHERE id = $userData->id";
				if ($this->db->query($sql)) {
					$userid 		= $userData->id;
					$username 		= $userData->username;
					$email 			= '';
					$is_logged_in 	= $userData->is_logged_in;
					$fb_tw_id 		= $userData->fb_tw_id;
					$data1 		= array('user_id' => $userid, 'username' => $username, 'session_token' => "$token", 'dtype' => "$dtype", 'email' => "$email", 'is_logged_in' => $is_logged_in, 'fb_tw_id' => $fb_tw_id,);
					$this->trueResponse($data1);
				}
			} else {
				$this->falseResponse("You have entered wrong credentials");
			}
				
		}
			
	} 

    /* Log out function */

    protected function logOut($data) {
        $this->load->database();
        $session_token = $data->session_token;
        $sql = "UPDATE app_users SET session_token='', is_logged_in = 0 WHERE session_token = '$session_token' ";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $this->trueResponse("You has been successfully logged out");
        } else {
            $this->falseResponse("Invalid login session token");
        }
    }

    /* Forget password function */

    public function forgotUser($data) {
        $this->load->database();
        $email = $data->email;
        $sql = "select * from app_users where email='$email'";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $userData = $query->_fetch_object();
            $seed = str_split('abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . '0123456789!@#$%^&*()'); // and any other characters
            shuffle($seed);
            $rand = '';
            foreach (array_rand($seed, 5) as $k)
                $rand .= $seed[$k];

            $pass = $rand;
            $password = md5($rand);
            $data = array(
                'password' => $password,
            );

            $this->db->where('id', $userData->id);
            $query = $this->db->update('users', $data);
            $to = $userData->email;
            $username = $userData->username;
            $subject = "password Change request";
            $message = "Hello $username. Your new password is $pass";
            $from = "info@60degree.com";
            $headers = "From:" . $from;
            mail($to, $subject, $message, $headers);
            $image = $userData->image;

            $this->trueResponse("Password has been sent to your email address");
        } else {
            $this->falseResponse("No response");
        }
        die;
    }
	/*
	// Main search function searchAction
	*/
	protected function search($data) {
		$stag = $data->s;
		$sql = "SELECT name, search_tags FROM `subreddits` WHERE `search_tags` LIKE '%".$stag."%'";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $searchdata['searchdata'] = $query->result_array();
		} else {
			$searchdata['searchdata'] = array();
		}
		// form user gifs will be used in channel
		$tagdata = $this->app_model->getTag($stag);//will return tag id like ($tagdata['tag_id']);
		if($tagdata){
			$usertagids 	= $this->app_model->getUserIdsByTagId($tagdata['tag_id']);
			if($usertagids){
				$i=0;
				foreach($usertagids as $uid){
					$username 					= $this->app_model->getUserdataById($uid['user_id']);
					$usertagids[$i]['username'] = $username['username'];
					$usertagids[$i]['profile']  = $username['profile_pic'];
					$i++;
				}
				$searchdata['channeldata'] = $usertagids;
			} else {
				$searchdata['channeldata'] = array();
			}
			$this->trueResponse($searchdata,'success',$encode = true);  
		} else {
			$this->falseResponse('No result found'); 
		}
	}
	/*
	// function searchPostAction
	*/
	protected function searchPost($data) {
		$pid 			= $data->pid;
		$nsfw 			= $data->nsfw;
		$sql 			= "SELECT `name` FROM `subreddits` WHERE nsfw = 1";
		$query 			= $this->db->query($sql);
        $nsfwsubreddits = $query->result_array();
        foreach($nsfwsubreddits as $k=> $v){
			foreach($v as $final){
				$nsfwarr[] = $final;
			}
		}
        $t = '';
        if(strpos($data->s,',')) {
			$subids = explode(',', $data->s);
			foreach($subids as $s){
				if(in_array($s, $nsfwarr) && $nsfw !='yes'){
					continue;
				} else{
					$t .= "'".$s."',";
				}
			}
			$subreddit = rtrim($t, ',');
		} else {
			if(in_array($data->s, $nsfwarr) && $nsfw !='yes'){
					continue;
				} else{
					$subreddit  = "'".$data->s."'";
				}
		}
		
		if($nsfw !='yes'){
			$nsfwfilter = "AND nsfw = '0'";
		} else{
			$nsfwfilter = '';//"OR nsfw = '1'";
		}
		
		$AND_ID = '';
		if($pid!=''){ 
			$AND_ID = "AND id < ".$pid;
		}
		$sql 	= "SELECT id, title, name, created_time, mp4url, webmUrl, gifUrl, gfyname, score FROM reddit WHERE subreddit_id in (".$subreddit.") ".$AND_ID." ".$nsfwfilter." ORDER BY created_time DESC limit 20";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $searchdata = $query->result();
            $this->trueResponse($searchdata,'success',$encode = true);  
		} else {
			$this->falseResponse('No result found');  
		}
		
	}
	/*
	// channel posts
	*/
	protected function channelPost($data) {
		$user_id 	= $data->user_id;
		$tag_id 	= $data->tag_id;
		$pid 		= $data->pid;
		$AND_ID = '';
		if($pid!=''){ 
			$AND_ID = "AND id < ".$pid;
		}
		//$result 	= $this->app_model->getGifsByUser_TagId($tag_id, $user_id, $AND_ID);
		$sql 			= "select * from users_gif where user_id = ".$user_id." AND FIND_IN_SET('".$tag_id."', tag_id) ".$AND_ID." limit 20"; 
		$query 			= $this->db->query($sql);
        if ($query->num_rows() > 0) {
			$result = $query->result_array();
            $this->trueResponse($result,'success',$encode = true);  
		} else {
			$this->falseResponse('No result found');  
		}
		
	}
	/*
	//single channel post
	*/
	protected function singlechannelpost($data) {
		$pid 			= $data->pid;
		$loggeduser 	= $data->user_id;
		//$reddit_id 		= $data->name;
		$sql 			= "select * from users_gif where id = ".$pid;
		$query 			= $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $datas['searchdata'] = $query->row_array();
            $tofollow  			 = $datas['searchdata']['user_id'];
		}
		
		$post_userid 		= $datas['searchdata']['user_id'];
		$userdata			= $this->app_model->getUserdataById($post_userid);
		$datas['profiledata']['user_id']	= $userdata['id'];
		$datas['profiledata']['username']	= $userdata['username'];
		$datas['profiledata']['profile']	= $userdata['profile_pic'];
		
		$comment 			= "Select user_id, comment from appcomments where post_id = ".$pid." order by id DESC limit 10" ;
		$query 				= $this->db->query($comment);
        if($query->num_rows() > 0) { 
            $data = $query->result_array();
            $i=0;
            foreach($data as $comment){
				$userid  	= $comment['user_id'];
				$username 	= "Select username, name from users where id = ".$userid;
				$query 		= $this->db->query($username);
				if($query->num_rows() > 0) {
					$username 	= $query->row_array();
					$commentdata[$i]['user_id'] = $userid;
					$commentdata[$i]['username']= $username['username'];
					$commentdata[$i]['comment'] = $comment['comment'];
				}
				$i++;
			}
			$datas['commentdata'] = $commentdata;
		} else {
			$datas['commentdata'] = array();
			
		}
		// update the view count 
		$stats 				= "Select viewcount, likecount, commentcount from appstats where post_id = ".$pid;
		$query 				= $this->db->query($stats);
        if ($query->num_rows() > 0) {
            $datas['statsdata']				= $query->row_array();
            $datas['statsdata']['viewcount']= $datas['statsdata']['viewcount']+1;
            $update_view 	= "UPDATE appstats SET viewcount= ".$datas['statsdata']['viewcount']." WHERE post_id=".$pid;
            $this->db->query($update_view);
		}else{
			
			$like_entry = array(
				'reddit_id' 	=> '',
				'post_id'		=> $pid,
				'viewcount'		=> '1',
				'likecount'		=> 0,
				'commentcount'	=> 0,
				); 
			$result				= $this->db->insert('appstats', $like_entry);
			if($result){
				$datas['statsdata']['viewcount']	= 1;
			} else{
				$datas['statsdata']['viewcount']	= 0;
			}
			
			$datas['statsdata']['likecount']	= 0;
			$datas['statsdata']['commentcount']	= 0;
		}
		//follow or following
		$follow =  $this->app_model->FollowFollowing($tofollow, $loggeduser);
		if($follow){
			$datas['followdata']['follow']	= '1';
		} else {
			$datas['followdata']['follow']	= '0';
		}
		
		$this->trueResponse($datas,'success',$encode = true);  
	}
	/*
	//single post function
	*/
	protected function singlepost($data) {
		$pid 			= $data->pid;
		$reddit_id 		= $data->name;
		$sql 			= "Select title, name, score, webmUrl, gifUrl, mp4Url, gfyname from reddit where name = '".$reddit_id."'";
		$query 			= $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $datas['searchdata'] = $query->row_array();
		}
		
		$comment 		= "select user_id, comment from appcomments where reddit_id = '".$reddit_id."'";
		$query 			= $this->db->query($comment);
        if($query->num_rows() > 0) { 
            $data = $query->result_array();
            $i=0;
            foreach($data as $comment){
				$userid  		= $comment['user_id'];
				$username 		= "Select username, name from users where id = ".$userid;
				$query 			= $this->db->query($username);
				if($query->num_rows() > 0) {
					$username 						= $query->row_array();
					$commentdata[$i]['user_id'] 	= $userid;
					$commentdata[$i]['username']	= $username['username'];
					$commentdata[$i]['comment'] 	= $comment['comment'];
				}
				$i++;
			}
			$datas['commentdata'] = $commentdata;
		} else {
			$datas['commentdata'] = array();
			
		}
		// update the view count 
		$stats 			= "select viewcount, likecount, commentcount from appstats where reddit_id = '".$reddit_id."'";		
		$query 			= $this->db->query($stats);
		//pr($query);
        if ($query->num_rows() > 0) {
            $datas['statsdata']				= $query->row_array();
            $datas['statsdata']['viewcount']= $datas['statsdata']['viewcount']+1;
            $update_view 	= "UPDATE appstats SET viewcount= ".$datas['statsdata']['viewcount']." WHERE reddit_id='".$reddit_id."'";
            $this->db->query($update_view);
		}else{ 
			// insert for new record
			$like_entry = array(
				'reddit_id' 	=> $reddit_id,
				'post_id'		=> $pid,
				'viewcount'		=> '1',
				'likecount'		=> 0,
				'commentcount'	=> 0,
				); 
			$result				= $this->db->insert('appstats', $like_entry);
			if($result){
				$datas['statsdata']['viewcount']	= 1;
			} else{
				$datas['statsdata']['viewcount']	= 0;
				}
			
			//$datas['statsdata']['viewcount']	= 0;
			$datas['statsdata']['likecount']	= 0;
			$datas['statsdata']['commentcount']	= 0;
		}
		$this->trueResponse($datas,'success',$encode = true);  
	}
	/*
	//update  the like count for post
	*/
	protected function like($data) { 
		$user_id 		= $data->user_id;
		$pid 			= $data->pid;
		$reddit_id 		= $data->name;
		if($reddit_id!=''){
			$where_AND  = "AND reddit_id = '".$reddit_id."'";
			$where  	= "reddit_id = '".$reddit_id."'";
		} else {
			$where_AND  = "AND post_id = ".$pid;
			$where  	= "post_id = ".$pid;
		}
		
		$sql		= "Select * from userpostlike where user_id = ".$user_id." ".$where_AND;		
		$query 		= $this->db->query($sql);
		if($query->num_rows() > 0) { 
			// user already liked the post
			$this->falseResponse('You already liked the post.');
		} else {
		
			$sql	 		= "Select likecount from appstats where ".$where;
			$query 			= $this->db->query($sql);
			if($query->num_rows() > 0) { 
				$likedata = $query->row_array();
				$likedata['likecount'] 	= $likedata['likecount']+1;
				$update_like 			= "UPDATE appstats SET likecount= ".$likedata['likecount']." where ".$where;
				
				if($this->db->query($update_like)){
					$like_entry = array(
						'reddit_id' 	=> $reddit_id,
						'user_id'		=> $user_id,
						'post_id'		=> $pid
					); 
					$result				= $this->db->insert('userpostlike', $like_entry);
					$activity_data= array(
						'reddit_id' 	=> $reddit_id,
						'post_id'		=> $pid,
						'mode'			=> '1', 
						'user_id'		=> $user_id
					);
					$activity				= $this->db->insert('activity', $activity_data);
					$this->trueResponse($likedata,'success', $encode = true);
				}
			} else { //insert if there is first time any user like this post
				$like_entry = array(
						'reddit_id' 	=> $reddit_id,
						'user_id'		=> $user_id,
						'post_id'		=> $pid
					); 
				$result				= $this->db->insert('userpostlike', $like_entry);
				
				$data = array(
					'reddit_id' 	=> $reddit_id,
					'likecount'		=> 1,
					'viewcount'		=> '', 
					'commentcount'	=> '', 
					//'user_id'		=> '',
					'post_id'		=> $pid
				);
				$result				= $this->db->insert('appstats', $data);
				$last_inserted_id 	= $this->db->insert_id();
				if (!empty($last_inserted_id)) {
					$activity_data= array(
						'reddit_id' 	=> $reddit_id,
						'post_id'		=> $pid,
						'mode'			=> '1', 
						'user_id'		=> $user_id//$user_id
					);
					$activity			= $this->db->insert('activity', $activity_data);			
					$sql = "select likecount from appstats where id='$last_inserted_id'";
					$query = $this->db->query($sql);
					if ($query->num_rows() > 0) {
						$likedata 		= $query->_fetch_object();
						$this->trueResponse($likedata,'success', $encode = true);
					}
				}
			}
		}
	}
	/*
	// like the gif from app
	*/
	protected function comment($cmntdata) {
		//$usercomment	= array();
		$pid 			= $cmntdata->pid;
		$user_id 		= $cmntdata->user_id;
		$reddit_id 		= $cmntdata->name;
		$comment 		= $cmntdata->comment;
		$data = array(
			'reddit_id' 	=> $reddit_id,
			'post_id'		=> $pid,
			'comment'		=> $comment, 
			'user_id'		=> $user_id
		);
		$result				= $this->db->insert('appcomments', $data);
		//add activity
		$activity_data= array(
			'reddit_id' 	=> $reddit_id,
			'post_id'		=> $pid,
			'mode'			=> '2', 
			'user_id'		=> $user_id
		
		);		
		if ($result) {
			$activity				= $this->db->insert('activity', $activity_data);
			//pr($activity);die;
			$username 				= $this->app_model->getUsernameById($user_id);
			$usercomment['commentdata'][0]['comment'] 	= $comment; 
			$usercomment['commentdata'][0]['username'] 	= $username['username']; 
			$usercomment['commentdata'][0]['user_id'] 	= $user_id; 
			$sql = "select commentcount from appstats where post_id= ".$pid;
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$commentcount 		= $query->row_array();
				$commentcount['commentcount'] = $commentcount['commentcount']+1;
				$update_comment 	= "UPDATE appstats SET commentcount= ".$commentcount['commentcount']." WHERE post_id=".$pid;
				if($this->db->query($update_comment)){
					//$usercomment['commentdata'][0]['commentcount'] = $commentcount['commentcount'];
				}
			} else { // this is for first time
				$statsdata = array(
					'reddit_id' 	=> $reddit_id,
					'likecount'		=> '',
					'viewcount'		=> '', 
					'commentcount'	=> 1, //first time increament
					//'user_id'		=> $user_id,
					'post_id'		=> $pid
				); 
				$result				= $this->db->insert('appstats', $statsdata);
				if ($result) {
					$sql 	= "select commentcount from appstats where post_id='$pid'";
					$query 	= $this->db->query($sql);
					if ($query->num_rows() > 0) {
						$commentcount 		= $query->row_array();
						//$usercomment['commentdata'][0]['commentcount'] = $commentcount['commentcount'];
					} 
				}
			}
			$this->trueResponse($usercomment,'success', $encode = true);
		}
	}
	/*
	// upload gif from app
	*/
	protected function uploadgif($imgdata) { 
		//$this->trueResponse($, 'success', $encode = true);die;
						
			$r_data  = array();
		   
			$r_data['tags'] 			= $imgdata->tags;
			$r_data['title'] 			= $imgdata->title;
			$url 						= $imgdata->gifurl;					
			$r_data['user_id'] 			= $imgdata->user_id;
			$tags 						= $imgdata->tags;	
			$tagids 					= array();
			$tagsarray 					= array();
			if(strpos($tags,',')) {
				$tagsarray 	= explode(',', $tags);
			} else {
				$tagsarray  = array($tags);
			}
			
			if(!empty($_FILES["userfile"]["name"])){ 
				
				$filename 		= time()."_".$_FILES["userfile"]["name"];
				$fileurl 		= base_url()."templates/uploads/user_gifs/".$filename;
				$temp 			= explode(".", $_FILES["userfile"]["name"]);
				if ($_FILES["userfile"]["error"] > 0) {
					$this->falseResponse('There was an error in the file.');
				} else {  
					if(move_uploaded_file($_FILES["userfile"]["tmp_name"], "templates/uploads/user_gifs/".$filename)){
						$exts = pathinfo($fileurl, PATHINFO_EXTENSION);
						if((!empty($fileurl)) && ($exts=='gif')){
							$gyf_vid 		= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$fileurl));
							if(isset($gyf_vid->webmUrl)){
								
						
								// insert tags to tags table if not exist any one
								foreach($tagsarray as $tag){//1,2,3
									$tagdata = $this->app_model->getTag($tag);// find tag in tag table
									//$this->trueResponse($tagdata, 'success', $encode = true);die;
									if(!$tagdata){
										$tarr 					= array('tag_name'=>$tag);
										$tag_id 				= $this->app_model->insertTags($tarr);// if not found then insert// will return id
										$usertagdata['tag_id'] 	= $tag_id;
										$tagids[] 				= $tag_id;// to insert in user_gifs table
									} else {
										$usertagdata['tag_id'] 	= $tagdata['tag_id'];
										$tagids[] 				= $tagdata['tag_id'];// to insert in user_gifs table
									}
									$usertagdata['user_id'] 	= $r_data['user_id'];
									$this->app_model->insertUserTag($usertagdata);
								}
								
								$r_data['webmUrl'] 		= $gyf_vid->webmUrl;
								$r_data['mp4url'] 		= $gyf_vid->mp4Url;		
								$r_data['gifUrl'] 		= $gyf_vid->gifUrl;		
								$r_data['gfyname'] 		= "http://gfycat.com/".$gyf_vid->gfyname;	
								$r_data['url'] 			= $fileurl;
								$r_data['created'] 		= date('Y-m-d H:i:s');
								$r_data['tag_id']  		= implode(",", $tagids);
								$inserted 				= $this->app_model->insertUserGif($r_data);	
								//add activity
								if($inserted){
									$activity_data= array(
										'reddit_id' 	=> '',
										'post_id'		=> $inserted,
										'mode'			=> '0', 
										'user_id'		=> $r_data['user_id']
									);
									$activity				= $this->db->insert('activity', $activity_data);
									$this->trueResponse($r_data, 'success', $encode = true);
								} else {
									$this->falseResponse('Please try again');
								} 
							}	else{
								$this->falseResponse('There is problem with gif');
							}	
						}
					}
					
				}
				
				
			} else if(!empty($url)){ 
				$exts 		= pathinfo($url, PATHINFO_EXTENSION);
				
				if((!empty($url)) && ($exts=='gif')){	
					
					$gyf_vid 		= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$url));
					if(isset($gyf_vid->webmUrl)){
						
						// insert tags to tags table if not exist any one
						foreach($tagsarray as $tag){//1,2,3
							$tagdata = $this->app_model->getTag($tag);// find tag in tag table
							if(!$tagdata){
								$tarr 					= array('tag_name'=>$tag);
								$tag_id 				= $this->app_model->insertTags($tarr);// if not found then insert// will return id
								$usertagdata['tag_id'] 	= $tag_id;
								$tagids[] 				= $tag_id;// to insert in user_gifs table
							} else {
								$usertagdata['tag_id'] 	= $tagdata['tag_id'];
								$tagids[] 				= $tagdata['tag_id'];// to insert in user_gifs table
							}
							$usertagdata['user_id'] 	= $r_data['user_id'];
							$this->app_model->insertUserTag($usertagdata);
						}
						$r_data['webmUrl'] 		= $gyf_vid->webmUrl;
						$r_data['mp4url'] 		= $gyf_vid->mp4Url;		
						$r_data['gifUrl'] 		= $gyf_vid->gifUrl;		
						$r_data['gfyname'] 		= "http://gfycat.com/".$gyf_vid->gfyname;	
						$r_data['url'] 			= $url;
						$r_data['created'] 		= date('Y-m-d H:i:s');
						$r_data['tag_id']  		= implode(",", $tagids);
						$inserted 				= $this->app_model->insertUserGif($r_data);		
						//add activity
						if($inserted){
							$activity_data= array(
								'reddit_id' 	=> '',
								'post_id'		=> $inserted,
								'mode'			=> '0', 
								'user_id'		=> $r_data['user_id']
							);
							$activity				= $this->db->insert('activity', $activity_data);
							$this->trueResponse($inserted, 'success', $encode = true);
						} else {
							$this->falseResponse('Please try again.');
						}
					} else{
						$this->falseResponse('There is problem with URL');
					}
					
				}
			}
		
	}
	/*
	// profile data 
	*/
	protected function profile($data) {
		$user_id 	= $data->user_id;
		// user data
		$userdata 	= $this->app_model->getUserdataById($user_id); // user details
		if ($userdata) {
			$profile['userdata']['user_id'] 	= $userdata['id'];
			$profile['userdata']['username'] 	= $userdata['username'];
			$profile['userdata']['dtype'] 		= $userdata['dtype'];
			$profile['userdata']['profile_pic'] = $userdata['profile_pic'];
			$profile['userdata']['tag_line'] 	= $userdata['tag_line'];
		} else {
			$this->falseResponse('No result found');  //no need for this
		}
		// usergifcount 
		$usergifcount 	= $this->app_model->getUserGifsCount($user_id); //user gif data
		
		$profile['userfollowers']['postcount'] = $usergifcount['postcount'];
		// user network data (follow/following)
		$userfollowers 	= $this->app_model->userFollowCount($user_id); //user gif data
		if($userfollowers){
			$profile['userfollowers']['followers']	= $userfollowers['followers'];
		} else{
			$profile['userfollowers'] 	= '0';
		}
		$userfollowing 	= $this->app_model->userFollowingCount($user_id); //user gif data
		if($userfollowing){
			$profile['userfollowers']['following'] 	= $userfollowing['following'];
		} else{
			$profile['userfollowers'] 	= '0';
		}
		//$result = $this->db->insert('users', $data);
		//$last_inserted_id = $this->db->insert_id();
		$this->trueResponse($profile,'success',$encode = true); 
		
	}
	/*
	// channel posts
	*/
	protected function profileGifs($data){
		$user_id 		= $data->user_id;
		$pid 			= $data->pid;
		$AND_ID 		= '';
		if($pid!=''){ 
			$AND_ID = "AND id < ".$pid;
		}
		$sql 			= "SELECT * from users_gif where user_id = ".$user_id." ".$AND_ID." order by id DESC limit 0, 10"; 
		$query 			= $this->db->query($sql);
		if($query->num_rows() > 0) {
			$usergifdata 			= $query->result_array();
			$gifs['usergifdatas'] 	= $usergifdata;
			$this->trueResponse($gifs,'success', $encode = true);
		} else {
			$gifs['usergifdatas'] 	= array();
			$this->falseResponse('Sorry you have no follower.');
		}
		
	}
	/*
	// logged in user followers
	*/	
	protected function userFollowers($data) {
		$user_id 		= $data->user_id;
		$userfollowers 	= $this->app_model->userFollowData($user_id); //user gif data
		if($userfollowers){
			$i=0;
			foreach($userfollowers as $userfollower){
				$userdata 	= $this->app_model->getUserdataById($userfollower['network_id']); // user details
				if($userdata) {
					$profile['userdata'][$i]['network_id'] 	= $userdata['id'];
					$profile['userdata'][$i]['username'] 	= $userdata['username'];
					$profile['userdata'][$i]['profile_pic'] = $userdata['profile_pic'];
					$profile['userdata'][$i]['tag_line'] 	= $userdata['tag_line'];
					//pr($profile);
				} else { // no need for else
					//$profile['userdata'][$i] = array();
				}
				//$result = $this->db->insert('users', $data);
				//$last_inserted_id = $this->db->insert_id();
				$i++;
			}
			
		} else{
			$this->falseResponse('Sorry you have no follower.');
		}
		$this->trueResponse($profile, 'success', $encode = true); 
		
	}
	/*
	// logged in user following
	*/
	protected function userFollowing($data) {
		$user_id 			= $data->user_id;
		$userfollowings 	= $this->app_model->userFollowingData($user_id); //user gif data
		if($userfollowings){
			$i=0;
			foreach($userfollowings as $userfollowing){
				$userdata 	= $this->app_model->getUserdataById($userfollowing['network_id']); // user details
				if ($userdata) {
					$profile['userdata'][$i]['network_id'] 	= $userdata['id'];
					$profile['userdata'][$i]['username'] 	= $userdata['username'];
					$profile['userdata'][$i]['profile_pic'] = $userdata['profile_pic'];
					$profile['userdata'][$i]['tag_line'] 	= $userdata['tag_line'];
				} else {
					//$profile['userdata'] = array();
				}
				$i++;
			}
		} else{
			//$profile['userdata'] 	= array();
			$this->falseResponse('Sorry you are not following anyone.');
		}
		$this->trueResponse($profile,'success',$encode = true); 
	}
	/*
	//follw user function
	*/
	protected function followUser($data) {
		$userfollow 		= $data->userfollow;
		$loggeduser 		= $data->user_id;
		$tofollow 			= $data->tofollow;
		$userdata  			= array ('user_id'=>$loggeduser, 'network_id'=>$userfollow, 'networkstatus'=>'2');
		if($tofollow =='yes'){
			//insert
			$follow 		= $this->app_model->insertFollower($userdata);
			$userdata  		= array ('user_id'=>$userfollow, 'network_id'=>$loggeduser, 'networkstatus'=>'1');
			$follow 		= $this->app_model->insertFollower($userdata);
			if($follow){
				$datas['followdata']['follow']	= '1';
				$this->trueResponse($datas,'yes',$encode = true);
			} else {
				$this->falseResponse('Please try again');  	
			}
		} else { //delete
			$unfollow 		= $this->app_model->deleteFollower($userfollow, $loggeduser);
			if($unfollow){
				$datas['followdata']['follow']	= '0';
				$this->trueResponse($datas,'yes',$encode = true);
			} else {
				$this->falseResponse('Please try again');  	
			}
			
		}
		
		
		
	}
	
	
	
	protected function otherUserFollowers($data) {
		$user_id 			= $data->user_id;
		$other_user 		= $data->other_user;
		$otherUserfollowers = $this->app_model->otherUserFollowData($other_user); //user folloers and following
		$userfollowers 		= $this->app_model->loggedUserFollowData($user_id); //user folloers and following
		$j=0;
		foreach($userfollowers as $k=> $v){
			$nsfwarr[$j] = $v['network_id'];
			$j++;
		}
		if($otherUserfollowers){
			$i=0;
			foreach($otherUserfollowers as $otherUserfollower){
				
					$userdata 	= $this->app_model->getUserdataById($otherUserfollower['network_id']); // user details
					if ($userdata) {
						$profile['userdata'][$i]['network_id'] 	= $userdata['id'];
						$profile['userdata'][$i]['username'] 	= $userdata['username'];
						$profile['userdata'][$i]['profile_pic']	= $userdata['profile_pic'];
						$profile['userdata'][$i]['tag_line'] 	= $userdata['tag_line'];
						if(in_array($otherUserfollower['network_id'], $nsfwarr)){
							$profile['userdata'][$i]['mutual'] 		= '1';
						} else {
							$profile['userdata'][$i]['mutual'] 		= '0';
							}
					} else {
						$profile['userdata'] = array();
					}
					$i++;
				
			}
			
		} else{
			//$profile['userdata'] 	= '0';
			$this->falseResponse('Sorry user has no follower.');
		}
		$this->trueResponse($profile,'success',$encode = true); 
		
	}
	
	
	
	protected function otherUserFollowing($data) {
		$user_id 			= $data->user_id;
		$other_user 		= $data->other_user;
		$otherUserfollowers = $this->app_model->otherUserFollowingData($other_user); //user folloers and following
		$userfollowers 		= $this->app_model->loggedUserFollowingData($user_id); //user folloers and following
		$j=0;
		foreach($userfollowers as $k=> $v){
			$nsfwarr[$j] = $v['network_id'];
			$j++;
		}
		if($otherUserfollowers){
			$i=0;
			foreach($otherUserfollowers as $otherUserfollower){
				
					$userdata 	= $this->app_model->getUserdataById($otherUserfollower['network_id']); // user details
					if ($userdata) {
						$profile['userdata'][$i]['network_id'] 	= $userdata['id'];
						$profile['userdata'][$i]['username'] 	= $userdata['username'];
						$profile['userdata'][$i]['profile_pic'] 	= $userdata['profile_pic'];
						$profile['userdata'][$i]['tag_line'] 	= $userdata['tag_line'];
						if(in_array($otherUserfollower['network_id'], $nsfwarr)){
							$profile['userdata'][$i]['mutual'] 		= '1';
						} else {
							$profile['userdata'][$i]['mutual'] 		= '0';
							}
					} else {
						$profile['userdata'] = array();
					}
					$i++;
				
			}
			
		} else{
			$this->falseResponse('Sorry user is not following to any user.');
		}
		$this->trueResponse($profile,'success',$encode = true); 
		
	}
	
	
	
	protected function profilepic($imgdata) { 
		//pr($_FILES);die;
		$user_id			= $imgdata->user_id;			
		if(!empty($_FILES["userfile"]["name"])){ 
			$filename 		= time()."_".$_FILES["userfile"]["name"];
			$fileurl 		= base_url()."templates/uploads/profile_images/".$filename;
			$allowedExts 	= array("jpg", "jpeg", "png");
			$temp 			= explode(".", $_FILES["userfile"]["name"]);
			$extension 		= end($temp);
			
			if ($_FILES["userfile"]["error"] > 0) {
				$this->falseResponse('There was an error in the file.');
			} else {  
				if ( in_array($extension, $allowedExts) ){
					if(move_uploaded_file($_FILES["userfile"]["tmp_name"], "templates/uploads/profile_images/".$filename)){
						$inserted 		= $this->app_model->updateUserImage($user_id, $fileurl);		
						if($inserted){
							$this->trueResponse($fileurl, 'success', $encode = true);
						} else {
							$this->falseResponse('Please try again');
						} 		
					}
				} else {
					$this->falseResponse('Please use .jpeg or .png image.');
				}
			}
		} else {
			$this->falseResponse('Please choose an image.');
		}
	} 
	
	
	
	protected function feed($data) {
		$user_id 		= $data->user_id; 
		$userfollowings = $this->app_model->userFollowingData($user_id);
		$i=0;
		if($userfollowings){// all users
			foreach($userfollowings as $user){
				$uids[] = $user['network_id'];
			}
			//$userids 		= implode(",", $uids);
			$userfollowingfeed = $this->app_model->userFollowingFeed($uids);
			if($userfollowingfeed){
				foreach($userfollowingfeed as $feed){
					if($feed['reddit_id']!=''){//posts from reddit table
						$usergifsdata 	= $this->app_model->getRdditgifsDataById($feed['reddit_id']);
						if($usergifsdata){
							$fparr[$i]				= $usergifsdata;
							$fparr[$i]['tag_id']	= '';
							$fparr[$i]['tags']		= '';
							$fparr[$i]['linkout']	= ''; 
							$fparr[$i]['user_id']	= '';
						}	
					} else {
						$usergifsdata 	=  $this->app_model->getUsergifsDataById($feed['post_id']);
						if($usergifsdata){
							$fparr[$i]			= $usergifsdata;
							$fparr[$i]['name']	= '';
							$fparr[$i]['score']	= '';
							$fparr[$i]['created_time']	=$fparr[$i]['created']; 
							unset($fparr[$i]['created']);
						}
					}
					$i++;
				}
				$this->trueResponse($fparr,'success', $encode = true);
			} else {
				$this->falseResponse('Nothing found');	
			}
			
		} else {
			$this->falseResponse('You are not following anyone.');
		}
	}
	protected function caption($data) {
		$user_id 		= $data->user_id; 
		$title 			= $data->title; 
		$name 			= $data->name; 
		$pid 			= $data->pid; 
		$notfound = '0';
		if($name!=''){
			$sql 	= "select * from reddit where name='$name'";
			$query 	= $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$post 			= $query->row_array();
				$sql 			= "select search_tags from subreddits where name='".$post['subreddit_id']."'";
				$query 			= $this->db->query($sql);
				$posttags 		= $query->row_array();
				$tags			= $posttags['search_tags'];
				
				if(strpos($tags,',')) {
					$tagsarray 	= explode(',', $tags);
				} else {
					$tagsarray  = array($tags);
				}
				// insert tags to tags table if not exist any one
				foreach($tagsarray as $tag){//1,2,3
					$tagdata = $this->app_model->getTag($tag);// find tag in tag table
					//$this->trueResponse($tagdata, 'success', $encode = true);die;
					if(!$tagdata){ 
						$tarr 					= array('tag_name'=>$tag);
						$tag_id 				= $this->app_model->insertTags($tarr);// if not found then insert// will return id
						$usertagdata['tag_id'] 	= $tag_id;
						$tagids[] 				= $tag_id;// to insert in user_gifs table
					} else {
						$usertagdata['tag_id'] 	= $tagdata['tag_id'];
						$tagids[] 				= $tagdata['tag_id'];// to insert in user_gifs table
					}
					$usertagdata['user_id'] 	= $user_id;
					$this->app_model->insertUserTag($usertagdata);
				}
				$post['tag_id'] = implode(",", $tagids);
				$post['tags'] 	= $tags;
				
				
				unset($post['name'], $post['permalink'], $post['nsfw'], $post['score'], $post['ups'], $post['downs'], $post['subreddit_id'], $post['created_time'],$post['created'],$post['subreddit']);
				
				//die;
			} else {
				$notfound = '1';
			}
			
		} else {
			$sql 	= "SELECT * from users_gif where id='$pid'";
			$query 	= $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$post 		= $query->row_array();
			} else {
				$notfound = '1';
			}
		}
		if($notfound =='0'){
			//insert here in the users gifs table
			$post['user_id']	= $user_id ;
			$post['title']		= $title ;
			unset($post['id']);
			$result = $this->db->insert('users_gif', $post);
			$last_inserted_id = $this->db->insert_id();
			if($last_inserted_id){
				$this->trueResponse($post,'success', $encode = true);
			} else {
				$this->falseResponse('There is an error.');
			}
			
		}
		

	}
	/*
	 * function for cron to fill the data in every 10 min for trending 
	*/
	/*protected function trendingdata($data) {
		$this->db->truncate('postrank'); 
		$allposts 		= $this->app_model->getRedditPosts();// get all posts from reddit with in 48 hours
		$gravity		= array();
		$i=0;
		for($i;$i<=48;$i++){
			$gravity[$i]= $i/10;	
		}
		$j=0;
		foreach($allposts as $post){
			$score 			= $post['score'];
			$created_time  	= $post['created_time'];
			$score  		= $post['score'];
			$created_time 	= strtotime($post['created_time']);
			$currenttime 	= strtotime(date('Y-m-d H:i:s'));			
			$diff 			= $created_time - $currenttime;
			$time	 		= date('H', $diff);// out =integer between 0-48
			
			$stats 			= "SELECT likecount from appstats where reddit_id = '".$post['name']."'";		
			$query 			= $this->db->query($stats);
			if ($query->num_rows() > 0) {
				$postviewcount	= $query->row_array();
				$applike		= $postviewcount['likecount'];
			} else {
				$applike 		= 0;
			}
			
			$finalrank = ($score-1)/($time+2)^$gravity[$time] + ($applike)/($time+2)^$gravity[$time];//trending formula
			$postarry[$j]['reddit_id'] 	= $post['name'];
			$postarry[$j]['post_id'] 	= $post['id'];
			$postarry[$j]['rank'] 		= $finalrank;
			$j++;
		}
		$sorted_data 		= $this->orderBy($postarry, 'rank');
		
		foreach($sorted_data as $pdata){ 
			$this->db->insert('postrank', $pdata);
		}
	}
	
	function orderBy($data, $field){
		$code = "return strnatcmp(\$b['$field'], \$a['$field']);";
		usort($data, create_function('$a,$b', $code));
		return $data;
	}*/
	
	protected function trending($data) {
		$user_id 		= $data->user_id; 
		$device_id 		= $data->device_id; 
		$offset 		= $data->offset; 
		$nsfw 			= $data->nsfw; 
		$trendingdata 	= array();
		
		
		$post_ids		= "SELECT post_id from postrank";		
		$query 			= $this->db->query($post_ids);
		if ($query->num_rows() > 0) {
			$post_ids	= $query->result_array();
			foreach($post_ids as $postids)
			$pids[]		= $postids['post_id'];
		} else {
			$pids 		= array();
		}
		
		
		if($offset==0){//only update the table if pid==vlank  means first time he request
			$pids_str 		= implode(",", $pids);//comma seprated post ids
			
			$trendingdata['posts'] 		= $pids_str;
			$trendingdata['user_id']	= $user_id;
			$trendingdata['device_id']	= $device_id;	
		
			$post_ids		= "SELECT user_id from usertrending where user_id = ".$user_id;		
			$query 			= $this->db->query($post_ids);
			if ($query->num_rows() > 0) {//update usertrending
				$this->app_model->updateUserTrending($user_id, $device_id, $pids_str);
			} else {
				$result = $this->db->insert('usertrending', $trendingdata);
			}
		}
		
		if($nsfw !='yes'){
			$nsfwfilter = "AND nsfw = 0";
		} else{
			$nsfwfilter = '';//"AND nsfw = 1";
		}
	
		$post_ids		= "SELECT posts from usertrending where user_id = ".$user_id;		
		$query 			= $this->db->query($post_ids);
		
		if ($query->num_rows() > 0) {//update usertrending
			$post_ids	= $query->row_array();
			$posts 	    = explode(',', $post_ids['posts']);
		} else {
			$posts = array();	
		}
		$output = array_slice($posts, $offset, 20); 
		$finalids = implode(',', $output);
		
		$sql 			= "SELECT id, title, name, created_time, mp4url, webmUrl, gifUrl, gfyname, score FROM reddit WHERE id in (".$finalids.") ".$nsfwfilter. " ORDER BY FIELD(id, ".$finalids.")"; 
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $searchdata = $query->result();
            $this->trueResponse($searchdata,'success',$encode = true);  
		} else {
			$this->falseResponse('No result found');  
		}
		
		
		
	}
	
	

	
}


	if (!function_exists('pr')) {
		function pr($a) {
			echo "<pre>";
			print_r($a);
			echo "</pre>";
		}
	}
?>
