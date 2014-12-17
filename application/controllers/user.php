<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {
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
		if(!empty($user_id)){			
			$this->load->view('user');
		} else {
			redirect('/login');
		}
		
	}
	
	function uploadgif(){
		$r_data  = array();
		if(isset($_POST['sumitted']) && !empty($_POST['sumitted'])){
			$user_type = $this->session->userdata('booyah_user_type');
			if($user_type =='pro'){ //allow linkout url for pro user only
				$r_data['linkout'] 		= $this->input->post('linkout');
			} else {
				$r_data['linkout'] 		= '';
			}
			$r_data['tags'] 			= $this->input->post('tags');
			$r_data['title'] 			= $this->input->post('title');
			$url 						= $this->input->post('gifurl');					
			$r_data['user_id'] 			= $this->session->userdata('booyah_user_id');
			$tags 						= $this->input->post('tags');	
			$tagids 					= array();
			$tagsarray 					= array();
			if(strpos($tags,',')) {
				$tagsarray 	= explode(',', $tags);
			} else {
				$tagsarray  = array($tags);
			}
			
			if(!empty($_FILES["giffile"]["name"])){ 
				@$referer = $_SERVER['HTTP_REFERER']; 	
				$filename = time()."_".$_FILES["giffile"]["name"];
				$fileurl = base_url()."templates/uploads/user_gifs/".$filename;
				$allowedExts = array("gif, webm");
				$temp = explode(".", $_FILES["giffile"]["name"]);
				$extension = end($temp);
				if ((($_FILES["giffile"]["type"] == "image/gif")) || in_array($extension, $allowedExts)) {
					if ($_FILES["giffile"]["error"] > 0) {
						$this->session->set_flashdata('message', "Error: " . $_FILES["giffile"]["error"] );
						redirect($referer);
					} else {  
						move_uploaded_file($_FILES["giffile"]["tmp_name"], "templates/uploads/user_gifs/".$filename);
						$this->session->set_flashdata('message', "Error: Upload successful!" ); 
						
					}
				} else {
					$this->session->set_flashdata('message', "Error: Invalid file" );
					redirect($referer);			
				}
				
				
				$exts = pathinfo($fileurl, PATHINFO_EXTENSION);
				if((!empty($fileurl)) && ($exts=='gif')){		
					
					$gyf_vid 		= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$fileurl));
					if(isset($gyf_vid->webmUrl)){
						
						// insert tags to tags table if not exist any one
						foreach($tagsarray as $tag){//1,2,3
							$tagdata = $this->usertype_model->getTag($tag);// find tag in tag table
							//print_r($tagdata);die;
							if(!$tagdata){
								$tarr 					= array('tag_name'=>$tag);
								$tag_id 				= $this->usertype_model->insertTags($tarr);// if not found then insert// will return id
								$usertagdata['tag_id'] 	= $tag_id;
								$tagids[] 				= $tag_id;// to insert in user_gifs table
							} else {
								$usertagdata['tag_id'] 	= $tagdata['tag_id'];
								$tagids[] 				= $tagdata['tag_id'];// to insert in user_gifs table
							}
							$usertagdata['user_id'] 	= $r_data['user_id'];
							$this->usertype_model->insertUserTag($usertagdata);
						}
						$r_data['webmUrl'] 		= $gyf_vid->webmUrl;
						$r_data['mp4url'] 		= $gyf_vid->mp4Url;		
						$r_data['gifUrl'] 		= $gyf_vid->gifUrl;		
						$r_data['gfyname'] 		= "http://gfycat.com/".$gyf_vid->gfyname;	
						$r_data['url'] 			= $fileurl;
						$r_data['tag_id']  		= implode(",", $tagids);
						$inserted 				= $this->usertype_model->insertUserGif($r_data);		
						if($inserted){
							$this->session->set_flashdata('message', 'Gif uploaded successfully!');
							redirect('/user/listing');exit;
						} else {
							$this->session->set_flashdata('message', 'Please try again!');
							redirect('/user');exit;
						}
					}
					/*$gyf_vid 				= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$fileurl));
					$r_data['webmUrl'] 		= $gyf_vid->webmUrl;
					//$r_data['mp4url'] 	= $gyf_vid->mp4Url;
					$r_data['url'] 		= $fileurl;
					$inserted = $this->usertype_model->insertUserGif($r_data);		
					if($inserted){
						$this->session->set_flashdata('message', 'Gif uploaded successfully!');
						redirect('/user/listing');exit;
					} else {
						$this->session->set_flashdata('message', 'Please try again!');
						redirect('/user');exit;
					}*/
            				
				} else {
					$this->load->view('user');
				}
					
			} else if(!empty($url)){ 
				$exts 		= pathinfo($url, PATHINFO_EXTENSION);
				
				if((!empty($url)) && ($exts=='gif')){	
					
					$gyf_vid 		= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$url));
					if(isset($gyf_vid->webmUrl)){
						
						// insert tags to tags table if not exist any one
						foreach($tagsarray as $tag){//1,2,3
							$tagdata = $this->usertype_model->getTag($tag);// find tag in tag table
							//print_r($tagdata);die;
							if(!$tagdata){
								$tarr 					= array('tag_name'=>$tag);
								$tag_id 				= $this->usertype_model->insertTags($tarr);// if not found then insert// will return id
								$usertagdata['tag_id'] 	= $tag_id;
								$tagids[] 				= $tag_id;// to insert in user_gifs table
							} else {
								$usertagdata['tag_id'] 	= $tagdata['tag_id'];
								$tagids[] 				= $tagdata['tag_id'];// to insert in user_gifs table
							}
							$usertagdata['user_id'] 	= $r_data['user_id'];
							$this->usertype_model->insertUserTag($usertagdata);
						}
						$r_data['webmUrl'] 		= $gyf_vid->webmUrl;
						$r_data['mp4url'] 		= $gyf_vid->mp4Url;		
						$r_data['gifUrl'] 		= $gyf_vid->gifUrl;		
						$r_data['gfyname'] 		= "http://gfycat.com/".$gyf_vid->gfyname;	
						$r_data['url'] 			= $url;
						$r_data['tag_id']  		= implode(",", $tagids);
						$inserted = $this->usertype_model->insertUserGif($r_data);		
						if($inserted){
							$this->session->set_flashdata('message', 'Gif uploaded successfully!');
							redirect('/user/listing');exit;
						} else {
							$this->session->set_flashdata('message', 'Please try again!');
							redirect('/user');exit;
						}
					}
					
				} else {
					$this->session->set_flashdata('message', 'Please upload Gif only!');
					redirect('/user');exit;
				}
			} else {
				$this->load->view('user');
			}
		}
	}
	
	function deletegif($gifid){
		$this->usertype_model->deleteUserGif($gifid);	
		$this->session->set_flashdata('message', 'Gif data deleted successfully!');
		redirect('/user/listing');exit;		
	}
	
	function listing(){
		$user_id 			= $this->session->userdata('booyah_user_id');
		$data['user']		= $this->usertype_model->getUserTypeInfo($user_id);
		$data['usersgif']	= $this->usertype_model->getUserGif($user_id);
		$this->load->view('listing',$data);		
	}

}
