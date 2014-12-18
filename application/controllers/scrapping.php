<?php 
while (ob_get_level() > 0)
ob_end_flush();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Scrapping extends CI_Controller{
		public function __construct() {     
			parent::__construct();    
			$this->load->library('session');
			$this->load->model('reddit_model');		 
			$this->load->model('scrap_model');		 
			$this->load->model('app_model');		 
		}
		/*
		 *	This function will scrap the www.reddit.com/r/gifs https://web.archive.org fro 
		 * 
		*/
		
		function index_archieve(){ 
			die("will stay here");
			//$this->reddit_model->emptyReddit('reddit_old');//die;//truncate table
			include_once('application/third_party/simplehtmldom/simple_html_dom.php');	
			$webarchieve	= 'https://web.archive.org/web/2014*/http://reddit.com/r/gifs';
			$sub_link  		= explode('web/',$webarchieve);	
			$year			= substr($sub_link[1], 0, 4)	;//2011*/http://reddit.com/r/gifs
			$html      		= file_get_html($webarchieve);
			$reg_exUrl 		= "!(http|https)://.+\.(?:jpe?g|png|gif)!Ui";// to check gif|png|jpeg url in comment
			for($i=0;$i<=7;$i++){
				//echo 'div#'.$year.'-'.$i;die;
				foreach($html->find('div#'.$year.'-'.$i) as $e){// for year basis
					//if(!isset($e)){continue;}
					foreach($e->find('.tooltip') as $f){
						foreach($f->find('ul li a') as $a) {
							$link = "https://web.archive.org".$a->href;
							$rhtml = file_get_html($link);
							$errors = 0;
							foreach($rhtml->find('#error') as $error){// some links are not working so there is error 
								if(isset($error)){
									$errors = 1;
								}
							}
							if($errors !=1){
								foreach($rhtml->find("div[class=titlebox] a.hover") as $sub){
									$subreddit = $sub->innertext;									
								}
								$sid 						= $rhtml->find(".usertext input[@type=hidden]", 0);
								$subreddit_id 				= $sid->value;//subreddit_Id
								foreach($rhtml->find('.thing') as $e){
									//$name = $e->attr['data-fullname'];   
									$att 		= $e->getAllAttributes('class'); 
									$class 		= explode('id-',$att['class']);
									$name 		= explode(' ',$class[1]);
									$name 	= $name[0];
									foreach($e->find("div[class=score unvoted]") as $score){
										$r_score	= $score->plaintext;
									}
									foreach($e->find('time') as $time){
										$created 	= date('Y-m-d H:i:s', strtotime($time->attr['title']));
									}	/// //for 2011 there is no tag in html
									//$created 	= '';	
									
									foreach($e->find('a.title') as $title){
										$ptitle  			= $title->innertext;
										$gifurl				= $title->href;// http://awesomegifs.com/wp-content/uploads/puppy-farts-on-dog.gif
									}	
									foreach($e->find('a.comments') as $perm){
										$permalink			= explode('www.reddit.com',$perm->href);///web/20120102203144/http://i.imgur.com/AGmuH.gif
									}
									preg_match_all($reg_exUrl, $gifurl , $matches);	
									if(!empty($matches[0])){
										$gifurl				= $matches[0][0];
										$ext 				= pathinfo($gifurl, PATHINFO_EXTENSION);
										if($ext=='gif'){ 
											$data= array();
											$gyf_vid 		= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$gifurl));
											if(isset($gyf_vid->webmUrl)){
												$data['webmUrl'] 		= $gyf_vid->webmUrl;
												$data['mp4url'] 		= $gyf_vid->mp4Url;
												$data['url'] 			= $gifurl;
												$data['name'] 			= $name;
												$data['title']			= $ptitle;									
												$data['ups'] 			= '';
												$data['score'] 			= $r_score;
												$data['downs'] 			= '';		
												$data['created'] 		= $created;		
												$data['subreddit'] 		= 'gifs';//$subreddit;		
												$data['permalink']		= $permalink[1];// /r/gifs/comments/2enpf2/all_aboard_the_pool_train/						
												$data['subreddit_id'] 	= $subreddit_id;
												$this->reddit_model->redditInsertOld($data);												
											}
										}
									}	
								}	
							}						
						}
					}
				}			
			}
		}
		
		/*
		 *	This function will fetch the recent post from all subreddits
		 *  It will be 100-100 chunk for all reddits
		*/
		
		function cron(){ 
			//$this->reddit_model->emptyReddit('reddit_test');//die;//truncate table
			$allSubreddit = $this->reddit_model->allSubredditDataTest();
			foreach($allSubreddit as $subreddit) {
				$start 				= $this->reddit_model->getSubredditStart($subreddit->name);//get the name whose flag is 1
				if(!empty($start)){	
					$last_post_url 	= $this->reddit_model->getLastPostUrl($start['last_post']);
					$exts 			= pathinfo($last_post_url['url'], PATHINFO_EXTENSION);
					if($exts!='gif'){ //die("wait here");
						$this->reddit_model->delNonGif($start['last_post']);//delete the record if it is not a gif record from redit posts
					}				
					$before 		= $start['last_post'];					
				} else {
					$before 		= '';// for first time only
				}
				$l 					= 100;//default is 100 as in api
				$data['json_obj'] 	= json_decode(file_get_contents("http://www.reddit.com".$subreddit->url."new.json?limit=".$l."&before=".$before));
				$l 					= count($data['json_obj']->data->children);//now  the limit is the no of records
				$end_recs 			= count($data['json_obj']->data->children)-1;
				foreach($data['json_obj']->data->children as $key=>$d) {
					$s_data['last_post']='';
					$ext = pathinfo($d->data->url, PATHINFO_EXTENSION);	
					if($key==$end_recs){ // for last record if it is not a gif								
						$s_data['last_post']=$d->data->name;// store last post data to subreddit table to start again
					}
					
					if($key==$end_recs){
						$this->reddit_model->updateSubredditTest($subreddit->name, $s_data);	
					}

					if($ext=='gif'){ 
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
						$r_data['subreddit'] 	= $d->data->subreddit;
						$r_data['subreddit_id'] = $d->data->subreddit_id;  
						$r_data['created'] 		= date('Y-m-d H:i:s',$d->data->created);
						
						$this->reddit_model->redditInsertTest($r_data);
					} else { 	
						continue;
					}
				}	
				
				sleep(2);
			}
			//$data['json_object'] = $this->reddit_model->allData();
			//$this->load->view('admin/fetch_reddit', $data); 
				
		}
		
		public function  nextPostIfFirstFail($l, $before, $subreddit, $subreddit_id, $index = 0){
			
			$dat = array('uh' => '', 'over18' => 'yes');
			$option = array(
				'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($dat),
				),
			);
			$contexts  			= stream_context_create($option);
			$checks	= json_decode(file_get_contents("http://www.reddit.com".$subreddit."new.json?limit=".$l."&before=".$before, false, $contexts));	
			
			if(count($checks->data->children)=='0'){ //echo count($checks->data->children);die("asad");// get next id from reddit_test table
				
				$nextname 		= $this->scrap_model->getNextPostUrlNew($before, $subreddit_id, $index);
				$index++;
				if(!empty($nextname)){
					return $this->nextPostIfFirstFail($l, $nextname['name'],$subreddit, $subreddit_id, $index);// will give next post name
				} else {
					return '';
				}
			} else {
				return $before;
			}
		} 
		
		/*
		 *	This function will fetch the recent post from /r/gifs
		 *  It will be 10-10 chunk 
		 *  This is a cron file
		*/
		public function all(){					
			$to      = 'susheel1688@gmail.com';
			$subject = 'the subject';
			$message = ' all() main cron job initiated';
			$headers = 'From: Booyah' . "\r\n" .
			'Reply-To: webmaster@example.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion(); 
			mail($to, $subject, $message, $headers);
			
			$allSubreddit = $this->scrap_model->allSubredditDataNew();
			//echo "<pre>";print_r($allSubreddit); echo "</pre>";die("asd");
			$i=0;
			foreach($allSubreddit as $subreddit) {
				$l 				 			= 10;//default is 100 as in api
				$start 						= $this->scrap_model->getSubredditStartNew($subreddit->name);//need to be dynamic t5_2qt55
				if(!empty($start)){		
					$before = $this->nextPostIfFirstFail($l, $start['last_post'], $subreddit->url, $subreddit->name);
				} else {
					$before 			= '';// for first time only
				}
				
				$datas = array('uh' => '', 'over18' => 'yes');
				$options = array(
					'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($datas),
					), 
				);
				$context  			= stream_context_create($options);
				$data['json_obj'] 	= json_decode(file_get_contents("http://www.reddit.com".$subreddit->url."new.json?limit=".$l."&before=".$before, false, $context));// need to be dynamic /r/gifs
				$data['json_obj']->data->children 	= array_reverse($data['json_obj']->data->children);//reverse array to set the latest post at top
				
				$l 					= count($data['json_obj']->data->children);//now  the limit is the no of records
				$end_recs 			= count($data['json_obj']->data->children)-1;
				foreach($data['json_obj']->data->children as $key=>$d) {
					$url 		= $d->data->url;
					$ext 		= pathinfo($url, PATHINFO_EXTENSION);// may be it is a gif
					$isVine  	= '0';
					$isMedia	= '0';
				
					
					if($ext =='gifv'){
						$url = rtrim($url, "v");
						$ext 	= 'gif';// gif extension
						/*
						$url  	= str_replace('.gifv', '.mp4', $url);					
						$ext 	= 'mp4';// mp4 extension*/
					} elseif($d->data->domain == "vine.co"){ //for vine.co hosted videos
						if(!empty($d->data->media_embed->content)){
							$reg_exUrl 	= '((http|https)://v.cdn.vine.co/r/videos.*?\.mp4)';
							preg_match_all($reg_exUrl, urldecode($d->data->media_embed->content), $matches);
							if(!empty($matches[0])){
								$url = $matches[0][0];//mp4 video from vine to gfycat
								$isVine = '1'; // ==1 means that it is a vine hosted video 
							} 
						}
					} elseif($d->data->domain == "mediacru.sh"){	//for mediacru.sh hosted videos
						$media_vid 					= json_decode(file_get_contents($url.".json"));
						if(isset($media_vid->files)){
							$url	 	= $media_vid->files['1']->url;//mp4 url
							$isMedia 	= '1';
						}	
					} 
					
					/*
					 * for media crush videos if any found in the reddit post 
					*/
					//var_dump($isVine); 
					if($ext=='gif' || $ext=='webm' || $ext=='mp4' || $isVine == '1' || $isMedia=='1'){ 
						$gyf_vid 					= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$url));
						if(isset($gyf_vid->webmUrl)){
							$r_data['webmUrl'] 		= $gyf_vid->webmUrl;
							$r_data['mp4url'] 		= $gyf_vid->mp4Url;		
							$r_data['gifUrl'] 		= $gyf_vid->gifUrl;		
							$r_data['gfyname'] 		= "http://gfycat.com/".$gyf_vid->gfyname;		
						} else {
							continue;
						}
						$r_data['title'] 		= $d->data->title;
						$r_data['name'] 		= $d->data->name;
						$r_data['url'] 			= $d->data->url;							
						$r_data['permalink']	= $d->data->permalink;
						$r_data['score'] 		= $d->data->score;
						$r_data['ups'] 			= $d->data->ups;
						$r_data['nsfw'] 		= $d->data->over_18;
						$r_data['downs'] 		= $d->data->downs; 
						$r_data['subreddit'] 	= $d->data->subreddit;
						$r_data['subreddit_id'] = $d->data->subreddit_id; 
						$r_data['created'] 		= date('Y-m-d H:i:s',$d->data->created);
						
						$notexists 				= $this->scrap_model->twoDaysBackSearchNew($d->data->name);// to check whether post exists with in 48 hours
						//var_dump($notexists);die("wair");
						if($notexists){ // not exists in db with in 48 hours
							$this->scrap_model->redditInsertNew($r_data);
							$s_data['last_post']	= $d->data->name; 
							$this->scrap_model->updateSubredditNew($subreddit->name, $s_data);// update with every post name
						}
						
					} else { 	 
						continue;
					}
				}	sleep(2);				
			}			
		}
			
		
		
		/*
		 *	This function will fetch the latest 1000 posts for gifs
		 *  
		*/
		
		function recentposts(){ //die("wait where you haded?");
			//$this->reddit_model->emptyReddit('reddit');//die;//truncate table
			$after 	= '';// for first time only
			$l 		= 100;//default is 100 as in api
			$dl		= 1000;//1000 limit for reddit cache
			for($lim=$l;$lim<=$dl;$lim=$lim+$l){					 
				$unparsed_json = file_get_contents("http://www.reddit.com/r/gifs/new.json?limit=".$l."&after=".$after);
				$data['json_obj'] 	= json_decode($unparsed_json);
				$l 					= count($data['json_obj']->data->children);//now  the limit is the no of records
				$end_recs 			= count($data['json_obj']->data->children)-1;
				foreach($data['json_obj']->data->children as $key=>$d) {
					$ext = pathinfo($d->data->url, PATHINFO_EXTENSION);	
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
						$this->reddit_model->redditInsertTest($r_data);		
						//echo "<pre>";print_r($r_data);echo "<br></pre>";
						if($key==$end_recs){
							$after = $d->data->name;								
						}
					} else { 	
						continue;
					}
				}	
				
				sleep(2);		
				//echo "end record=".$end_recs;
			}
			
			//$data['json_object'] = $this->reddit_model->allData();
			//$this->load->view('admin/fetch_reddit', $data); 
		}
		
		/*
		 *	This function will update the post within 48 hours created date 
		 *  
		*/	
		
		function index(){
			$to      = 'susheel1688@gmail.com';
			$subject = 'the subject';
			$message = 'update score cron job initiated';
			$headers = 'From: Booyah' . "\r\n" .
			'Reply-To: webmaster@example.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);	//die;
			
			$data = $this->reddit_model->twoDaysBack();
			foreach($data as $p){
					$postdata	= json_decode(file_get_contents('http://www.reddit.com'.$p->permalink.'.json'));
					$dcore 	= $postdata[0]->data->children[0]->data->score;
					$name 	= $postdata[0]->data->children[0]->data->name;
					$this->reddit_model->updatescore($name, $dcore);
					sleep(2);
			}
			
			
		}
		
		
		/*
		 * function for cron to fill the data in every 10 min for trending 
		*/
		protected function trendingdata() {
			$to      = 'susheel1688@gmail.com';
			$subject = 'the subject';
			$message = 'trending cron job initiated';
			$headers = 'From: Booyah' . "\r\n" .
			'Reply-To: webmaster@example.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);	//die;
			
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
		}
		function dates(){
			$data = $this->reddit_model->twoDaysBacks();
			echo "<pre>";print_r($data);echo "</pre>";die;
			
			}

}
//ob_end_flush();
