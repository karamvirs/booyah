<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fetch_reddit extends CI_Controller{
		public function __construct() {     
			parent::__construct();    
			$this->load->library('session');
			if (!$this->session->userdata('spoton_admin_id')) {
				redirect(base_url() . "admin/login", 'refresh');
			}
			$this->load->model('reddit_model');		 
		}
		function index(){ 	die("no authorization! :(");
				$pointToStart = $this->reddit_model->getNameToStartOld();//get the name whose flag is 1
				if(!empty($pointToStart)){
					$this->reddit_model->resetNameToStart($pointToStart['url']);//reset the flag to zero again + remove the entry
					$after = $pointToStart['name'];
					$exts = pathinfo($pointToStart['url'], PATHINFO_EXTENSION);
					if($exts!='gif'){ //die("wait here");
						$this->reddit_model->deleteRecordToStart($pointToStart['name']);//delete the record if it is not a gif record
					}
				} else {
					$after 	= '';// for first time only
				}
				
				$l 		= 100;//default is 100 as in api
				$dl		= 1000;//1000 limit for reddit cache
				for($lim=$l;$lim<=$dl;$lim=$lim+$l){
					 
					$unparsed_json = file_get_contents("http://www.reddit.com/r/funny/new.json?limit=".$l."&after=".$after);
					if(!empty($unparsed_json)){	
						
						$pointToStart = $this->reddit_model->getNameToStartOld(); 
						//print_r($pointToStart);
						if(!empty($pointToStart)){
							$this->reddit_model->resetNameToStart($pointToStart['name']);//reset the flag to zero again + remove the entry
							$exts = pathinfo($pointToStart['url'], PATHINFO_EXTENSION);
							if($exts!='gif'){ //die("wait here");
								$this->reddit_model->deleteRecordToStart($pointToStart['name']);//delete the record if it is not a gif record
							}
						}
						
						$data['json_obj'] 	= json_decode($unparsed_json);
						$l 					= count($data['json_obj']->data->children);//now  the limit is the no of records
						$end_recs 			= count($data['json_obj']->data->children)-1;
						//echo "<pre>";print_r($data['json_obj']);echo "</pre>";
						foreach($data['json_obj']->data->children as $key=>$d) {
							$r_data['flags']=0;
							$ext = pathinfo($d->data->url, PATHINFO_EXTENSION);	
							if($key==$end_recs){ // for last record if it is not a gif								
								$r_data['flags']=1;
							}

		
							if($key==$end_recs || $ext=='gif'){ 
								if($ext=='gif'){
									/*$gyf_vid 			= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$d->data->url));
									$r_data['webmUrl'] 	= $gyf_vid->webmUrl;
									$r_data['mp4url'] 	= $gyf_vid->mp4Url;	
									*/			
								}					
								$r_data['title'] 		= $d->data->title;
								$r_data['name'] 		= $d->data->name;
								$r_data['url'] 			= $d->data->url;							
								$r_data['permalink']	= $d->data->permalink;
								$r_data['score'] 		= $d->data->score;
								$r_data['ups'] 			= $d->data->ups;
								$r_data['downs'] 		= $d->data->downs; 
								$r_data['subreddit'] 	= $d->data->subreddit;
								$r_data['subreddit_id'] = $d->data->subreddit_id;  
								$r_data['created'] 		= date('Y-m-d H:i:s',$d->data->created);
								$this->reddit_model->redditInsert($r_data);		
								//echo "<pre>";print_r($r_data);echo "<br></pre>";
								if($key==$end_recs){
									$after = $d->data->name;								
								}
							} else { 	
								continue;
							}
						}	
					}
					sleep(2);		
					//echo "end record=".$end_recs;
				}
				
				$data['json_object'] = $this->reddit_model->allData();
				$this->load->view('admin/fetch_reddit', $data); 
				
		}
		
		function showPosts($page_id=''){
			
			$this->load->library('pagination');
			$alldata=$this->reddit_model->countAllData();
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			 
			$config['base_url'] 	= base_url().'/admin/fetch_reddit/showPosts/';			
			$config['total_rows'] 	= $alldata;
			$config['per_page'] 	= 20; 
			$config["uri_segment"] 	= 4	;
			$config['prev_link'] = 'Previous';
			$config['next_link'] = 'Next';
			$config['display_pages'] = true;
			$config['full_tag_open'] = '<li>'; 
			$config['full_tag_close'] = '</li>';
			$config['num_links'] = 2;
			//$config['num_tag_open'] = '<li>';
			//$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<a href="javascript:;" style="background-color: #f5f5f5;">';
			$config['cur_tag_close'] = '</a>';		
			$this->pagination->initialize($config);
			$data['links']=$this->pagination->create_links();
			$data['json_object'] = $this->reddit_model->allData($config["per_page"], $page);
			$this->load->view('admin/fetch_reddit', $data); 
		}
		
		function recentData(){	
				//$this->reddit_model->emptyReddit('reddit_test');die;//truncate table
				$pointToStart = $this->reddit_model->getNameToStartNew();
				if(!empty($pointToStart)){					
					$before = $pointToStart['name'];
				} else {
					$before='';
					}				
				$l 		= 100;//default is 100 as in api
				$unparsed_json = file_get_contents("http://www.reddit.com/r/gifs/new.json?limit=".$l."&before=".$before);
				if(!empty($unparsed_json)){
					
					$data['json_obj'] 					= json_decode($unparsed_json); //echo "<pre>";print_r($data['json_obj']);
					$data['json_obj']->data->children 	= array_reverse($data['json_obj']->data->children);//reverse array to set the latest post at top
					$end_rec 							= count($data['json_obj']->data->children)-1;
					foreach ($data['json_obj']->data->children as $d) {
						
						$ext = pathinfo($d->data->url, PATHINFO_EXTENSION);							
						if($ext!='gif'){ 
							continue;								
						} else {	
									
							/*$gyf_vid 			= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$d->data->url));
							$r_data['webmUrl'] 	= $gyf_vid->webmUrl;
							$r_data['mp4url'] 	= $gyf_vid->mp4Url;
							*/
							$r_data['title'] 		= $d->data->title;
							$r_data['name'] 		= $d->data->name;
							$r_data['url'] 			= $d->data->url;							
							$r_data['permalink']	= $d->data->permalink;
							$r_data['score'] 		= $d->data->score;
							$r_data['ups'] 			= $d->data->ups;
							$r_data['downs'] 		= $d->data->downs; 
							$r_data['subreddit_id'] = $d->data->subreddit_id; 
							$r_data['subreddit'] 	= $d->data->subreddit; 
							$r_data['created'] 		= date('Y-m-d H:i:s',$d->data->created); 
							
							
							if($data['json_obj']->data->children[$end_rec]->data->name == $d->data->name){
								$r_data['flags']='2';
								$before = $d->data->name;
								$this->reddit_model->resetNameToStart($pointToStart['name']);//reset the flag to zero again
							} else {
								$r_data['flags']='0';	// 0 nothing 
							}							
							$this->reddit_model->redditInsert($r_data);
						}
					}
				}						
					
				$data['json_object'] = $this->reddit_model->allData();
				$this->load->view('admin/fetch_reddit', $data); 
				
		}

		function subreddits(){	
				//$this->reddit_model->emptyReddit('subreddits');die;//truncate table
				$pointToStart = $this->reddit_model->getTagToStartOld();
				if(!empty($pointToStart)){
					$this->reddit_model->resetNameToStart($pointToStart['name']);//reset the flag to zero again
					$after = $pointToStart['name'];
				} else {
					$after 	= '';// for first time only
				}
				$l 		= 10;//default is 100 as in api
				$dl		= 20;//main limit 
				for($lim=$l;$lim<=$dl;$lim=$lim+$l){
					$unparsed_json = file_get_contents("http://www.reddit.com/reddits/popular.json?limit=".$l."&after=".$after);
					if(!empty($unparsed_json)){
						$data['json_obj'] = json_decode($unparsed_json);
						//echo "<pre>";print_r($data['json_obj']);die;
						$last	=1;
						foreach ($data['json_obj']->data->children as $d) {
							$r_data['title'] 		= $d->data->title;
							$r_data['name'] 		= $d->data->name;
							$r_data['url'] 			= $d->data->url;							
							$r_data['header_title']	= $d->data->header_title;
							$r_data['subscribers']	= $d->data->subscribers;
							$r_data['tag']			= "#".$d->data->display_name;
							$r_data['created'] 		= date('Y-m-d H:i:s',$d->data->created);  
							
							/*
							 * set flag according to need 
							*/ 
							if(($lim == $dl) && ($last==$l)){
								$r_data['flags']='1'; //set flag to 1 to start again from where we left 
							} else {
								$r_data['flags']='0';	// 0 nothing 
							}	
							
							$this->reddit_model->subredditInsert($r_data);		
												
							if($last==$l){
								$after = $d->data->name;								
							}
							$last++;
						}
					}						
				
				}
			
				$data['json_object'] = $this->reddit_model->allSubredditData();
				$this->load->view('admin/subreddit', $data); 
				
		}
		
		function search_reddit(){	
			/*
			 * search through subreddits
			*/
			if(isset($_POST['subreddit']) && !empty($_POST['subreddit'])){ 
				$data['subreddit']= $_POST['subreddit'];
				//http://reddit.com/r/[subreddit].[rss/json]?limit=[limit]&after=[after]
				$unparsed_json = file_get_contents("http://www.reddit.com/r/".$data['subreddit'].".json?limit=100");
				if(!empty($unparsed_json)){						
					$data['json_object'] = json_decode($unparsed_json);
					/*$i=0;
					foreach ($datas['json_objects']->data->children as $d) {
						//echo $d->data->url;die("asdasds");
						$gyf_vid = json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$d->data->url));
						$data['json_object']->data->children[$i]->data->mp4url=$gyf_vid->mp4Url;
						$data['json_object']->data->children[$i]->data->webmUrl=$gyf_vid->webmUrl;
						$i++;	
					}*/
					
					$this->load->view('admin/search_reddit', $data); 
				}
			} else {
				$this->load->view('admin/search_reddit'); 
				}
			
		}
		
		function add_subreddits(){ // die("hi ");
			/*
			 * Read xlsx files of subreddits and put them in db with reddit info
			 * 
			 */
			/*set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
			include 'application/third_party/PHPExcleReader/Classes/PHPExcel/IOFactory.php';
			
			//$inputFileName = 'application/third_party/PHPExcleReader/main.xlsx';  // simple File to read
			//$inputFileName = 'application/third_party/PHPExcleReader/nsfw.xlsx';  // nsfw File to read
			//$inputFileName = 'application/third_party/PHPExcleReader/main-2.xlsx';  // new subreddit added File to read
			//$inputFileName = 'application/third_party/PHPExcleReader/missing.xlsx';  // new subreddit added File to read
			$inputFileName = 'application/third_party/PHPExcleReader/additional.xlsx';  // new subreddit added File to read
			try {
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach($sheetData as $data){ 
				 
				$data['B'] = str_replace(' ',',',$data['B']);// , seperated subreddits
				$this->insertIntoDB($data['A'], $data['B']);//API call
			}*/
			$data['json_object'] = $this->reddit_model->allSubredditData();
			$this->load->view('admin/subreddit', $data); 
			
		}
		
		function showSubreddits(){				
			$data['json_object'] = $this->reddit_model->allSubredditData();
			$this->load->view('admin/subreddit', $data); 
		}
				
		public function insertIntoDb($subreddit,$subtags){ 
			/*
			 * insert into subreddits table
			*/
			$unparsed_json = file_get_contents("http://www.reddit.com".$subreddit."/about.json");
			if(!empty($unparsed_json)){
				$d = json_decode($unparsed_json);//print_r($d);die;
				$key = array_key_exists ( 'error' ,$d );
				if(!$key){ 
					if($d->kind=='t5'){ //echo $d->kind;
						$r_data['title'] 		= $d->data->title;
						$r_data['name'] 		= $d->data->name;
						$r_data['url'] 			= $d->data->url;							
						$r_data['header_title']	= $d->data->header_title;
						$r_data['subscribers']	= $d->data->subscribers;
						$r_data['header_img']	= $d->data->header_img;
						$r_data['nsfw']			= $d->data->over18;
						$r_data['priority']		= "p0";
						if(!empty($subtags)){ 
							$r_data['search_tags']	= $subtags;
						}
						$r_data['tag']			= "#".$d->data->display_name;
						$r_data['created'] 		= date('Y-m-d H:i:s',$d->data->created);  	
						//print_r($r_data);							
						return $this->reddit_model->subredditInsert($r_data);	
					}
				}				
			}			
		}
		
		

}
