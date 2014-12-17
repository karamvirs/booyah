<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reguser extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$user_id = $this->session->userdata('booyah_user_id');
		if(!$user_id){
			redirect('/login');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('authenticate');
		$this->load->model('usertype_model');
		$this->load->library('form_validation');
	}
	function index(){
		$user_id = $this->session->userdata('booyah_user_id');
		$user_type = $this->session->userdata('booyah_user_type');
		if($user_type=='regular'){
			$data['reguser']=$this->usertype_model->getUserTypeInfo($user_id);
			$data['usersgif']=$this->usertype_model->getUserGif($user_id);
			$this->load->view('reguser.php',$data);
			} else {
				redirect('/login');
				}
	}
	function addgif(){		
		$url 	= $this->input->post('gifurl');	
		$tags 	= $this->input->post('tags');	
		$tagsarray = array();
		if(strpos($tags,',')) {
			$tagsarray = explode(',', $tags);
		} else {
			$tagsarray  = $tags;
		}
		
		
		$exts 	= pathinfo($url, PATHINFO_EXTENSION);
		if((!empty($url)) && ($exts=='gif')){			
			/*$gyf_vid 				= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$gifurl));
			$r_data['linkedurl'] 	= $gyf_vid->webmUrl;
			//$r_data['mp4url'] 	= $gyf_vid->mp4Url;*/
			$r_data['url'] 			= $url;
			$r_data['tag'] 			= $tags;// tag string default
			$r_data['user_id'] 		= $this->session->userdata('booyah_user_id');	
			// insert tags to tags table if not exist any one
			foreach($tagsarray as $tag){
				$tagdata = $this->usertype_model->getTag($tag);// find tag in tag table
				
				if(!$tagdata){
					$tag_id 			= $this->usertype_model->insertTags($tag);// if not found then insert
					$r_data['tag_id'] 	= $tag_id;
				} else {
					$r_data['tag_id'] 	= $tagdata['tag_id'];
				}
				$r_data['tag'] = $tagname;
				$this->usertype_model->insertUserTag($r_data);
			}
			
			//print_r($r_data);die;
			$this->usertype_model->insertUserGif($r_data);		
			redirect('/reguser');exit;		
		}		
		$this->load->view('regaddgif.php');					
	}
	
	function uploadgif(){ 
		if(!empty($_FILES["giffile"]["name"])){
			@$referer = $_SERVER['HTTP_REFERER']; 	
			$filename = time()."_".$_FILES["giffile"]["name"];
			$fileurl = base_url()."templates/uploads/user_gifs/".$filename;
			$allowedExts = array("gif, webm");
			$temp = explode(".", $_FILES["giffile"]["name"]);
			$tags = $_POST['tags'];
			$extension = end($temp);
			if ((($_FILES["giffile"]["type"] == "image/gif")) || in_array($extension, $allowedExts)) {
				if ($_FILES["giffile"]["error"] > 0) {
					$this->session->set_flashdata('message', "Error: " . $_FILES["giffile"]["error"] );
					redirect($referer);exit;
				} else {  
					move_uploaded_file($_FILES["giffile"]["tmp_name"], "templates/uploads/user_gifs/".$filename);
					$this->session->set_flashdata('message', "Error: Upload successful!" ); 
					
				}
			} else {
				$this->session->set_flashdata('message', "Error: Invalid file" );
				redirect($referer);	exit;	
			}
			
			
			$exts = pathinfo($fileurl, PATHINFO_EXTENSION);
			if((!empty($fileurl)) && ($exts=='gif')){			
				/*$gyf_vid 				= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$fileurl));
				$r_data['linkedurl'] 	= $gyf_vid->webmUrl;
				//$r_data['mp4url'] 	= $gyf_vid->mp4Url;*/
				$r_data['url'] 			= $fileurl;
				$r_data['tag'] 			= $tags;
				$r_data['user_id'] 		= $this->session->userdata('booyah_user_id');	
				//print_r($r_data);die;
				$this->usertype_model->insertUserGif($r_data);		
				redirect('reguser');		
			} else {
				$this->load->view('regaddgif.php');
			}
				
		} else {
				$this->load->view('regaddgif.php');
			}
	}
	
	function deletegif($gifid){
		$this->usertype_model->deleteUserGif($gifid);	
		redirect('/reguser');exit;		
	}

}
