<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Comments extends CI_Controller
{
    
    public function __construct(){
        parent::__construct();
		$this->load->model('comment_model');
    }
    
    function index(){
      $result['comments'] = $this->comment_model->fetch_comments();
      $this->load->view('admin/allComments',$result);   
    }
    
    function addComment($id="") {
        $result['comment_detail'] = $this->comment_model->comment_detail($id);
        $this->load->view('admin/addComment',$result); 
       
    }
    
    function saveComment($id=""){
		include_once('application/third_party/simplehtmldom/simple_html_dom.php');	
		$comment_thread=json_decode(file_get_contents(trim($_POST['comment_url']).'.json?limit=500'));
		//echo "<pre>";print_r($comment_thread);echo "</pre>";die;
		$data['name']			= $comment_thread[0]->data->children[0]->data->name;
		$data					= $_POST;		
		$lpost_id				= $this->comment_model->addComment($id,$data); 
 		if($comment_thread[0]->data->children[0]->kind =='t3'){
			/******************************************/
			//echo $comment_thread[0]->data->children[0]->data->selftext_html;die;
			$html      		= str_get_html(html_entity_decode($comment_thread[0]->data->children[0]->data->selftext_html));
			if(!empty($comment_thread[0]->data->children[0]->data->selftext_html)){ 
				foreach($html->find('a') as $a) {
					$reg_exMedia		= '((http|https):\/\/(www)?\.?mediacru\.sh/.+)';
					$reg_exGfycat 		= '((http|https):\/\/(www)?\.?gfycat\.com/.+)';
					preg_match_all($reg_exMedia, $a->href, $matcheMedia);
					preg_match_all($reg_exGfycat, $a->href, $matcheGfycat);					
					$url 				= $a->href;
					$ext 				= pathinfo($url, PATHINFO_EXTENSION);// may be it is a gif
					$isMedia			= '0';
					$isgiffyCat 		= '0';
					if($ext =='gifv'){
						$url  			= str_replace('.gifv', '.mp4', $url);					
						$ext 			= 'mp4';// mp4 extension
					} elseif(!empty($matcheMedia[0])){
						$url 			= $matcheMedia[0][0];//mp4 video from vine to gfycat
						$media_vid 		= json_decode(file_get_contents($url.".json"));
						if(isset($media_vid->files)){
							$url	 	= $media_vid->files['1']->url;//mp4 url
							$isMedia 	= '1';//there is no need of this check but we`ll keep that
						}
					} elseif(!empty($matcheGfycat[0])){
						$url 			= $matcheGfycat[0][0];
						$isgiffyCat 	= '1';
					}
				
					if($ext=='gif' || $ext=='webm' || $ext=='mp4' || $isMedia=='1' || $isgiffyCat=='1'){ 
						//echo $url."<br>";
						$gyf_vid 					= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$url));
						if(isset($gyf_vid->webmUrl)){
							$r_data['webmUrl'] 		= $gyf_vid->webmUrl;
							$r_data['mp4url'] 		= $gyf_vid->mp4Url;		
							$r_data['gifUrl'] 		= $gyf_vid->gifUrl;		
							$r_data['gfyname'] 		= "http://gfycat.com/".$gyf_vid->gfyname;		
						} else {
							continue;
						}
						$r_data['name'] 			= $comment_thread[0]->data->children[0]->data->name;
						$r_data['author'] 			= $comment_thread[0]->data->children[0]->data->author;							
						$r_data['parent_id']		= '';
						$r_data['post_id']			= $comment_thread[0]->data->children[0]->data->name;
						$r_data['lpost_id']			= $lpost_id;//
						$r_data['nsfw'] 			= $comment_thread[0]->data->children[0]->data->over_18;
						$r_data['score'] 			= $comment_thread[0]->data->children[0]->data->score;
						$r_data['ups'] 				= $comment_thread[0]->data->children[0]->data->ups;
						$r_data['downs'] 			= $comment_thread[0]->data->children[0]->data->downs; 
						$r_data['subreddit_id'] 	= $comment_thread[0]->data->children[0]->data->subreddit_id; 
						$r_data['comment_text'] 	= $a->plaintext; 
						$r_data['comment_gif'] 		= $url; 
						$r_data['created'] 			= date('Y-m-d H:i:s',$comment_thread[0]->data->children[0]->data->created); 
						$this->comment_model->commentThreadInsert($r_data);
						
						
					} else { 	 
						continue;
					}
				}
			}
			/********************************************/
			
			//unset($comment_thread[0]);
		}
		foreach ($comment_thread as $comments){
			$this->nested_loop($comments, $lpost_id);            
		}
		redirect(base_url()."admin/comments") ; 
    }
    
    function nested_loop($comments ,$lpost_id){
		//echo "<pre>";print_r($comments);echo "</pre>";//die;
		$post_id = $comments->data->children[0]->data->name;//post_id
		//$reg_exUrl = "!(http|https)://.+\.(?:jpe?g|png|gif)!Ui";// to check gif/png/jpeg url in comment
		if($comments->data->children[0]->kind !='t3'){// not a post itself
			foreach ($comments->data->children as $comment){
				if($comment->kind!='more'){
					$html      		= str_get_html(html_entity_decode($comment->data->body_html));
					$i					= '1';
					$isMedia			= '0';
					$isgiffyCat 		= '0';
					$ext				= '';
					
					foreach($html->find('div[class=md] p a') as $a){
						//if($i=='1'){// we are inserting only one video from a comment
							/*
							 * $plaintext   		='';
							foreach($html->find('div[class=md] p') as $p){
								$plaintext 		.= $p->plaintext." ";
							}*/
							$plaintext   		= $a->innertext;
							$reg_exMedia		= '((http|https):\/\/(www)?\.?mediacru\.sh/.+)';
							$reg_exGfycat 		= '((http|https):\/\/(www)?\.?gfycat\.com/.+)';
							preg_match_all($reg_exMedia, $a->href, $matcheMedia);
							preg_match_all($reg_exGfycat, $a->href, $matcheGfycat);
							$url 				= $a->href;
							$ext 				= pathinfo($url, PATHINFO_EXTENSION);// may be it is a gif
							
							if($ext =='gifv'){
								$url  			= str_replace('.gifv', '.mp4', $url);					
								$ext 			= 'mp4';// mp4 extension
							} elseif(!empty($matcheMedia[0])){
								$url = $matcheMedia[0][0];//mp4 video from mediacrush to gfycat
								$media_vid 		= json_decode(file_get_contents($url.".json"));
								if(isset($media_vid->files)){
									$url	 	= $media_vid->files['1']->url;//mp4 url
									$isMedia 	= '1';//there is no need of this check but we`ll keep that
								}
							} elseif(!empty($matcheGfycat[0])){
								$url = $matcheGfycat[0][0];
								$isgiffyCat 	= '1';
							}
							//$i++;
						//}
										
						if($ext=='gif' || $ext=='webm' || $ext=='mp4' || $isMedia=='1' || $isgiffyCat=='1'){ 
							$gyf_vid 						= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$url));
							if(isset($gyf_vid->webmUrl)){
								$r_data['webmUrl'] 			= $gyf_vid->webmUrl;
								$r_data['mp4url'] 			= $gyf_vid->mp4Url;
								$r_data['gifUrl'] 			= $gyf_vid->gifUrl;		
								$r_data['gfyname'] 			= "http://gfycat.com/".$gyf_vid->gfyname;
								$r_data['name'] 			= $comment->data->name;
								$r_data['author'] 			= $comment->data->author;							
								$r_data['parent_id']		= $comment->data->parent_id;
								$r_data['post_id']			= $post_id;//for nested commets
								$r_data['lpost_id']			= $lpost_id;//for nested commets
								$r_data['score'] 			= $comment->data->score;
								$r_data['ups'] 				= $comment->data->ups;
								$r_data['downs'] 			= $comment->data->downs; 
								$r_data['subreddit_id'] 	= $comment->data->subreddit_id; 
								$r_data['comment_text'] 	= $plaintext;
								$r_data['comment_gif'] 		= $url; 
								$r_data['created'] 			= date('Y-m-d H:i:s',$comment->data->created); 
								$this->comment_model->commentThreadInsert($r_data);
							}
						}					
						if(!empty($comment->data->replies)){// recusrsion for inner comments					
							$this->nested_loop($comment->data->replies, $lpost_id);													
						} 
					}
				}
			}
		}
	}
    
    function delete_comment($id=""){
        $this->comment_model->deleteComment($id);// we have to delete the post related to this comment in other tables   
        $this->comment_model->deleteCommentGifs($id);// here we go  
        redirect(base_url()."admin/comments") ; 
    }
    function viewComment($id){
        $data['comments'] = $this->comment_model->viewComment($id);// we have to delete the post related to this comment in other tables   
       // echo "<pre>";print_r($data['comments']);echo "</pre>";die;
        $data['result'] = $this->comment_model->comment_detail($id);// we have to delete the post related to this comment in other tables   
        $this->load->view('admin/view_comment',$data); 
       // redirect(base_url()."admin/view_comment", $data) ; 
    }
    
   
    
}
?>
