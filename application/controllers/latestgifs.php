<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Latestgifs extends CI_Controller{
		public function __construct() {     
			parent::__construct();    
			$this->load->library('session');
			$this->load->model('reddit_model');		 
		}
		public function  nextPostIfFirstFial($l, $before){
			$checks				= json_decode(file_get_contents("http://www.reddit.com/r/gifs/new.json?limit=".$l."&before=".$before));	
			
			if(count($checks->data->children)=='0'){ //echo count($checks->data->children);die("asad");// get next id from reddit_test table
				$nextname 		= $this->reddit_model->getNextPostUrl($before);		
				return $this->nextPostIfFirstFial($l, $nextname['name']);// will give next post name
			} else {
				return $before;
			}
		} 
	
		
		public function index(){ 		
			$to      = 'susheel1688@gmail.com';
			$subject = 'Booyah';
			$message = 'hello this is recent update for GIFS';
			$headers = 'From: Booyah' . "\r\n" .
			'Reply-To: webmaster@example.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			//mail($to, $subject, $message, $headers);

			$l 							= 10;//default is 100 as in api
			$start 						= $this->reddit_model->getSubredditStart('t5_2qt55');
			if(!empty($start)){	
				$before = $this->nextPostIfFirstFial($l, $start['last_post']);
			} else {
				$before 			= '';// for first time only
			}
			$data['json_obj'] 	= json_decode(file_get_contents("http://www.reddit.com/r/gifs/new.json?limit=".$l."&before=".$before));
			$data['json_obj']->data->children 	= array_reverse($data['json_obj']->data->children);//reverse array to set the latest post at top
			$l 					= count($data['json_obj']->data->children);//now  the limit is the no of records
			$end_recs 			= count($data['json_obj']->data->children)-1;
			foreach($data['json_obj']->data->children as $key=>$d) {
				$ext = pathinfo($d->data->url, PATHINFO_EXTENSION);	
				/*if($key==$end_recs){ // for last record if it is not a gif								
					$s_data['last_post']	= $d->data->name;// store last post data to subreddit table to start again
					$this->reddit_model->updateSubredditTest('t5_2qt55', $s_data);	
				}*/

				if($ext=='gif'){ 
					$gyf_vid 				= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$d->data->url));
					if(isset($gyf_vid->webmUrl)){
						$r_data['webmUrl'] 		= $gyf_vid->webmUrl;
						$r_data['mp4url'] 		= $gyf_vid->mp4Url;												
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
						$notexists 				= $this->reddit_model->twoDaysBackSearch($d->data->name);// to check whether post exists with in 48 hours
						//var_dump($notexists);die("wair");
						if($notexists){ // not exists in db
							$this->reddit_model->redditInsertTest($r_data);
							$s_data['last_post']	= $d->data->name;
							$this->reddit_model->updateSubredditTest('t5_2qt55', $s_data);// update with every post name
						}
					}
				} else { 	
					continue;
				}
			}	
			
		}
	}
?>
