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
		$comment_thread=json_decode(file_get_contents($_POST['comment_url'].'.json?sort=new&limit=500'));
		//echo "<pre>";print_r($comment_thread);echo "</pre>";die;
		$data['name']			= $comment_thread[0]->data->children[0]->data->name;
		$data					= $_POST;		
		$lpost_id				= $this->comment_model->addComment($id,$data); 
			foreach ($comment_thread as $comments){
				$this->nested_loop($comments, $lpost_id);            
			}
		redirect(base_url()."admin/comments") ; 
    }
    
    function nested_loop($comments ,$lpost_id){
		$post_id = $comments->data->children[0]->data->name;//post_id
		//$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$reg_exUrl = "!(http|https)://.+\.(?:jpe?g|png|gif)!Ui";// to check gif/png/jpeg url in comment
		if($comments->data->children[0]->kind !='t3'){// not a post itself
			foreach ($comments->data->children as $comment){
				if($comment->kind!='more'){
					preg_match_all($reg_exUrl, $comment->data->body_html , $matches);
					if(!empty($matches[0])){
						$gifurl		= $matches[0][0];
						$ext 		= pathinfo($gifurl, PATHINFO_EXTENSION);
						if($ext=='gif'){ 
							/*echo "<hr>gifurl 		==>". $gifurl."<br>";
							echo "<hr>comment text	==>". $comment->data->body."<br>";*/
							$gyf_vid 					= json_decode(file_get_contents("http://upload.gfycat.com/transcode?fetchUrl=".$gifurl));
							//echo "<pre>";print_r($gyf_vid);
							if(isset($gyf_vid->webmUrl)){
								$r_data['webmUrl'] 			= $gyf_vid->webmUrl;
								$r_data['mp4url'] 			= $gyf_vid->mp4Url;
								$r_data['name'] 			= $comment->data->name;
								$r_data['author'] 			= $comment->data->author;							
								$r_data['parent_id']		= $comment->data->parent_id;
								$r_data['post_id']			= $post_id;//for nested commets
								$r_data['lpost_id']			= $lpost_id;//for nested commets
								$r_data['score'] 			= $comment->data->score;
								$r_data['ups'] 				= $comment->data->ups;
								$r_data['downs'] 			= $comment->data->downs; 
								$r_data['subreddit_id'] 	= $comment->data->subreddit_id; 
								$r_data['comment_text'] 	= $comment->data->body; 
								$r_data['comment_gif'] 		= $gifurl; 
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
